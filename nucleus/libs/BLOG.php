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
 * A class representing a blog and containing functions to get that blog shown
 * on the screen
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) The Nucleus Group
 */

if (!function_exists('requestVar')) {
    exit;
}
require_once dirname(__FILE__) . '/ITEMACTIONS.php';

class BLOG
{
    // blog id
    public $blogid;

    // ID of currently selected category
    public $selectedcatid;

    // After creating an object of the blog class, contains true if the BLOG object is
    // valid (the blog exists)
    public $isValid;

    // associative array, containing all blogsettings (use the get/set functions instead)
    public $settings;

    /**
     * Creates a new BLOG object for the given blog
     *
     * @param $id blogid
     */
    function __construct($id)
    {
        $this->blogid = intval($id);
        $this->readSettings();

        // try to set catid
        // (the parse functions in SKIN.php will override this, so it's mainly useless)
        global $catid;
        $this->setSelectedCategory($catid);
    }

    public function BLOG($id)
    {
        $this->__construct($id);
    }

    /**
     * Shows the given amount of items for this blog
     *
     * @param $template
     *      String representing the template _NAME_ (!)
     * @param $amountEntries
     *      amount of entries to show
     * @param $startpos
     *      offset from where items should be shown (e.g. 5 = start at fifth item)
     * @returns int
     *      amount of items shown
     */
    function readLog($template, $amountEntries, $offset = 0, $startpos = 0)
    {
        return $this->readLogAmount($template, $amountEntries, '', '', 1, 1, $offset, $startpos);
    }

    /**
     * Shows an archive for a given month
     *
     * @param $year
     *      year
     * @param $month
     *      month
     * @param $template
     *      String representing the template name to be used
     */
    function showArchive($templatename, $year, $month = 0, $day = 0)
    {

        // create extra where clause for select query
        if ($day == 0 && $month != 0) {
            $timestamp_start = mktime(0, 0, 0, $month, 1, $year);
            $timestamp_end = mktime(0, 0, 0, $month + 1, 1, $year);  // also works when $month==12
        } elseif ($month == 0) {
            $timestamp_start = mktime(0, 0, 0, 1, 1, $year);
            $timestamp_end = mktime(0, 0, 0, 12, 31, $year);  // also works when $month==12
        } else {
            $timestamp_start = mktime(0, 0, 0, $month, $day, $year);
            $timestamp_end = mktime(0, 0, 0, $month, $day + 1, $year);
        }
        $extra_query = ' and i.itime>=' . mysqldate($timestamp_start)
            . ' and i.itime<' . mysqldate($timestamp_end);

        $this->readLogAmount($templatename, 0, $extra_query, '', 1, 1);
    }

    /**
     * Sets the selected category by id (only when category exists)
     */
    function setSelectedCategory($catid)
    {
        if ($this->isValidCategory($catid) || (intval($catid) == 0)) {
            $this->selectedcatid = intval($catid);
        }
    }

    /**
     * Sets the selected category by name
     */
    function setSelectedCategoryByName($catname)
    {
        $this->setSelectedCategory($this->getCategoryIdFromName($catname));
    }

    /**
     * Returns the selected category
     */
    function getSelectedCategory()
    {
        return $this->selectedcatid;
    }

    /**
     * Shows the given amount of items for this blog
     *
     * @param $template
     *      String representing the template _NAME_ (!)
     * @param $amountEntries
     *      amount of entries to show (0 = no limit)
     * @param $extraQuery
     *      extra conditions to be added to the query
     * @param $highlight
     *      contains a query that should be highlighted
     * @param $comments
     *      1=show comments 0=don't show comments
     * @param $dateheads
     *      1=show dateheads 0=don't show dateheads
     * @param $offset
     *      offset
     * @returns int
     *      amount of items shown
     */
    function readLogAmount(
        $template,
        $amountEntries,
        $extraQuery,
        $highlight,
        $comments,
        $dateheads,
        $offset = 0,
        $startpos = 0
    ) {

        $query = $this->getSqlBlog($extraQuery);

        if ($amountEntries > 0) {
            // $offset zou moeten worden:
            // (($startpos / $amountentries) + 1) * $offset ... later testen ...
            $query .= ' LIMIT ' . intval($startpos + $offset) . ',' . intval($amountEntries);
        }
        return $this->showUsingQuery($template, $query, $highlight, $comments, $dateheads);
    }

    /**
     * Do the job for readLogAmmount
     */
    function showUsingQuery($templateName, $query, $highlight = '', $comments = 0, $dateheads = 1)
    {
        global $CONF, $manager;

        $lastVisit = cookieVar($CONF['CookiePrefix'] . 'lastVisit');
        if ($lastVisit != 0) {
            $lastVisit = $this->getCorrectTime($lastVisit);
        }

        // set templatename as global variable (so plugins can access it)
        global $currentTemplateName;
        $currentTemplateName = $templateName;

        $template =& $manager->getTemplate($templateName);

        // create parser object & action handler
        $actions = new ITEMACTIONS($this);
        $parser = new PARSER($actions->getDefinedActions(), $actions);
        $actions->setTemplate($template);
        $actions->setHighlight($highlight);
        $actions->setLastVisit($lastVisit);
        $actions->setParser($parser);
        $actions->setShowComments($comments);

        // execute query
        $items = sql_query($query);

        $numrows = 0;
        // loop over all items
        $old_date = 0;
        while ($item = sql_fetch_object($items)) {
            $numrows++;
            $item->timestamp = strtotime($item->itime); // string timestamp -> unix timestamp

            // action handler needs to know the item we're handling
            $actions->setCurrentItem($item);

            // add date header if needed
            if ($dateheads) {
                $new_date = date('dFY', $item->timestamp);
                if ($new_date != $old_date) {
                    // unless this is the first time, write date footer
                    $timestamp = $item->timestamp;
                    if ($old_date != 0) {
                        $oldTS = strtotime($old_date);
                        $param = array(
                            'blog' => &$this,
                            'timestamp' => $oldTS
                        );
                        $manager->notify('PreDateFoot', $param);
                        $tmp_footer = Utils::strftime(isset($template['DATE_FOOTER']) ? $template['DATE_FOOTER'] : '',
                            $oldTS);
                        $parser->parse($tmp_footer);
                        $param = array(
                            'blog' => &$this,
                            'timestamp' => $oldTS
                        );
                        $manager->notify('PostDateFoot', $param);
                    }
                    $param = array(
                        'blog' => &$this,
                        'timestamp' => $timestamp
                    );
                    $manager->notify('PreDateHead', $param);
                    // note, to use templatvars in the dateheader, the %-characters need to be doubled in
                    // order to be preserved by strftime
                    $tmp_header = Utils::strftime((isset($template['DATE_HEADER']) ? $template['DATE_HEADER'] : null),
                        $timestamp);
                    $parser->parse($tmp_header);
                    $param = array(
                        'blog' => &$this,
                        'timestamp' => $timestamp
                    );
                    $manager->notify('PostDateHead', $param);
                }
                $old_date = $new_date;
            }

            // parse item
            $parser->parse($template['ITEM_HEADER']);
            $param = array(
                'blog' => &$this,
                'item' => &$item
            );
            $manager->notify('PreItem', $param);
            $parser->parse($template['ITEM']);
            $param = array(
                'blog' => &$this,
                'item' => &$item
            );
            $manager->notify('PostItem', $param);
            $parser->parse($template['ITEM_FOOTER']);

        }

        // add another date footer if there was at least one item
        if (($numrows > 0) && $dateheads) {
            $param = array(
                'blog' => &$this,
                'timestamp' => strtotime($old_date)
            );
            $manager->notify('PreDateFoot', $param);
            $parser->parse($template['DATE_FOOTER']);
            $param = array(
                'blog' => &$this,
                'timestamp' => strtotime($old_date)
            );
            $manager->notify('PostDateFoot', $param);
        }

        sql_free_result($items);    // free memory

        return $numrows;

    }

    /**
     * Simplified function for showing only one item
     */
    function showOneitem($itemid, $template, $highlight)
    {
        $extraQuery = ' and inumber=' . intval($itemid);

        return $this->readLogAmount($template, 1, $extraQuery, $highlight, 0, 0);
    }

    /**
     * Adds an item to this blog
     */
    function additem($catid, $title, $body, $more, $blogid, $authorid, $timestamp, $closed, $draft, $posted = '1')
    {
        global $manager;

        $blogid = intval($blogid);
        $authorid = intval($authorid);
        $title = $title;
        $body = $body;
        $more = $more;
        $catid = intval($catid);
        $isFuture = 0;

        // convert newlines to <br />
        if ($this->convertBreaks()) {
            $body = addBreaks($body);
            $more = addBreaks($more);
        }

        if ($closed != '1') {
            $closed = '0';
        }
        if ($draft != '0') {
            $draft = '1';
        }

        if (!$this->isValidCategory($catid)) {
            $catid = $this->getDefaultCategory();
        }

        if ($timestamp > $this->getCorrectTime()) {
            $isFuture = 1;
        }

        $timestamp = date('Y-m-d H:i:s', $timestamp);

        $param = array(
            'title' => &$title,
            'body' => &$body,
            'more' => &$more,
            'blog' => &$this,
            'authorid' => &$authorid,
            'timestamp' => &$timestamp,
            'closed' => &$closed,
            'draft' => &$draft,
            'catid' => &$catid
        );
        $manager->notify('PreAddItem', $param);

        $ititle = sql_real_escape_string($title);
        $ibody = sql_real_escape_string($body);
        $imore = sql_real_escape_string($more);

        $query = 'INSERT INTO ' . sql_table('item') . ' (ITITLE, IBODY, IMORE, IBLOG, IAUTHOR, ITIME, ICLOSED, IDRAFT, ICAT, IPOSTED) '
            . "VALUES ('$ititle', '$ibody', '$imore', $blogid, $authorid, '$timestamp', $closed, $draft, $catid, $posted)";
        sql_query($query);
        $itemid = sql_insert_id();

        $param = array('itemid' => $itemid);
        $manager->notify('PostAddItem', $param);

        if (!$draft) {
            $this->updateUpdateFile();
        }

        // send notification mail
        if (!$draft && !$isFuture && $this->getNotifyAddress() && $this->notifyOnNewItem()) {
            $this->sendNewItemNotification($itemid, $title, $body);
        }

        return $itemid;
    }

    /**
     * Send a new item notification to the notification list
     *
     * @param $itemid
     *        ID of the item
     * @param $title
     *        title of the item
     * @param $body
     *        body of the item
     */
    function sendNewItemNotification($itemid, $title, $body)
    {
        global $CONF, $member;

        // create text version of html post
        $ascii = toAscii($body);

        $mailto_msg = _NOTIFY_NI_MSG . " \n";
        $temp = parse_url($CONF['Self']);
        if ($temp['scheme']) {
            $mailto_msg .= createItemLink($itemid) . "\n\n";
        } else {
            $tempurl = $this->getURL();
            if (substr($tempurl, -1) == '/' || substr($tempurl, -4) == '.php') {
                $mailto_msg .= $tempurl . '?itemid=' . $itemid . "\n\n";
            } else {
                $mailto_msg .= $tempurl . '/?itemid=' . $itemid . "\n\n";
            }
        }
        $mailto_msg .= _NOTIFY_TITLE . ' ' . strip_tags($title) . "\n";
        $mailto_msg .= _NOTIFY_CONTENTS . "\n " . $ascii . "\n";
        $mailto_msg .= getMailFooter();

        $mailto_title = $this->getName() . ': ' . _NOTIFY_NI_TITLE;

        $frommail = $member->getNotifyFromMailAddress();

        $notify = new NOTIFICATION($this->getNotifyAddress());
        $notify->notify($mailto_title, $mailto_msg, $frommail);
    }

    /**
     * Creates a new category for this blog
     *
     * @param $catName
     *        name of the new category. When empty, a name is generated automatically
     *        (starting with newcat)
     * @param $catDescription
     *        description of the new category. Defaults to 'New Category'
     *
     * @returns
     *        the new category-id in case of success.
     *        0 on failure
     */
    function createNewCategory($catName = '', $catDescription = _CREATED_NEW_CATEGORY_DESC, $corder = null)
    {
        global $member, $manager;

        if ($member->blogAdminRights($this->getID())) {
            // generate
            if ($catName == '') {
                $catName = _CREATED_NEW_CATEGORY_NAME;
                $i = 1;

                $res = true;
                while ($res !== false) {
                    $sql = 'SELECT catid AS result FROM ' . sql_table('category') . " WHERE cname='" . $catName . $i . "' and cblog=" . $this->getID();
                    $res = quickQuery($sql);
                    if (empty($res)) {
                        break;
                    }
                    $i++;
                }

                $catName = $catName . $i;
            }

            $param = array(
                'blog' => &$this,
                'name' => &$catName,
                'description' => $catDescription,
                'order' => &$corder
            );
            $manager->notify('PreAddCategory', $param);

            $query = 'INSERT INTO ' . sql_table('category') .
                ' (cblog, cname, cdesc' . (is_null($corder) ? '' : ', corder') . ')' .
                ' VALUES (' . $this->getID() . ", '" . sql_real_escape_string($catName) . "', '"
                . sql_real_escape_string($catDescription) . "'" .
                (is_null($corder) ? '' : sprintf(', %d', $corder)) .
                ")";
            sql_query($query);
            $catid = sql_insert_id();

            $param = array(
                'blog' => &$this,
                'name' => $catName,
                'description' => $catDescription,
                'catid' => $catid,
                'order' => $corder
            );
            $manager->notify('PostAddCategory', $param);

            return $catid;
        } else {
            return 0;
        }
    }

    /**
     * Searches all months of this blog for the given query
     *
     * @param $query
     *      search query
     * @param $template
     *      template to be used (__NAME__ of the template)
     * @param $amountMonths
     *      max amount of months to be search (0 = all)
     * @param $maxresults
     *      max number of results to show
     * @param $startpos
     *      offset
     * @returns
     *      amount of hits found
     */
    function search($query, $template, $amountMonths, $maxresults, $startpos)
    {
        global $CONF, $manager;

        $highlight = '';
        $sqlquery = $this->getSqlSearch($query, $amountMonths, $highlight);

        if ($sqlquery == '') {
            // no query -> show everything
            $extraquery = '';
            $amountfound = $this->readLogAmount($template, $maxresults, $extraquery, $query, 1, 1);
        } else {

            // add LIMIT to query (to split search results into pages)
            if (intval($maxresults > 0)) {
                $sqlquery .= ' LIMIT ' . intval($startpos) . ',' . intval($maxresults);
            }

            // show results
            $amountfound = $this->showUsingQuery($template, $sqlquery, $highlight, 1, 1);

            // when no results were found, show a message
            if ($amountfound == 0) {
                $template =& $manager->getTemplate($template);
                $vars = array(
                    'query' => hsc($query),
                    'blogid' => $this->getID()
                );
                echo TEMPLATE::fill($template['SEARCH_NOTHINGFOUND'], $vars);
            }
        }

        return $amountfound;
    }

    /**
     * Returns an SQL query to use for a search query
     *
     * @param $query
     *      search query
     * @param $amountMonths
     *      amount of months to search back. Default = 0 = unlimited
     * @param $mode
     *      either empty, or 'count'. In this case, the query will be a SELECT COUNT(*) query
     * @returns $highlight
     *      words to highlight (out parameter)
     * @returns
     *      either a full SQL query, or an empty string (if querystring empty)
     * @note
     *      No LIMIT clause is added. (caller should add this if multiple pages are requested)
     */
    function getSqlSearch($query, $amountMonths = 0, &$highlight = null, $mode = '')
    {
        $searchclass = new SEARCH($query);

        $highlight = $searchclass->inclusive;

        // if querystring is empty, return empty string
        if ($searchclass->inclusive == '') {
            return '';
        }


        $where = $searchclass->boolean_sql_where('ititle,ibody,imore');
        $select = $searchclass->boolean_sql_select('ititle,ibody,imore');

        // get list of blogs to search
        $blogs = $searchclass->blogs;      // array containing blogs that always need to be included
        $blogs[] = $this->getID();           // also search current blog (duh)
        $blogs = array_unique($blogs);     // remove duplicates
        $selectblogs = '';
        if (count($blogs) > 0) {
            $selectblogs = ' and i.iblog in (' . implode(',', $blogs) . ')';
        }

        if ($mode == '') {
            $query = 'SELECT i.inumber as itemid, i.ititle as title, i.ibody as body, m.mname as author, m.mrealname as authorname, i.itime, i.imore as more, m.mnumber as authorid, m.memail as authormail, m.murl as authorurl, c.cname as category, i.icat as catid, i.iclosed as closed';
            if ($select) {
                $query .= ', ' . $select . ' as score ';
            }
        } else {
            $query = 'SELECT COUNT(*) as result ';
        }

        $query .= ' FROM ' . sql_table('item') . ' as i, ' . sql_table('member') . ' as m, ' . sql_table('category') . ' as c'
            . ' WHERE i.iauthor=m.mnumber'
            . ' and i.icat=c.catid'
            . ' and i.idraft=0'  // exclude drafts
            . $selectblogs
            // don't show future items
            . ' and i.itime<=' . mysqldate($this->getCorrectTime())
            . ' and ' . $where;

        // take into account amount of months to search
        if ($amountMonths > 0) {
            $localtime = getdate($this->getCorrectTime());
            $timestamp_start = mktime(0, 0, 0, $localtime['mon'] - $amountMonths, 1, $localtime['year']);
            $query .= ' and i.itime>' . mysqldate($timestamp_start);
        }

        if ($mode == '') {
            if ($select) {
                $query .= ' ORDER BY score DESC';
            } else {
                $query .= ' ORDER BY i.itime DESC ';
            }
        }

        return $query;
    }

    /**
     * Returns the SQL query that's normally used to display the blog items on the index type skins
     *
     * @param $mode
     *      either empty, or 'count'. In this case, the query will be a SELECT COUNT(*) query
     * @returns
     *      either a full SQL query, or an empty string
     * @note
     *      No LIMIT clause is added. (caller should add this if multiple pages are requested)
     */
    function getSqlBlog($extraQuery, $mode = '')
    {
        if ($mode == '') {
            $query = 'SELECT i.inumber as itemid, i.ititle as title, i.ibody as body, m.mname as author, m.mrealname as authorname, i.itime, i.imore as more, m.mnumber as authorid, m.memail as authormail, m.murl as authorurl, c.cname as category, i.icat as catid, i.iclosed as closed';
        } else {
            $query = 'SELECT COUNT(*) as result ';
        }

        $query .= ' FROM ' . sql_table('item') . ' as i, ' . sql_table('member') . ' as m, ' . sql_table('category') . ' as c'
            . ' WHERE i.iblog=' . $this->blogid
            . ' and i.iauthor=m.mnumber'
            . ' and i.icat=c.catid'
            . ' and i.idraft=0'  // exclude drafts
            // don't show future items
            . ' and i.itime<=' . mysqldate($this->getCorrectTime());

        if ($this->getSelectedCategory()) {
            $query .= ' and i.icat=' . $this->getSelectedCategory() . ' ';
        }


        $query .= $extraQuery;

        if ($mode == '') {
            $query .= ' ORDER BY i.itime DESC';
        }

        return $query;
    }

    /**
     * Shows the archivelist using the given template
     */
    function showArchiveList($template, $mode = 'month', $limit = 0)
    {
        global $CONF, $catid, $manager;

        $linkparams = array();
        if ($catid) {
            $linkparams = array('catid' => $catid);
        }

        $template =& $manager->getTemplate($template);
        $data = array();
        $data['blogid'] = $this->getID();

        $tplt = isset($template['ARCHIVELIST_HEADER']) ? $template['ARCHIVELIST_HEADER']
            : '';
        echo TEMPLATE::fill($tplt, $data);

        $query = 'SELECT itime, SUBSTRING(itime,1,4) AS Year, SUBSTRING(itime,6,2) AS Month, SUBSTRING(itime,9,2) AS Day FROM ' . sql_table('item')
            . ' WHERE iblog=' . $this->getID()
            . ' AND itime <=' . mysqldate($this->getCorrectTime())  // don't show future items!
            . ' AND idraft=0'; // don't show draft items

        if ($catid) {
            $query .= ' AND icat=' . intval($catid);
        }

        $query .= ' GROUP BY Year';
        if ($mode == 'month' || $mode == 'day') {
            $query .= ', Month';
        }
        if ($mode == 'day') {
            $query .= ', Day';
        }

        $query .= ' ORDER BY itime DESC';

        if ($limit > 0) {
            $query .= ' LIMIT ' . intval($limit);
        }

        $res = sql_query($query);

        while ($current = sql_fetch_object($res)) {
            $current->itime = strtotime($current->itime);   // string time -> unix timestamp

            if ($mode == 'day') {
                $archivedate = date('Y-m-d', $current->itime);
                $archive['day'] = date('d', $current->itime);
                $data['day'] = date('d', $current->itime);
                $data['month'] = date('m', $current->itime);
                $archive['month'] = $data['month'];
            } elseif ($mode == 'year') {
                $archivedate = date('Y', $current->itime);
                $data['day'] = '';
                $data['month'] = '';
                $archive['day'] = '';
                $archive['month'] = '';
            } else {
                $archivedate = date('Y-m', $current->itime);
                $data['month'] = date('m', $current->itime);
                $archive['month'] = $data['month'];
                $data['day'] = '';
                $archive['day'] = '';
            }

            $data['year'] = date('Y', $current->itime);
            $archive['year'] = $data['year'];
            $data['archivelink'] = createArchiveLink($this->getID(), $archivedate, $linkparams);

            $param = array('listitem' => &$data);
            $manager->notify('PreArchiveListItem', $param);

            $temp = TEMPLATE::fill($template['ARCHIVELIST_LISTITEM'], $data);
            echo Utils::strftime($temp, $current->itime);

        }

        sql_free_result($res);

        $tplt = isset($template['ARCHIVELIST_FOOTER']) ? $template['ARCHIVELIST_FOOTER']
            : '';
        echo TEMPLATE::fill($tplt, $data);
    }

    /**
     * Shows the list of categories using a given template
     */
    function showCategoryList($template)
    {
        global $CONF;
        global $manager;
        global $archive;
        global $archivelist;

        $linkparams = array();
        if ($archive) {
            $blogurl = createArchiveLink($this->getID(), $archive, '');
            $linkparams['blogid'] = $this->getID();
            $linkparams['archive'] = $archive;
        } else {
            if ($archivelist) {
                $blogurl = createArchiveListLink($this->getID(), '');
                $linkparams['archivelist'] = $archivelist;
            } else {
                $blogurl = createBlogidLink($this->getID(), '');
                $linkparams['blogid'] = $this->getID();
            }
        }

        $template =& $manager->getTemplate($template);

        if ($this->getSelectedCategory()) {
            $nocatselected = 'no';
        } else {
            $nocatselected = 'yes';
        }

        // if文の書式変更
        $template_catlist_header = null;
        if(isset($template['CATLIST_HEADER'])){
            $template_catlist_header = $template['CATLIST_HEADER'];
        }
        $template_catlist_header_param = array(
            'blogid' => $this->getID(),
            'blogurl' => $blogurl,
            'self' => $CONF['Self'],
            'catiscurrent' => $nocatselected,
            'currentcat' => $nocatselected
        );
        echo TEMPLATE::fill( $template_catlist_header, $template_catlist_header_param );

        //オーダー番号追加 (yotaca: 2020/07/22)
        $query = 'SELECT catid, cdesc, cname, corder FROM '.sql_table('category').' WHERE cblog=' . $this->getID();

        if (intval($CONF['DatabaseVersion']) >= 371) {
            $query .= ' ORDER BY corder ASC,cname ASC';
        } else {
            $query .= ' ORDER BY cname ASC';
        }
        $res = sql_query($query);

        while ($data = sql_fetch_assoc($res)) {
            $data['catname'] = $data['cname']; //カテゴリーネーム設定 (yotaca: 2020/07/23)
            $data['catdesc'] = $data['cdesc']; //カテゴリー詳細 (yotaca: 2020/07/23)

            $data['catorder'] = $data['corder']; //オーダー番号追加:start (yotaca: 2020/07/23)
            $c = $this->hnmCategoryType($data['corder']);
            $data['cattype'] = $c['type'];
            $data['catparent'] = $c['parnt'];
            $data['catchild'] = $c['child'];
            $data['catclass'] = $c['cls']; //オーダー番号追加:end (yotaca: 2020/07/23)

            $data['blogid'] = $this->getID();
            $data['blogurl'] = $blogurl;

            $param = array(
                'catid' => $data['catid'],
                'name' => $data['catname'],
                'extra' => $linkparams
            );
            $data['catlink'] = createLink( 'category', $param);
            
            $data['self'] = $CONF['Self'];

            //catiscurrent
            //: Change: Bugfix for catiscurrent logic so it gives catiscurrent = no when no category is selected.
            $data['catiscurrent'] = 'no';
            $data['currentcat'] = 'no';
            if ($this->getSelectedCategory()) {
                if ($this->getSelectedCategory() == $data['catid']) {
                    $data['catiscurrent'] = 'yes';
                    $data['currentcat'] = 'yes';
                }
            } else {
                global $itemid;
                if (intval($itemid) && $manager->existsItem(intval($itemid), 0, 0)) {
                    $iobj =& $manager->getItem(intval($itemid), 0, 0);
                    $cid = $iobj['catid'];
                    if ($cid == $data['catid']) {
                        $data['catiscurrent'] = 'yes';
                        $data['currentcat'] = 'yes';
                    }
                }
            }

            $param = array('listitem' => &$data);
            $manager->notify('PreCategoryListItem', $param );

            // if文の書式変更
            $template_catlist_listitem = null;
            if(isset($template['CATLIST_LISTITEM'])){
                $template_catlist_listitem = $template['CATLIST_LISTITEM'];
            }
            echo TEMPLATE::fill( $template_catlist_listitem, $data );
        }
        sql_free_result($res);

        // if文の書式変更
        $template_catlist_footer = null;
        if(isset($template['CATLIST_FOOTER'])){
            $template_catlist_footer = $template['CATLIST_FOOTER'];
        }
        $template_catlist_footer_param = array(
            'blogid' => $this->getID(),
            'blogurl' => $blogurl,
            'self' => $CONF['Self']
        );
        echo TEMPLATE::fill( $template_catlist_footer, $template_catlist_footer_param );
    }

    /**
     * Shows a list of all blogs in the system using a given template
     * ordered by number, name, shortname or description
     * in ascending or descending order
     */
    public static function showBlogList($template, $bnametype, $orderby, $direction)
    {
        global $CONF, $manager;

        switch ($orderby) {
            case 'number':
                $orderby = 'bnumber';
                break;
            case 'name':
                $orderby = 'bname';
                break;
            case 'shortname':
                $orderby = 'bshortname';
                break;
            case 'description':
                $orderby = 'bdesc';
                break;
            default:
                $orderby = 'bnumber';
                break;
        }

        $direction = strtolower($direction);
        switch ($direction) {
            case 'asc':
                $direction = 'ASC';
                break;
            case 'desc':
                $direction = 'DESC';
                break;
            default:
                $direction = 'ASC';
                break;
        }

        $template =& $manager->getTemplate($template);

        echo TEMPLATE::fill((isset($template['BLOGLIST_HEADER']) ? $template['BLOGLIST_HEADER'] : null),
            array(
                'sitename' => $CONF['SiteName'],
                'siteurl' => $CONF['IndexURL']
            ));

        $query = 'SELECT bnumber, bname, bshortname, bdesc, burl FROM ' . sql_table('blog') . ' ORDER BY ' . $orderby . ' ' . $direction;
        $res = sql_query($query);

        while ($data = sql_fetch_assoc($res)) {

            $list = array();

            $list['bloglink'] = createBlogidLink($data['bnumber']);

            $list['blogdesc'] = $data['bdesc'];

            $list['blogurl'] = $data['burl'];

            if ($bnametype == 'shortname') {
                $list['blogname'] = $data['bshortname'];
            } else { // all other cases
                $list['blogname'] = $data['bname'];
            }

            $param = array('listitem' => &$list);
            $manager->notify('PreBlogListItem', $param);

            echo TEMPLATE::fill((isset($template['BLOGLIST_LISTITEM']) ? $template['BLOGLIST_LISTITEM'] : null), $list);

        }

        sql_free_result($res);

        echo TEMPLATE::fill((isset($template['BLOGLIST_FOOTER']) ? $template['BLOGLIST_FOOTER'] : null),
            array(
                'sitename' => $CONF['SiteName'],
                'siteurl' => $CONF['IndexURL']
            ));
    }

    /**
     * Read the blog settings
     */
    function readSettings()
    {
        $query = 'SELECT *'
            . ' FROM ' . sql_table('blog')
            . ' WHERE bnumber=' . $this->blogid;
        $res = sql_query($query);

        $this->settings = ($res ? sql_fetch_assoc($res) : array());
        $this->isValid = !empty($this->settings);
        if (!$this->isValid) {
            $this->settings = array();
        }
    }

    /**
     * Write the blog settings
     */
    function writeSettings()
    {

        // (can't use floatval since not available prior to PHP 4.2)
        $offset = $this->getTimeOffset();
        if (!is_float($offset)) {
            $offset = intval($offset);
        }

        $q_bauthorvisible = (
        !sql_existTableColumnName(sql_table('blog'), 'bauthorvisible') ? '' :
            "   bauthorvisible=" . intval($this->getAuthorVisible()) . ","
        );

        $query = 'UPDATE ' . sql_table('blog')
            . " SET bname='" . sql_real_escape_string($this->getName()) . "',"
            . "     bshortname='" . sql_real_escape_string($this->getShortName()) . "',"
            . "     bcomments=" . intval($this->commentsEnabled()) . ","
            . "     bmaxcomments=" . intval($this->getMaxComments()) . ","
            . "     btimeoffset=" . $offset . ","
            . "     bpublic=" . intval($this->isPublic()) . ","
            . "     breqemail=" . intval($this->emailRequired()) . ","
            . "     bconvertbreaks=" . intval($this->convertBreaks()) . ","
            . "     ballowpast=" . intval($this->allowPastPosting()) . ","
            . "     bnotify='" . sql_real_escape_string($this->getNotifyAddress()) . "',"
            . "     bnotifytype=" . intval($this->getNotifyType()) . ","
            . "     burl='" . sql_real_escape_string($this->getURL()) . "',"
            . "     bupdate='" . sql_real_escape_string($this->getUpdateFile()) . "',"
            . "     bdesc='" . sql_real_escape_string($this->getDescription()) . "',"
            . "     bdefcat=" . intval($this->getDefaultCategory()) . ","
            . "     bdefskin=" . intval($this->getDefaultSkin()) . ","
            . $q_bauthorvisible
            . "     bincludesearch=" . intval($this->getSearchable())
            . " WHERE bnumber=" . intval($this->getID());
        sql_query($query);
    }

    /**
     * Update the update file if requested
     */
    function updateUpdatefile()
    {
        if ($this->getUpdateFile()) {
            $f_update = fopen($this->getUpdateFile(), 'w');
            fputs($f_update, $this->getCorrectTime());
            fclose($f_update);
        }
    }

    /**
     * Check if a category with a given catid is valid
     *
     * @param $catid
     *     category id
     */
    function isValidCategory($catid)
    {
        global $manager;
        $query = 'SELECT count(*) as result FROM ' . sql_table('category') . ' WHERE cblog=' . $this->getID() . ' AND catid=' . intval($catid)
            . ' LIMIT 1';
        $manager->initSqlCacheInfo('sql_fetch_object', $query);
        $count = intval($manager->cachedInfo['sql_fetch_object'][$query]);

        return ($count > 0);
    }

    /**
     * Get the category name for a given catid
     *
     * @param $catid
     *     category id
     */
    function getCategoryName($catid)
    {
        $res = sql_query('SELECT cname FROM ' . sql_table('category') . ' WHERE cblog=' . $this->getID() . ' and catid=' . intval($catid));
        $o = sql_fetch_object($res);
        if (is_object($o)) {
            return $o->cname;
        }
    }

    /**
     * Get the category description for a given catid
     *
     * @param $catid
     *     category id
     */
    function getCategoryDesc($catid)
    {
        $res = sql_query('SELECT cdesc FROM ' . sql_table('category') . ' WHERE cblog=' . $this->getID() . ' and catid=' . intval($catid));
        $o = sql_fetch_object($res);
        return $o->cdesc;
    }

    public function getCategoryOrder($catid)
    {
        $res = sql_query('SELECT corder FROM ' . sql_table('category')
            . ' WHERE cblog=' . $this->getID() . ' and catid=' . intval($catid));
        if ($res && ($o = sql_fetch_object($res))) {
            return intval($o->corder);
        }
        return 100; // default
    }

    /**
     * Get the category id for a given category name
     *
     * @param $name
     *     category name
     */
    function getCategoryIdFromName($name)
    {
        $query = sprintf("SELECT catid FROM `%s` WHERE cblog=%d AND cname='%s'",
            sql_table('category'), $this->getID(), sql_real_escape_string($name));
        $res = sql_query($query);
        if ($res && ($o = sql_fetch_object($res))) {
            return $o->catid;
        } else {
            return $this->getDefaultCategory();
        }
    }

    /**
     * Get the the setting for the line break handling
     * [should be named as getConvertBreaks()]
     */
    function convertBreaks()
    {
        return $this->getSetting('bconvertbreaks');
    }

    /**
     * Set the the setting for the line break handling
     *
     * @param $val
     *     new value for bconvertbreaks
     */
    function setConvertBreaks($val)
    {
        $this->setSetting('bconvertbreaks', $val);
    }

    /**
     * Insert a javascript that includes information about the settings
     * of an author:  ConvertBreaks, MediaUrl and AuthorId
     *
     * @param $authorid
     *     id of the author
     */
    function insertJavaScriptInfo($authorid = '')
    {
        global $member, $CONF;

        if ($authorid == '') {
            $authorid = $member->getID();
        }

        ?>
        <script type="text/javascript">
            setConvertBreaks(<?php echo $this->convertBreaks() ? 'true' : 'false' ?>);
            setMediaUrl("<?php echo $CONF['MediaURL']?>");
            setAuthorId(<?php echo $authorid?>);
        </script>
        <?php
    }

    /**
     * Set the the setting for allowing to publish postings in the past
     *
     * @param $val
     *     new value for ballowpast
     */
    function setAllowPastPosting($val)
    {
        $this->setSetting('ballowpast', $val);
    }

    /**
     * Get the the setting if it is allowed to publish postings in the past
     * [should be named as getAllowPastPosting()]
     */
    function allowPastPosting()
    {
        return $this->getSetting('ballowpast');
    }

    function getCorrectTime($t = 0)
    {
        if ($t == 0) {
            $t = time();
        }
        return ($t + 3600 * $this->getTimeOffset());
    }

    function getName()
    {
        return $this->getSetting('bname');
    }

    function getShortName()
    {
        return $this->getSetting('bshortname');
    }

    function getMaxComments()
    {
        return $this->getSetting('bmaxcomments');
    }

    function getNotifyAddress()
    {
        return $this->getSetting('bnotify');
    }

    function getNotifyType()
    {
        return $this->getSetting('bnotifytype');
    }

    function notifyOnComment()
    {
        $n = $this->getNotifyType();
        return (($n != 0) && (($n % 3) == 0));
    }

    function notifyOnVote()
    {
        $n = $this->getNotifyType();
        return (($n != 0) && (($n % 5) == 0));
    }

    function notifyOnNewItem()
    {
        $n = $this->getNotifyType();
        return (($n != 0) && (($n % 7) == 0));
    }

    function setNotifyType($val)
    {
        $this->setSetting('bnotifytype', $val);
    }

    function getTimeOffset()
    {
        return $this->getSetting('btimeoffset');
    }

    function commentsEnabled()
    {
        return $this->getSetting('bcomments');
    }

    function getURL()
    {
        return $this->getSetting('burl');
    }

    function getRealURL()
    {
        $url = $this->getSetting('burl');
        if (strlen(trim($url)) == 0) {
            $url = createBlogidLink($this->getID());
        }
        return $url;
    }

    function getDefaultSkin()
    {
        return $this->getSetting('bdefskin');
    }

    function getUpdateFile()
    {
        return $this->getSetting('bupdate');
    }

    function getDescription()
    {
        return $this->getSetting('bdesc');
    }

    function isPublic()
    {
        return $this->getSetting('bpublic');
    }

    function emailRequired()
    {
        return $this->getSetting('breqemail');
    }

    function getSearchable()
    {
        return $this->getSetting('bincludesearch');
    }

    function getDefaultCategory()
    {
        return $this->getSetting('bdefcat');
    }

    function setPublic($val)
    {
        $this->setSetting('bpublic', $val);
    }

    function setSearchable($val)
    {
        $this->setSetting('bincludesearch', $val);
    }

    function setDescription($val)
    {
        $this->setSetting('bdesc', $val);
    }

    function setUpdateFile($val)
    {
        $this->setSetting('bupdate', $val);
    }

    function setDefaultSkin($val)
    {
        $this->setSetting('bdefskin', $val);
    }

    function setURL($val)
    {
        $this->setSetting('burl', $val);
    }

    function setName($val)
    {
        $this->setSetting('bname', $val);
    }

    function setShortName($val)
    {
        $this->setSetting('bshortname', $val);
    }

    function setCommentsEnabled($val)
    {
        $this->setSetting('bcomments', $val);
    }

    function setMaxComments($val)
    {
        $this->setSetting('bmaxcomments', $val);
    }

    function setNotifyAddress($val)
    {
        $this->setSetting('bnotify', $val);
    }

    function setEmailRequired($val)
    {
        $this->setSetting('breqemail', $val);
    }

    function setTimeOffset($val)
    {
        // check validity of value
        // 1. replace , by . (common mistake)
        $val = str_replace(',', '.', $val);
        // 2. cast to float or int
        if (is_numeric($val) && strstr($val, '.5')) {
            $val = (float)$val;
        } else {
            $val = intval($val);
        }

        $this->setSetting('btimeoffset', $val);
    }

    function setDefaultCategory($val)
    {
        $this->setSetting('bdefcat', $val);
    }

    function existsSetting($key)
    {
        return isset($this->settings[$key]);
    }

    function getSetting($key)
    {
        if (isset($this->settings[$key])) {
            return $this->settings[$key];
        }
        return;
    }

    function getSettingDefault($key, $dafalutvalue)
    {
        if (!isset($this->settings[$key])) {
            return $dafalutvalue;
        }
        return $this->settings[$key];
    }

    function setSetting($key, $value)
    {
        $this->settings[$key] = $value;
    }

    /**
     * Tries to add a member to the team.
     * Returns false if the member was already on the team
     */
    function addTeamMember($memberid, $admin)
    {
        global $manager;

        $memberid = intval($memberid);
        $admin = intval($admin);

        // check if member is already a member
        $tmem = MEMBER::createFromID($memberid);

        if ($tmem->isTeamMember($this->getID())) {
            return 0;
        }

        $param = array(
            'blog' => &$this,
            'member' => &$tmem,
            'admin' => &$admin
        );
        $manager->notify('PreAddTeamMember', $param);

        // add to team
        $query = 'INSERT INTO ' . sql_table('team') . ' (TMEMBER, TBLOG, TADMIN) '
            . 'VALUES (' . $memberid . ', ' . $this->getID() . ', "' . $admin . '")';
        sql_query($query);

        $param = array(
            'blog' => &$this,
            'member' => &$tmem,
            'admin' => $admin
        );
        $manager->notify('PostAddTeamMember', $param);

        $logMsg = sprintf(_TEAM_ADD_NEWTEAMMEMBER, $tmem->getDisplayName(), $memberid, $this->getName());
        ACTIONLOG::add(INFO, $logMsg);

        return 1;
    }

    function getID()
    {
        return intVal($this->blogid);
    }

    /**
     * Checks if a blog with a given shortname exists
     * Returns true if there is a blog with the given shortname (static)
     *
     * @param $name
     *     blog shortname
     */
    public static function exists($name)
    {
        $sql = sprintf("SELECT count(*) AS result FROM %s WHERE bshortname='%s' LIMIT 1",
            sql_table('blog'), sql_real_escape_string($name));
        return intval(quickQuery($sql)) > 0;
    }

    /**
     * Checks if a blog with a given id exists
     * Returns true if there is a blog with the given ID (static)
     *
     * @param $id
     *     blog id
     */
    public static function existsID($id)
    {
        $sql = sprintf("SELECT count(*) AS result FROM %s WHERE bnumber=%d LIMIT 1",
            sql_table('blog'), intval($id));
        return intval(quickQuery($sql)) > 0;
    }

    /**
     * flag there is a future post pending
     */
    function setFuturePost()
    {
        $query = 'UPDATE ' . sql_table('blog')
            . " SET bfuturepost='1' WHERE bnumber=" . $this->getID();
        sql_query($query);
    }

    /**
     * clear there is a future post pending
     */
    function clearFuturePost()
    {
        $query = 'UPDATE ' . sql_table('blog')
            . " SET bfuturepost='0' WHERE bnumber=" . $this->getID();
        sql_query($query);
    }

    /**
     * check if we should throw justPosted event
     */
    function checkJustPosted()
    {
        global $manager;

        if ($this->settings['bfuturepost'] == 1) {
            $blogid = $this->getID();
            $sql = "SELECT count(*) AS result FROM " . sql_table('item')
                . " WHERE iposted=0 AND iblog=" . $blogid . " AND itime<NOW()"
                . ' LIMIT 1';
            if (intval(quickQuery($sql)) > 0) {
                // This $pinged is allow a plugin to tell other hook to the event that a ping is sent already
                // Note that the plugins's calling order is subject to thri order in the plugin list
                $pinged = false;
                $param = array(
                    'blogid' => $blogid,
                    'pinged' => &$pinged
                );
                $manager->notify('JustPosted', $param);

                // clear all expired future posts
                sql_query("UPDATE " . sql_table('item') . " SET iposted='1' WHERE iblog=" . $blogid . " AND itime<NOW()");

                // check to see any pending future post, clear the flag is none
                $sql = "SELECT count(*) AS result FROM " . sql_table('item')
                    . " WHERE iposted=0 AND iblog=" . $blogid
                    . ' LIMIT 1';
                if (intval(quickQuery($sql)) == 0) {
                    $this->clearFuturePost();
                }
            }
        }
    }

    /**
     * Shows the given list of items for this blog
     *
     * @param $itemarray
     *      array of item numbers to be displayed
     * @param $template
     *      String representing the template _NAME_ (!)
     * @param $highlight
     *      contains a query that should be highlighted
     * @param $comments
     *      1=show comments 0=don't show comments
     * @param $dateheads
     *      1=show dateheads 0=don't show dateheads
     * @param $showDrafts
     *        0=do not show drafts 1=show drafts
     * @param $showFuture
     *        0=do not show future posts 1=show future posts
     * @returns int
     *      amount of items shown
     */
    function readLogFromList(
        $itemarray,
        $template,
        $highlight = '',
        $comments = 1,
        $dateheads = 1,
        $showDrafts = 0,
        $showFuture = 0
    ) {

        $query = $this->getSqlItemList($itemarray, $showDrafts, $showFuture);

        return $this->showUsingQuery($template, $query, $highlight, $comments, $dateheads);
    }

    /**
     * Returns the SQL query used to fill out templates for a list of items
     *
     * @param $itemarray
     *      an array holding the item numbers of the items to be displayed
     * @param $showDrafts
     *        0=do not show drafts 1=show drafts
     * @param $showFuture
     *        0=do not show future posts 1=show future posts
     * @returns
     *      either a full SQL query, or an empty string
     * @note
     *      No LIMIT clause is added. (caller should add this if multiple pages are requested)
     */
    function getSqlItemList($itemarray, $showDrafts = 0, $showFuture = 0)
    {
        if (!is_array($itemarray)) {
            return '';
        }
        $showDrafts = intval($showDrafts);
        $showFuture = intval($showFuture);
        $items = array();
        foreach ($itemarray as $value) {
            if (intval($value)) {
                $items[] = intval($value);
            }
        }
        if (!count($items)) {
            return '';
        }
        //$itemlist = implode(',',$items);
        $i = count($items);
        $query = '';
        foreach ($items as $value) {
            $query .= '('
                . 'SELECT'
                . ' i.inumber as itemid,'
                . ' i.ititle as title,'
                . ' i.ibody as body,'
                . ' m.mname as author,'
                . ' m.mrealname as authorname,'
                . ' i.itime,'
                . ' i.imore as more,'
                . ' m.mnumber as authorid,'
                . ' m.memail as authormail,'
                . ' m.murl as authorurl,'
                . ' c.cname as category,'
                . ' i.icat as catid,'
                . ' i.iclosed as closed';

            $query .= ' FROM '
                . sql_table('item') . ' as i, '
                . sql_table('member') . ' as m, '
                . sql_table('category') . ' as c'
                . ' WHERE'
                . ' i.iblog=' . $this->blogid
                . ' and i.iauthor=m.mnumber'
                . ' and i.icat=c.catid';

            if (!$showDrafts) {
                $query .= ' and i.idraft=0';
            }    // exclude drafts
            if (!$showFuture) {
                $query .= ' and i.itime<=' . mysqldate($this->getCorrectTime());
            } // don't show future items

            //$query .= ' and i.inumber IN ('.$itemlist.')';
            $query .= ' and i.inumber=' . intval($value);
            $query .= ')';
            $i--;
            if ($i) {
                $query .= ' UNION ';
            }
        }

        return $query;
    }

    function getAuthorVisible()
    {
        return intval($this->getSettingDefault('bauthorvisible', 1));
    }

    function setAuthorVisible($val)
    {
        $this->setSetting('bauthorvisible', ($val ? 1 : 0));
    }

    static function UpgardeAddColumnAuthorVisible()
    {
        global $CONF;

        if (!sql_existTableColumnName(sql_table('blog'), 'bauthorvisible')) {
            $sql = sprintf("ALTER TABLE `%s` ADD COLUMN `bauthorvisible` tinyint(2) NOT NULL default '1';",
                sql_table('blog'));
            $res = sql_query($sql);
            return $res !== false;
        }
    }

    //オーダー番号追加 (yotaca: 2018/5/19) 
    function hnmCategoryType($val)
    {
        $r = array('type'=>'', 'parnt'=>0, 'child'=>0, 'cls'=>'', 'sts'=>'');
        $p = "parent_cat";
        $c = "child_cat";

        if(!$val){
            $r["type"] = $p;

        }else{
            $val = strval(intval($val));
            $len = strlen($val);

            if($len <= 2){
                $r["type"] = $p;
                $r["parnt"] = $val;

            }elseif($len >= 3){
                $r["parnt"] = substr($val, 0, -2);
                $r["child"] = substr($val, -2);

                if($r["child"]=="00"){
                    $r["type"] = $p;
                }else{
                    $r["type"] = $c;
                }
            }
        }

        $r["sts"] = $this->hnmGetCategoryid(); // カレント追加(yotaca: 2018/7/1)
        if($r["sts"] == $r["parnt"]){
            $r["sts"] = "current ";
        }else{
             $r["sts"] = "";
        }

        $r["cls"] = $r["sts"].$r["type"]." p_".$r["parnt"]." c_".$r["child"]; // カレント追加(yotaca: 2018/7/1)
        return $r;
    }

    //カレントカテゴリのオーダー番号を抽出します。 (yotaca: 2018/7/1)
    function hnmGetCategoryid()
    { 
        global $catid,$itemid;

        if($itemid){
            $cid = intval($this->hnmGetItemCatid($itemid));
        }elseif($catid){
            $cid = $catid;
        }else{
            return null;
        }

        $r = $this->getCategoryOrder($cid);
        $r = strval($r);

        if(strlen($r) >= 3){ $r = substr($r, 0, -2); }
        else{ return null; }
        return $r;
    }

    //アイテムからカテゴリIDを抽出します。 (yotaca: 2018/7/1)
    function hnmGetItemCatid($itemid)
    {
        $itemid = intval($itemid);
        $query =  'SELECT i.icat as catid FROM '.sql_table('item').' as i WHERE i.inumber=' . $itemid.' LIMIT 1';
        $r = sql_query($query);
        $r = sql_fetch_assoc($r);
        return $r['catid'];
    }
}
