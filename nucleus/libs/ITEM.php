<?php

/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 *
 * A class representing an item
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) The Nucleus Group
 */

class ITEM
{
    public int $itemid;

    /**
     * Constructor of an ITEM object
     *
     * @param integer $itemid id of the item
     */
    public function __construct($itemid)
    {
        $this->itemid = (int) $itemid;
    }

    /**
     * Returns one item with the specific itemid
     *
     * @param integer $itemid      id of the item
     * @param boolean $allowdraft
     * @param boolean $allowfuture
     *
     * @static
     */
    public static function getitem($itemid, $allowdraft, $allowfuture): array|false
    {
        return self::getitemEx($itemid, $allowdraft, $allowfuture, 1);
    }

    /**
     * Returns one item with the specific itemid
     * Version [3.8 - ]
     *
     * @param integer $itemid         id of the item
     * @param boolean $allowdraft
     * @param boolean $allowfuture
     * @param boolean $enableitemterm
     *
     * @static
     */
    public static function getItemEx($itemid, $allowdraft, $allowfuture, $enableitemterm = 0): array|false
    {
        global $manager;

        $itemid = (int) $itemid;

        $query = 'SELECT i.idraft as draft, i.inumber as itemid, i.iclosed as closed, '
               . ' i.ititle as title, i.ibody as body, m.mname as author, i.iauthor as authorid, '
               . ' i.itime, i.imore as more, '
               . ' i.ikarmapos as karmapos, i.ikarmaneg as karmaneg, '
               . ' i.icat as catid, i.iblog as blogid,'
               . ' i.ipublic as public, '
               .  " CASE WHEN i.idraft=1 THEN 'draft' WHEN ipublic=1 THEN 'public' ELSE 'unpublic' END AS status,"
               . ' i.ipublic_enable_term_start as public_enable_term_start,'
               . ' i.ipublic_enable_term_end as public_enable_term_end,'
               . ' i.ipublic_term_start as public_term_start,'
               . ' i.ipublic_term_end as public_term_end'
               . sprintf(
                   ' FROM %s as i, %s as m, %s as b ',
                   sql_table('item'),
                   sql_table('member'),
                   sql_table('blog')
               )
               . sprintf(' WHERE i.inumber=%d', $itemid)
               . ' and i.iauthor=m.mnumber '
               . ' and i.iblog=b.bnumber';

        if ( ! $allowdraft) {
            $query .= ' and i.idraft=0';
        }

        if ( ! $allowfuture) {
            $blog = &$manager->getBlog(getBlogIDFromItemID($itemid));
            $query .= ' and i.itime <=' . mysqldate($blog->getCorrectTime());
        }
        if ($enableitemterm) {
            ITEM::addShowQueryFilter($query);
        }

        $query .= ' LIMIT 1';

        $res = sql_query($query);

        if ($res && ($aItemInfo = sql_fetch_assoc($res))) {
            $aItemInfo['timestamp'] = strtotime($aItemInfo['itime']);

            foreach (['draft', 'itemid', 'closed', 'authorid', 'catid', 'blogid'] as $name) {
                if (isset($aItemInfo[$name]) && is_string($aItemInfo[$name])) {
                    $aItemInfo[$name] = (int) $aItemInfo[$name];
                }
            }
            return $aItemInfo;
        }

        return false;
    }

    /**
     * Tries to create an item from the data in the current request (comes from
     * bookmarklet or admin area
     *
     * Returns an array with status info:
     * status = 'added', 'error', 'newcategory'
     *
     * @static
     */
    public static function createFromRequest()
    {
        global $member, $manager;

        $new_options = ['otherCols' => []];
        $otherCols   = & $new_options['otherCols'];

        $i_author     = $member->getID();
        $i_body       = postVar('body');
        $i_title      = postVar('title');
        $i_more       = postVar('more');
        $i_actiontype = postVar('actiontype');
        $i_closed     = (intPostVar('closed') ? 1 : 0);
        $i_hour       = intPostVar('hour');
        $i_minutes    = intPostVar('minutes');
        $i_month      = intPostVar('month');
        $i_day        = intPostVar('day');
        $i_year       = intPostVar('year');
        $i_catid      = postVar('catid');
        $i_draftid    = intPostVar('draftid');

        if ( ! $member->canAddItem($i_catid)) {
            return ['status' => 'error', 'message' => _ERROR_DISALLOWED];
        }

        $act_state = postVar('act_state'); // unsafe value
        $ipublic   = ('public' === $act_state ? 1 : 0);
        $idraft    = ('draft' === $act_state ? 1 : 0);

        if ($idraft || ('adddraft' === $i_actiontype) || ('backtodrafts' === $i_actiontype)) {
            $i_actiontype = 'adddraft';
        }

        if ( ! $i_actiontype) {
            $i_actiontype = 'addnow';
        }

        switch ($i_actiontype) {
            case 'adddraft':
                $i_draft = 1;
                $ipublic = 0;
                break;
            case 'addfuture':
            case 'addnow':
            default:
                $i_draft = 0;
        }

        if (0 == strlen(trim($i_body))) {
            return ['status' => 'error', 'message' => _ERROR_NOEMPTYITEMS];
        }

        // create new category if needed
        if (str_contains($i_catid, 'newcat')) {
            // get blogid
            [$i_blogid] = sscanf($i_catid, "newcat-%d");

            // create
            $blog    = &$manager->getBlog($i_blogid);
            $i_catid = $blog->createNewCategory();

            // show error when sth goes wrong
            if ( ! $i_catid) {
                return [
                    'status'  => 'error',
                    'message' => _ERROR_CATCREATEFAIL,
                ];
            }
        } else {
            // force blogid (must be same as category id)
            $i_blogid = getBlogIDFromCatID($i_catid);
            $blog     = &$manager->getBlog($i_blogid);
        }

        if ('addfuture' === $i_actiontype) {
            $posttime = mktime(
                $i_hour,
                $i_minutes,
                0,
                $i_month,
                $i_day,
                $i_year
            );

            // make sure the date is in the future, unless we allow past dates
            if (( ! $blog->allowPastPosting())
                && ($posttime < $blog->getCorrectTime())) {
                $posttime = $blog->getCorrectTime();
            }
        } else {
            // time with offset, or 0 for drafts
            $posttime = $i_draft ? 0 : $blog->getCorrectTime();
        }

        if ($posttime > $blog->getCorrectTime()) {
            $posted = 0;
            $blog->setFuturePost();
        } else {
            $posted = 1;
        }

        $otherCols['ipublic']                   = $ipublic;
        $otherCols['ipublic_enable_term_start'] = (intPostVar('public_enable_term_start') ? 1 : 0);
        $otherCols['ipublic_enable_term_end']   = (intPostVar('public_enable_term_end') ? 1 : 0);
        foreach (['start', 'end'] as $section) {
            /*
             *  MySQL retrieves and displays DATE values in 'YYYY-MM-DD' format. The supported range is '1000-01-01' to '9999-12-31'.
             *  TIMESTAMP has a range of '1970-01-01 00:00:01' UTC to '2038-01-19 03:14:07' UTC.
             */
            $y  = min(9999, max(0, intPostVar('year_public_term_' . $section)));
            $mo = min(99, max(0, intPostVar('month_public_term_' . $section)));
            $d  = min(99, max(0, intPostVar('day_public_term_' . $section)));
            $h  = min(99, max(0, intPostVar('hour_public_term_' . $section)));
            $mi = min(99, max(0, intPostVar('minute_public_term_' . $section)));
            if ($y < 2000) {
                $y  = 2000;
                $mo = $d = 1;
                $h  = $mi = 0;
            }
            $otherCols['ipublic_term_' . $section] = sprintf("%04d-%02d-%02d %02d:%02d:00", $y, $mo, $d, $h, $mi);
        }

        $itemid = $blog->additem($i_catid, $i_title, $i_body, $i_more, $i_blogid, $i_author, $posttime, $i_closed, $i_draft, $posted, $new_options);

        //Setting the itemOptions
        $aOptions = requestArray('plugoption');
        NucleusPlugin::_applyPluginOptions($aOptions, $itemid);
        $param = [
            'context' => 'item',
            'itemid'  => $itemid,
            'item'    => [
                'title'  => $i_title,
                'body'   => $i_body,
                'more'   => $i_more,
                'closed' => $i_closed,
                'catid'  => $i_catid,
            ],
        ];
        $manager->notify('PostPluginOptionsUpdate', $param);

        if ($i_draftid > 0) {
            // delete permission is checked inside ITEM::delete()
            ITEM::delete($i_draftid);
        }

        // success
        if ($i_catid != intRequestVar('catid')) {
            return [
                'status' => 'newcategory',
                'itemid' => $itemid,
                'catid'  => $i_catid,
            ];
        } else {
            return ['status' => 'added', 'itemid' => $itemid];
        }
    }

    /**
     * Updates an item
     *
     * @static
     */
    public static function update(
        $itemid,
        $catid,
        $title,
        $body,
        $more,
        $closed,
        $wasdraft,
        $publish,
        $timestamp = 0,
        $options = []
    ) {
        global $manager;

        $itemid = (int) $itemid;

        // make sure value is 1 or 0
        $closed = ($closed ? 1 : 0);

        // get destination blogid
        $new_blogid = getBlogIDFromCatID($catid);
        $old_blogid = getBlogIDFromItemID($itemid);

        // move will be done on end of method
        $moveNeeded = (($new_blogid != $old_blogid) ? 1 : 0);

        // add <br /> before newlines
        $blog = &$manager->getBlog($new_blogid);
        if ($blog->convertBreaks()) {
            $body = addBreaks($body);
            $more = addBreaks($more);
        }

        // call plugins
        $param = [
            'itemid' => $itemid,
            'title'  => &$title,
            'body'   => &$body,
            'more'   => &$more,
            'blog'   => &$blog,
            'closed' => &$closed,
            'catid'  => &$catid,
        ];
        $manager->notify('PreUpdateItem', $param);

        // make sure value is 1 or 0
        $closed = ($closed ? 1 : 0);

        // update item itsself
        $query = 'UPDATE ' . sql_table('item')
               . ' SET'
               . " ibody=?, ititle=?, imore=?, iclosed=?, icat=? ";
        $params = [
                    &$body,&$title, &$more, (int) $closed, (int) $catid,
            ];

        if (isset($options['extraColValue']) && is_array($options['extraColValue'])) {
            foreach ($options['extraColValue'] as $key => $value) {
                $query .= sprintf(', %s = ?', $key);
                $params[] = $value;
            }
        }

        // if we received an updated timestamp in the past, but past posting is not allowed,
        // reject that date change (timestamp = 0 will make sure the current date is kept)
        if (( ! $blog->allowPastPosting())
            && ($timestamp < $blog->getCorrectTime())) {
            $timestamp = 0;
        }

        if ($timestamp > $blog->getCorrectTime(time())) {
            $isFuture = 1;
            $query .= ', iposted=0';
        } else {
            $isFuture = 0;
            $query .= ', iposted=1';
        }

        if ($wasdraft && (0 === $timestamp)) {
            $timestamp = $blog->getCorrectTime();
        }
        if ($wasdraft && $publish) {
            // set timestamp to current date only if it's not a future item
            // draft items have timestamp == 0
            // don't allow timestamps in the past (unless otherwise defined in blogsettings)
            $query .= ', idraft=0';

            // send new item notification
            if ( ! $isFuture && $blog->getNotifyAddress()
                 && $blog->notifyOnNewItem()) {
                $blog->sendNewItemNotification($itemid, $title, $body);
            }
        }

        // save back to drafts
        if ( ! $publish) {
            $query .= ', idraft=1';
            // set timestamp back to zero for a draft
            $query .= ", itime=" . sqldate($timestamp);
        }

        // update timestamp when needed
        if (0 != $timestamp) {
            $query .= ", itime=" . sqldate($timestamp);
        }

        // make sure the correct item is updated
        $query .= ' WHERE inumber=' . $itemid;

        // off we go!
        sql_prepare_execute($query, $params);

        $param = ['itemid' => $itemid];
        $manager->notify('PostUpdateItem', $param);

        // when needed, move item and comments to new blog
        if ($moveNeeded) {
            ITEM::move($itemid, $catid);
        }

        //update the itemOptions
        $aOptions = requestArray('plugoption');
        NucleusPlugin::_applyPluginOptions($aOptions);
        $param = [
            'context' => 'item',
            'itemid'  => $itemid,
            'item'    => [
                'title'  => $title,
                'body'   => $body,
                'more'   => $more,
                'closed' => $closed,
                'catid'  => $catid,
            ],
        ];
        $manager->notify('PostPluginOptionsUpdate', $param);
    }

    /**
     * Clone an item to another blog (no checks)
     *
     * Note: clone is PHP Reserved word
     *      * @static
     */
    public static function cloneItem($itemid, $new_catid = 0)
    {
        $itemid    = (int) $itemid;
        $new_catid = (int) $new_catid;

        $query = sprintf(
            'SELECT iblog,icat FROM %s WHERE inumber=%d',
            sql_table('item'),
            $itemid
        );
        $res = sql_query($query);
        if ($res = (sql_query($query) && ($obj = sql_fetch_object($res)))) {
            $src_blogid = (int) $obj->iblog;
            $src_catid  = (int) $obj->icat;
        } else {
            return false; // unkown error,  invalid inumber ?
        }

        //
        if ($new_catid <= 0) {
            $new_catid = $src_catid;
        }
        $is_same_cat = ($src_catid == $new_catid);

        if ( ! $is_same_cat) {
            $new_blogid = getBlogIDFromCatID($new_catid);
            if ( ! $new_blogid) {
                return false;
            } // unkown error,  invalid catid ?
        } else {
            $new_blogid = $src_blogid;
        }

        //         Todo: event_PreCloneItem, event_PostCloneItem
        //         event_PreCloneItem
        //        $param = array(
        //            'src_itemid'    => $itemid,
        //            'src_blogid'    => $src_blogid,
        //            'src_catid'     => $src_catid,
        //            'dest_blogid'   => $new_blogid,
        //            'dest_catid'    => $new_catid,
        //            'is_same_category' => $is_same_cat
        //        );
        //        $manager->notify('PreCloneItem', $param); // not implemented yet

        $new_iblog = $is_same_cat ? 'iblog'
            : sprintf('%d as iblog', $new_blogid);
        $new_icat = $is_same_cat ? 'icat' : sprintf('%d as icat', $new_catid);
        $dist
                   = 'ititle,ibody,imore,iblog,iauthor,itime,iclosed,idraft,ikarmapos,icat,ikarmaneg,iposted';
        $src       = sprintf(
            "ititle,ibody,imore,%s,iauthor,itime,iclosed,'1' AS idraft,ikarmapos,%s,ikarmaneg,iposted",
            $new_iblog,
            $new_icat
        );
        $query = sprintf(
            "INSERT INTO %s(%s) SELECT %s FROM %s WHERE inumber=%s",
            sql_table('item'),
            $dist,
            $src,
            sql_table('item'),
            $itemid
        );

        if (sql_query($query)) {
            return sql_insert_id();

            // event_PostCloneItem
            //            $param = array(
            //                'itemid'        => $new_itemid,
            ////                'blogid'        => $new_blogid,
            ////                'catid'         => $new_catid,
            //                'src_itemid'    => $itemid,
            //                'src_blogid'    => $src_blogid,
            //                'src_catid'     => $src_catid,
            //                'dest_blogid'   => $new_blogid,
            //                'dest_catid'    => $new_catid,
            //                'is_same_category' => ($src_catid == $new_catid)
            //            );
            //            $manager->notify('PostCloneItem', $param); // not implemented yet
        }
    }

    /**
     * Move an item to another blog (no checks)
     *
     * @static
     */
    public static function move($itemid, $new_catid)
    {
        global $manager;

        $itemid    = (int) $itemid;
        $new_catid = (int) $new_catid;

        $new_blogid = getBlogIDFromCatID($new_catid);

        $param = [
            'itemid'     => $itemid,
            'destblogid' => $new_blogid,
            'destcatid'  => $new_catid,
        ];
        $manager->notify('PreMoveItem', $param);

        // update item table
        sql_query(
            sprintf(
                'UPDATE %s SET iblog=%s, icat=%d WHERE inumber=%d',
                sql_table('item'),
                $new_blogid,
                $new_catid,
                $itemid
            )
        );

        // update comments
        sql_query(
            sprintf(
                'UPDATE %s SET cblog=%s WHERE citem=%d',
                sql_table('comment'),
                $new_blogid,
                $itemid
            )
        );

        $param = [
            'itemid'     => $itemid,
            'destblogid' => $new_blogid,
            'destcatid'  => $new_catid,
        ];
        $manager->notify('PostMoveItem', $param);
    }

    /**
     * Deletes an item
     */
    public static function delete($itemid)
    {
        global $manager, $member;

        $itemid = (int) $itemid;

        // check to ensure only those allow to alter the item can
        // proceed
        if ( ! $member->canAlterItem($itemid)) {
            return 1;
        }

        $param = ['itemid' => $itemid];
        $manager->notify('PreDeleteItem', $param);

        // delete item
        sql_query(
            sprintf(
                'DELETE FROM %s WHERE inumber=%d',
                sql_table('item'),
                $itemid
            )
        );

        // delete the comments associated with the item
        sql_query(
            sprintf(
                'DELETE FROM %s WHERE citem=%d',
                sql_table('comment'),
                $itemid
            )
        );

        // delete all associated plugin options
        NucleusPlugin::_deleteOptionValues('item', $itemid);

        $param = ['itemid' => $itemid];
        $manager->notify('PostDeleteItem', $param);

        return 0;
    }

    /**
     * Returns true if there is an item with the given ID
     *
     * @static
     */
    public static function exists($id, $future, $draft)
    {
        global $manager, $CONF;

        $id = (int) $id;

        $sql = sprintf(
            'select count(*) FROM %s WHERE inumber=%d',
            sql_table('item'),
            $id
        );
        if ( ! $future) {
            $bid = getBlogIDFromItemID($id);
            if ( ! $bid) {
                return 0;
            }
            $b = &$manager->getBlog($bid);
            $sql .= ' AND itime<=' . mysqldate($b->getCorrectTime());
        }
        if ( ! $draft) {
            $sql .= ' AND idraft=0';
        }

        if ( ! isset($CONF['UsingAdminArea']) || 1 != $CONF['UsingAdminArea']) {
            self::addShowQueryFilter($sql);
        }

        $res = sql_query($sql . ' LIMIT 1');

        if ( ! $res) {
            return false;
        }
        return ((int) (sql_result($res, 0, 0)) > 0);
    }

    /**
     * Tries to create an draft from the data in the current request (comes from
     * bookmarklet or admin area
     *
     * Returns an array with status info:
     * status = 'added', 'error', 'newcategory'
     *
     * @static
     *
     * Used by xmlHTTPRequest AutoDraft
     */
    public static function createDraftFromRequest()
    {
        global $member, $manager;

        $i_author = $member->getID();
        $i_body   = postVar('body');
        $i_title  = postVar('title');
        $i_more   = postVar('more');

        //$i_actiontype = postVar('actiontype');
        $i_closed = (intPostVar('closed') ? 1 : 0);
        //$i_hour = intPostVar('hour');
        //$i_minutes = intPostVar('minutes');
        //$i_month = intPostVar('month');
        //$i_day = intPostVar('day');
        //$i_year = intPostVar('year');
        $i_catid = postVar('catid');
        $i_draft = 1;
        $type    = postVar('type');
        if ('edit' === $type) {
            $i_blogid = getBlogIDFromItemID(intPostVar('itemid'));
        } else {
            $i_blogid = intPostVar('blogid');
        }
        $i_draftid = intPostVar('draftid');

        if ( ! $member->canAddItem($i_catid)) {
            return ['status' => 'error', 'message' => _ERROR_DISALLOWED];
        }

        if ( ! trim($i_body)) {
            return ['status' => 'error', 'message' => _ERROR_NOEMPTYITEMS];
        }

        // create new category if needed
        if (str_contains($i_catid, 'newcat')) {
            // Set in default category
            $blog    = &$manager->getBlog($i_blogid);
            $i_catid = $blog->getDefaultCategory();
        } else {
            // force blogid (must be same as category id)
            $i_blogid = getBlogIDFromCatID($i_catid);
            $blog     = &$manager->getBlog($i_blogid);
        }

        $posttime = 0;

        if ($i_draftid > 0) {
            ITEM::update(
                $i_draftid,
                $i_catid,
                $i_title,
                $i_body,
                $i_more,
                $i_closed,
                1, // $wasdraft
                0, // $publish
                0 // $timestamp
            );
            $itemid = $i_draftid;
        } else {
            $itemid = $blog->additem(
                $i_catid,
                $i_title,
                $i_body,
                $i_more,
                $i_blogid,
                $i_author,
                $posttime,
                $i_closed,
                $i_draft
            );
        }

        // success
        return ['status' => 'added', 'draftid' => $itemid];
    }

    public static function existCol_ipublic()
    {
        static $res = null;
        if (is_null($res)) {
            $res = sql_existTableColumnName(sql_table('item'), 'ipublic');
        }
        if ( ! defined('_ENABLE_ITEM_PUBLIC_FEATURE')) {
            define('_ENABLE_ITEM_PUBLIC_FEATURE', ($res ? 1 : 0));
        }
        return $res;
    }

    public static function addShowQueryFilter(&$query, $table_alias = "")
    {
        $query .= self::getShowQueryFilter($table_alias);
    }

    public static function getShowQueryFilter($table_alias = "")
    {
        return self::getShowQueryFilterForPublicFeature($table_alias);
    }

    public static function addShowQueryFilterForPublicFeature(&$query, $table_alias = "")
    {
        $query .= self::getShowQueryFilterForPublicFeature($table_alias);
    }

    public static function getShowQueryFilterForPublicFeature($table_alias = "")
    {
        if ( ! self::existCol_ipublic()) {
            return '';  // needs upgrade database
        }

        $now    = sqldate(time());
        $al     = (0 == strlen(trim($table_alias)) ? '' : trim($table_alias) . '.');
        $expr   = [];
        $expr[] = "{$al}ipublic_enable_term_start=0 AND {$al}ipublic_enable_term_end=0";
        $expr[] = "{$al}ipublic_enable_term_start=1 AND {$al}ipublic_enable_term_end=0"
                . sprintf(" AND {$al}ipublic_term_start<=%s", $now);
        $expr[] = "{$al}ipublic_enable_term_start=0 AND {$al}ipublic_enable_term_end=1"
                . sprintf(" AND {$al}ipublic_term_end>%s", $now);
        $expr[] = "{$al}ipublic_enable_term_start=1 AND {$al}ipublic_enable_term_end=1"
                . sprintf(" AND {$al}ipublic_term_start<=%s AND {$al}ipublic_term_end>%s", $now, $now);
        // combine each value with 'or condition'
        $expr  = '(' . implode(') OR (', $expr) . ')';
        $query = " AND ({$al}ipublic = 1 AND ( {$expr} )) ";
        return $query;
    }
}
