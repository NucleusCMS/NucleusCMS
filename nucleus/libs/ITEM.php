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
class ITEM {

    public $itemid;

    /**
      * Constructor of an ITEM object
      * 
      * @param integer $itemid id of the item
      */
    public function ITEM($itemid) { $this->__construct($itemid); }
    function __construct($itemid) {
        $this->itemid = $itemid;
    }

    /**
      * Returns one item with the specific itemid
      * 
      * @param integer $itemid id of the item
      * @param boolean $allowdraft
      * @param boolean $allowfuture
      * @static
      */
    public static function getitem($itemid, $allowdraft, $allowfuture, $allowtermfeature) {
        global $manager;

        $itemid = intval($itemid);

        $query =  'SELECT i.idraft as draft, i.inumber as itemid, i.iclosed as closed, '
               . ' i.ititle as title, i.ibody as body, m.mname as author, '
               . ' i.iauthor as authorid, i.itime, i.imore as more, i.ikarmapos as karmapos, '
               . ' i.ikarmaneg as karmaneg, i.icat as catid, i.iblog as blogid, ';
        if (self::existCol_istatus()) {
            $query .= " CASE i.idraft WHEN 1 THEN 'draft' ELSE i.istatus END AS status,"
               . ' i.ipublic_enable_term_start as public_enable_term_start,'
               . ' i.ipublic_enable_term_end   as public_enable_term_end,'
               . ' i.ipublic_term_start as public_term_start,'
               . ' i.ipublic_term_end   as public_term_end';
        } else { // needs upgrade database
            $query .= " CASE i.idraft WHEN 1 THEN 'draft' ELSE 'published' END AS status, "
               . ' 0 as public_enable_term_start,'
               . ' 0 as public_enable_term_end,'
               . " '2000-01-01 00:00:00' as public_term_start,"
               . " '2099-01-01 00:00:00' as public_term_end";
        }
        $query .= ' FROM '.sql_table('item').' as i, '.sql_table('member').' as m, ' . sql_table('blog') . ' as b '
               . ' WHERE i.inumber=' . $itemid
               . ' and i.iauthor=m.mnumber '
               . ' and i.iblog=b.bnumber';

        if (!$allowdraft)
            $query .= ' and i.idraft=0';

        if (!$allowfuture) {
            $blog =& $manager->getBlog(getBlogIDFromItemID($itemid));
            $query .= ' and i.itime <=' . mysqldate($blog->getCorrectTime());
        }
        if ($allowtermfeature) {
            ITEM::addShowQueryFilterForPublicFeature($query);
        }

        $query .= ' LIMIT 1';

        $res = sql_query($query);

        if ($res && ($aItemInfo = sql_fetch_assoc($res)))
        {
            $aItemInfo['timestamp'] = strtotime($aItemInfo['itime']);
            return $aItemInfo;
        } else {
            return 0;
        }

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
    public static function createFromRequest() {
         global $member, $manager;

         $new_options = array('otherCols' => array());
         $otherCols =& $new_options['otherCols'];

         $i_author =         $member->getID();
         $i_body =             postVar('body');
         $i_title =            postVar('title');
         $i_more =             postVar('more');
         $i_actiontype =     postVar('actiontype');
         $i_closed =         intPostVar('closed');
         $i_hour =             intPostVar('hour');
         $i_minutes =         intPostVar('minutes');
         $i_month =         intPostVar('month');
         $i_day =             intPostVar('day');
         $i_year =             intPostVar('year');

         $i_catid =         postVar('catid');

         $i_draftid =         intPostVar('draftid');

        $i_status = ITEM::convertValidStatusText(postVar('act_status'), 'published');
        if ($i_status=='draft' || $i_actiontype == 'adddraft') {
            $i_actiontype = 'adddraft';
            $i_status     = 'draft';
        }

         if (!$member->canAddItem($i_catid))
            return array('status' => 'error', 'message' => _ERROR_DISALLOWED);

         if (!$i_actiontype) $i_actiontype = 'addnow';

         switch ($i_actiontype) {
            case 'adddraft':
                $i_draft = 1;
                break;
            case 'addfuture':
            case 'addnow':
            default:
                $i_draft = 0;
         }

         if (!trim($i_body))
            return array('status' => 'error', 'message' => _ERROR_NOEMPTYITEMS);

        // create new category if needed
        if (strstr($i_catid,'newcat')) {
            // get blogid
            list($i_blogid) = sscanf($i_catid,"newcat-%d");

            // create
            $blog =& $manager->getBlog($i_blogid);
            $i_catid = $blog->createNewCategory();

            // show error when sth goes wrong
            if (!$i_catid)
                return array('status' => 'error','message' => 'Could not create new category');
        } else {
            // force blogid (must be same as category id)
            $i_blogid = getBlogIDFromCatID($i_catid);
            $blog =& $manager->getBlog($i_blogid);
        }

        if ($i_actiontype == 'addfuture') {
            $posttime = mktime($i_hour, $i_minutes, 0, $i_month, $i_day, $i_year);

            // make sure the date is in the future, unless we allow past dates
            if ((!$blog->allowPastPosting()) && ($posttime < $blog->getCorrectTime()))
                $posttime = $blog->getCorrectTime();
        } else {
            // time with offset, or 0 for drafts
            $posttime = $i_draft ? 0 : $blog->getCorrectTime();
        }

        if ($posttime > $blog->getCorrectTime()) {
            $posted = 0;
            $blog->setFuturePost();
        }
        else {
            $posted = 1;
        }


        if (intPostVar('not_available_istatus') != 1 && ITEM::existCol_istatus()) {
            $otherCols['istatus'] = $i_status;
            $otherCols['ipublic_enable_term_start'] = (intPostVar('public_enable_term_start') ? 1 : 0);
            $otherCols['ipublic_enable_term_end']   = (intPostVar('public_enable_term_end') ? 1 : 0);
            foreach (array('start', 'end') as $section)
            {
                /*
                 *  MySQL retrieves and displays DATE values in 'YYYY-MM-DD' format. The supported range is '1000-01-01' to '9999-12-31'.
                 *  TIMESTAMP has a range of '1970-01-01 00:00:01' UTC to '2038-01-19 03:14:07' UTC.
                 */
                $y = min(9999,max(0, intPostVar('year_public_term_' . $section)));
                $mo = min(99,max(0, intPostVar('month_public_term_' . $section)));
                $d = min(99,max(0, intPostVar('day_public_term_' . $section)));
                $h = min(99,max(0, intPostVar('hour_public_term_' . $section)));
                $mi = min(99,max(0, intPostVar('minute_public_term_' . $section)));
                if ($y < 2000)
                    { $y = 2000; $mo = $d = 1; $h = $mi = 0; }
                $otherCols['ipublic_term_' . $section] = sprintf("%04d-%02d-%02d %02d:%02d:00", $y, $mo, $d, $h, $mi);
                if ( $section == 'start'
                     && $otherCols['istatus']=='published'
                     && strcmp($otherCols['ipublic_term_' . $section], sql_timestamp_from_utime($blog->getCorrectTime())) > 0)
                {
                    $otherCols['istatus'] = 'future';
                }
            }
            if (in_array($i_status, $draft_list) && $otherCols['istatus']!=$i_status) {
                $otherCols['istatus'] = $i_status;
            }
        }

        $itemid = $blog->additem($i_catid, $i_title,$i_body,$i_more,$i_blogid,$i_author,$posttime,$i_closed,$i_draft,$posted, $new_options);

        //Setting the itemOptions
        $aOptions = requestArray('plugoption');
        NucleusPlugin::_applyPluginOptions($aOptions, $itemid);
        $param = array(
        'context'    => 'item',
        'itemid'    => $itemid,
        'item'        => array(
            'title'        => $i_title,
            'body'        => $i_body,
            'more'        => $i_more,
            'closed'    => $i_closed,
            'catid'        => $i_catid)
        );
        $manager->notify('PostPluginOptionsUpdate', $param);

        if ($i_draftid > 0) {
            // delete permission is checked inside ITEM::delete()
            ITEM::delete($i_draftid);
        }

        // success
        if ($i_catid != intRequestVar('catid'))
            return array('status' => 'newcategory', 'itemid' => $itemid, 'catid' => $i_catid);
        else
            return array('status' => 'added', 'itemid' => $itemid);
    }


    /**
      * Updates an item
      *
      * @static
      */
    public static function update($itemid, $catid, $title, $body, $more, $closed, $wasdraft, $publish, $timestamp = 0, $options = array()) {
        global $manager;

        $itemid = intval($itemid);

        // make sure value is 1 or 0
        if ($closed != 1) $closed = 0;

        // get destination blogid
        $new_blogid = getBlogIDFromCatID($catid);
        $old_blogid = getBlogIDFromItemID($itemid);

        // move will be done on end of method
        $moveNeeded = (($new_blogid != $old_blogid) ? 1 : 0);

        // add <br /> before newlines
        $blog =& $manager->getBlog($new_blogid);
        if ($blog->convertBreaks()) {
            $body = addBreaks($body);
            $more = addBreaks($more);
        }

        // call plugins
        $param = array(
            'itemid'    =>  $itemid,
            'title'        => &$title,
            'body'        => &$body,
            'more'        => &$more,
            'blog'        => &$blog,
            'closed'    => &$closed,
            'catid'        => &$catid
        );
        $manager->notify('PreUpdateItem', $param);

        // update item itsself
        $query =  'UPDATE '.sql_table('item')
               . ' SET'
               . " ibody='". sql_real_escape_string($body) ."',"
               . " ititle='" . sql_real_escape_string($title) . "',"
               . " imore='" . sql_real_escape_string($more) . "',"
               . " iclosed=" . intval($closed) . ","
               . " icat=" . intval($catid);

        if (isset($options['extraColValue']) && is_array($options['extraColValue']))
        foreach ($options['extraColValue'] as $key => $value) {
            if (is_int($value))
                $query .= sprintf(', %s = %d', $key, $value);
            else
                $query .= sprintf(', %s = %s', $key, sql_quote_string($value));
        }

        // if we received an updated timestamp in the past, but past posting is not allowed,
        // reject that date change (timestamp = 0 will make sure the current date is kept)
        if ( (!$blog->allowPastPosting()) && ($timestamp < $blog->getCorrectTime()))
                $timestamp = 0;

        if ($timestamp > $blog->getCorrectTime(time())) {
            $isFuture = 1;
            $query .= ', iposted=0';
        }
        else {
            $isFuture = 0;
            $query .= ', iposted=1';
        }

        if ($wasdraft && $publish) {
            // set timestamp to current date only if it's not a future item
            // draft items have timestamp == 0
            // don't allow timestamps in the past (unless otherwise defined in blogsettings)
            $query .= ', idraft=0';

            if ($timestamp == 0)
                $timestamp = $blog->getCorrectTime();

            // send new item notification
            if (!$isFuture && $blog->getNotifyAddress() && $blog->notifyOnNewItem())
                $blog->sendNewItemNotification($itemid, $title, $body);
        }

        // save back to drafts        
        if (!$wasdraft && !$publish) {
            $query .= ', idraft=1';
            // set timestamp back to zero for a draft
            $query .= ", itime=" . mysqldate($timestamp);
        }

        // update timestamp when needed
        if ($timestamp != 0)
            $query .= ", itime=" . mysqldate($timestamp);

        // make sure the correct item is updated
        $query .= ' WHERE inumber=' . $itemid;

        // off we go!
        sql_query($query);

        $param = array('itemid' => $itemid);
        $manager->notify('PostUpdateItem', $param);

        // when needed, move item and comments to new blog
        if ($moveNeeded)
            ITEM::move($itemid, $catid);

        //update the itemOptions
        $aOptions = requestArray('plugoption');
        NucleusPlugin::_applyPluginOptions($aOptions);
        $param = array(
            'context'    => 'item',
            'itemid'    => $itemid,
            'item'        => array(
                'title'        => $title,
                'body'        => $body,
                'more'        => $more,
                'closed'    => $closed,
                'catid'        => $catid
            )
        );
        $manager->notify('PostPluginOptionsUpdate', $param);

    }

    /**
     * Clone an item to another blog (no checks)
     *
     * Note: clone is PHP Reserved word
     *      * @static
     */
    public static function cloneItem($itemid, $new_catid = 0) {
        global $manager, $member;

        $tbl_item = sql_table('item');
        $itemid = intval($itemid);
        $new_catid = intval($new_catid);

       $query = sprintf("SELECT iblog,icat FROM %s WHERE inumber=%d", $tbl_item, $itemid);
        if ($res = sql_query($query) && ($obj = sql_fetch_object($res)))
        {
            $src_blogid = intval($obj->iblog);
            $src_catid  = intval($obj->icat);
        }
        else
        {
            return FALSE; // unkown error,  invalid inumber ?
        }

        // 
        if ($new_catid <= 0)
            $new_catid = $src_catid;
        $is_same_cat = ($src_catid == $new_catid);

        if (!$is_same_cat)
        {
            $new_blogid = getBlogIDFromCatID($new_catid);
            if (!$new_blogid)
                return FALSE; // unkown error,  invalid catid ?
        }
        else
        {
            $new_blogid = $src_blogid;
        }

//        if (!$member->canCloneItem($itemid) || !!$member->canAddItem($new_catid)) {
//            return ;
//        }

        // Todo: event_PreCloneItem, event_PostCloneItem
        // event_PreCloneItem
        $param = array(
//            'itemid'        => $itemid,
//            'blogid'        => $new_blogid,
//            'catid'         => $new_catid,
            'src_itemid'    => $itemid,
            'src_blogid'    => $src_blogid,
            'src_catid'     => $src_catid,
            'dest_blogid'   => $new_blogid,
            'dest_catid'    => $new_catid,
            'is_same_category' => $is_same_cat
        );
//        $manager->notify('PreCloneItem', $param); // not implemented yet

        $new_iblog = $is_same_cat ? 'iblog' : sprintf('%d as iblog', $new_blogid);
        $new_icat  = $is_same_cat ? 'icat'  : sprintf('%d as icat' , $new_catid);
        $dist = 'ititle,ibody,imore,iblog,iauthor,itime,iclosed,idraft,ikarmapos,icat,ikarmaneg,iposted';
        $src  = "ititle,ibody,imore,${new_iblog},iauthor,itime,iclosed,'1' AS idraft,ikarmapos,${new_icat},ikarmaneg,iposted";
        $query = sprintf("INSERT INTO %s(%s) SELECT %s FROM %s WHERE inumber=%s", $tbl_item, $dist, $src, $tbl_item, $itemid);
        if (sql_query($query))
        {
            $new_itemid = sql_insert_id();

            // event_PostCloneItem
            $param = array(
                'itemid'        => $new_itemid,
//                'blogid'        => $new_blogid,
//                'catid'         => $new_catid,
                'src_itemid'    => $itemid,
                'src_blogid'    => $src_blogid,
                'src_catid'     => $src_catid,
                'dest_blogid'   => $new_blogid,
                'dest_catid'    => $new_catid,
                'is_same_category' => ($src_catid == $new_catid)
            );
//            $manager->notify('PostCloneItem', $param); // not implemented yet
        }
    }

    /**
     * Move an item to another blog (no checks)
     *
     * @static
     */
    public static function move($itemid, $new_catid) {
        global $manager;

        $itemid = intval($itemid);
        $new_catid = intval($new_catid);

        $new_blogid = getBlogIDFromCatID($new_catid);

        $param = array(
            'itemid'        => $itemid,
            'destblogid'    => $new_blogid,
            'destcatid'        => $new_catid
        );
        $manager->notify('PreMoveItem', $param);


        // update item table
        $query = 'UPDATE '.sql_table('item')." SET iblog=$new_blogid, icat=$new_catid WHERE inumber=$itemid";
        sql_query($query);

        // update comments
        $query = 'UPDATE '.sql_table('comment')." SET cblog=" . $new_blogid." WHERE citem=" . $itemid;
        sql_query($query);

        $param = array(
            'itemid'        => $itemid,
            'destblogid'    => $new_blogid,
            'destcatid'        => $new_catid
        );
        $manager->notify('PostMoveItem', $param);
    }

    /**
      * Deletes an item
      */
    public static function delete($itemid) {
        global $manager, $member;

        $itemid = intval($itemid);

        // check to ensure only those allow to alter the item can
        // proceed
        if (!$member->canAlterItem($itemid)) {
            return 1;
        }

        $param = array('itemid' => $itemid);
        $manager->notify('PreDeleteItem', $param);

        // delete item
        $query = 'DELETE FROM '.sql_table('item').' WHERE inumber=' . $itemid;
        sql_query($query);

        // delete the comments associated with the item
        $query = 'DELETE FROM '.sql_table('comment').' WHERE citem=' . $itemid;
        sql_query($query);

        // delete all associated plugin options
        NucleusPlugin::_deleteOptionValues('item', $itemid);

        $param = array('itemid' => $itemid);
        $manager->notify('PostDeleteItem', $param);

        return 0;
    }

    /**
     * Returns true if there is an item with the given ID
     *
     * @static
     */
    public static function exists($id,$future,$draft) {
        global $manager,$CONF;

        $id = intval($id);

        $sql = 'SELECT count(*) AS result FROM '.sql_table('item').' WHERE inumber='.$id;
        if (!$future) {
            $bid = getBlogIDFromItemID($id);
            if (!$bid) return 0;
            $b =& $manager->getBlog($bid);
            $sql .= ' AND itime<='.mysqldate($b->getCorrectTime());
        }
        if (!$draft) {
            $sql .= ' AND idraft=0';
        }
        if (!isset($CONF['UsingAdminArea']) || $CONF['UsingAdminArea'] != 1) {
           self::addShowQueryFilterForPublicFeature($sql);
        }

        $sql .= ' LIMIT 1';

        return (intval(quickQuery($sql)) > 0);
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
    public static function createDraftFromRequest() {
        global $member, $manager;

        $i_author = $member->getID();
        $i_body = postVar('body');
        $i_title = postVar('title');
        $i_more = postVar('more');

        if((strtoupper(_CHARSET) != 'UTF-8')
           && ( ($mb = function_exists('mb_convert_encoding')) || function_exists('iconv') )
          ) {
            if ($mb) {
                $i_body  = mb_convert_encoding($i_body,  _CHARSET, "UTF-8");
                $i_title = mb_convert_encoding($i_title, _CHARSET, "UTF-8");
                $i_more  = mb_convert_encoding($i_more,  _CHARSET, "UTF-8");
            } else {
                $i_body  = iconv("UTF-8", _CHARSET, $i_body);
                $i_title = iconv("UTF-8", _CHARSET, $i_title);
                $i_more  = iconv("UTF-8", _CHARSET, $i_more);
            }
        }
        //$i_actiontype = postVar('actiontype');
        $i_closed = intPostVar('closed');
        //$i_hour = intPostVar('hour');
        //$i_minutes = intPostVar('minutes');
        //$i_month = intPostVar('month');
        //$i_day = intPostVar('day');
        //$i_year = intPostVar('year');
        $i_catid = postVar('catid');
        $i_draft = 1;
        $type = postVar('type');
        if ($type == 'edit') {
            $i_blogid = getBlogIDFromItemID(intPostVar('itemid'));
        }
        else {
            $i_blogid = intPostVar('blogid');
        }
        $i_draftid = intPostVar('draftid');

        if (!$member->canAddItem($i_catid)) {
            return array('status' => 'error', 'message' => _ERROR_DISALLOWED);
        }

        if (!trim($i_body)) {
            return array('status' => 'error', 'message' => _ERROR_NOEMPTYITEMS);
        }

        // create new category if needed
        if (strstr($i_catid, 'newcat')) {
            // Set in default category
            $blog =& $manager->getBlog($i_blogid);
            $i_catid = $blog->getDefaultCategory();
        }
        else {
            // force blogid (must be same as category id)
            $i_blogid = getBlogIDFromCatID($i_catid);
            $blog =& $manager->getBlog($i_blogid);
        }

        $posttime = 0;

        if ($i_draftid > 0) {
            ITEM::update($i_draftid, $i_catid, $i_title, $i_body, $i_more, $i_closed, 1, 0, 0);
            $itemid = $i_draftid;
        }
        else {
            $itemid = $blog->additem($i_catid, $i_title, $i_body, $i_more, $i_blogid, $i_author, $posttime, $i_closed, $i_draft);
        }

        // success
        return array('status' => 'added', 'draftid' => $itemid);
    }

    static function existCol_istatus() {
        static $res = NULL;
        if (is_null($res))
            $res = sql_existTableColumnName(sql_table('item'), 'istatus');
        if (!defined('_ENABLE_ITEM_STATUS_FEATURE'))
            define('_ENABLE_ITEM_STATUS_FEATURE', ($res ? 1 : 0));
        return $res;
    }

    /*
            if ( method_exists( 'ITEM', 'addShowQueryFilterForPublicFeature' ))
                    ITEM::addShowQueryFilterForPublicFeature($query);
     */
    static function addShowQueryFilterForPublicFeature(&$query, $table_alias="") {
        $query .= self::getShowQueryFilterForPublicFeature();
//		echo "$query"; // debug
    }

    static function getShowQueryFilterForPublicFeature($table_alias="")
    {
        if (!self::existCol_istatus())
            return '';  // needs upgrade database
        
        $now = sqldate(time());
        $al = (strlen(trim($table_alias)) == 0 ? '' : trim($table_alias).'.');
        $expr = array();
        $expr[] = "${al}ipublic_enable_term_start=0 AND ${al}ipublic_enable_term_end=0";
        $expr[] = "${al}ipublic_enable_term_start=1 AND ${al}ipublic_enable_term_end=0"
                . sprintf(" AND ${al}ipublic_term_start<=%s", $now);
        $expr[] = "${al}ipublic_enable_term_start=0 AND ${al}ipublic_enable_term_end=1"
                . sprintf(" AND ${al}ipublic_term_end>%s", $now);
        $expr[] = "${al}ipublic_enable_term_start=1 AND ${al}ipublic_enable_term_end=1"
                . sprintf(" AND ${al}ipublic_term_start<=%s AND ${al}ipublic_term_end>%s", $now, $now);
        // combine each value with 'or condition'
        $expr = '(' . implode(') OR (', $expr) . ')';
        $query = " AND (${al}istatus in ('published','future') AND ( $expr )) ";
        return $query;
    }

    static public function getValidStatusLists() {
        return array(
            'published',
            'unpublished',
            'future',
            'deleted',
            'draft',
            'pending'
        );
    }
    static public function convertValidStatusText($statusText, $defaultValue='published') {
        if (empty($statusText) || !is_string($statusText))
            return $defaultValue;
        foreach(self::getValidStatusLists() as $validValue) {
            if (strcasecmp(trim($statusText), $validValue) == 0)
                return $validValue;
        }
        return $defaultValue;
    }

}

