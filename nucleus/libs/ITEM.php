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
    public static function getitem($itemid, $allowdraft, $allowfuture) {
        global $manager;

        $itemid = intval($itemid);

        $query =  'SELECT i.idraft as draft, i.inumber as itemid, i.iclosed as closed, '
               . ' i.ititle as title, i.ibody as body, m.mname as author, '
               . ' i.iauthor as authorid, i.itime, i.imore as more, i.ikarmapos as karmapos, '
               . ' i.ikarmaneg as karmaneg, i.icat as catid, i.iblog as blogid '
               . ' FROM '.sql_table('item').' as i, '.sql_table('member').' as m, ' . sql_table('blog') . ' as b '
               . ' WHERE i.inumber=' . $itemid
               . ' and i.iauthor=m.mnumber '
               . ' and i.iblog=b.bnumber';

        if (!$allowdraft)
            $query .= ' and i.idraft=0';

        if (!$allowfuture) {
            $blog =& $manager->getBlog(getBlogIDFromItemID($itemid));
            $query .= ' and i.itime <=' . mysqldate($blog->getCorrectTime());
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
                return array('status' => 'error','message' => _ERROR_CATCREATEFAIL);
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

        $itemid = $blog->additem($i_catid, $i_title,$i_body,$i_more,$i_blogid,$i_author,$posttime,$i_closed,$i_draft,$posted);

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
    public static function update($itemid, $catid, $title, $body, $more, $closed, $wasdraft, $publish, $timestamp = 0) {
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
        global $manager;

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

}

?>