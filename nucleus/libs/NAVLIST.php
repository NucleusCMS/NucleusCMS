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
 * Part of the code for the Nucleus admin area
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) The Nucleus Group
 */

/**
 * A class used to encapsulate a list of some sort inside next/prev buttons
 */
class NAVLIST extends ENCAPSULATE
{
    public $action;
    public $start;
    public $amount;
    public $minamount;
    public $maxamount;
    public $blogid;
    public $search;
    public $itemid;
    public $total = null;
    protected $batch = null;

    public function __construct(
        $action,
        $start,
        $amount,
        $minamount,
        $maxamount,
        $blogid,
        $search,
        $itemid
    ) {
        $this->action    = $action;
        $this->start     = $start;
        $this->amount    = $amount;
        $this->minamount = $minamount;
        $this->maxamount = $maxamount;
        $this->blogid    = $blogid;
        $this->search    = $search;
        $this->itemid    = $itemid;
    }

    public function showBatchList(
        $batchtype,
        &$query,
        $type,
        $template,
        $errorMessage = _LISTS_NOMORE
    ) {
        $this->batch = new BATCH($batchtype);
        $call   = [$this->batch, 'showlist'];
        $params = [&$query, $type, $template];
        $this->doEncapsulate($call, $params, $errorMessage);
    }

    public function showHead()
    {
        if ($this->isFootNavigation) {
            $this->showNavigation();
        }
    }

    public function showFoot()
    {
        if ($this->isFootNavigation) {
            $this->showNavigation();
        }
        if ($this->batch && method_exists($this->batch, 'showOperationList')) {
            $this->batch->showOperationList();
        }
    }

    /**
     * Displays a next/prev bar for long tables
     */
    public function showNavigation()
    {
        $action    = $this->action;
        $start     = (int) $this->start;
        $amount    = (int) $this->amount;
        $minamount = $this->minamount;
        $maxamount = $this->maxamount;
        $blogid    = $this->blogid;
        $search    = hsc($this->search);
        $itemid    = $this->itemid;

        // Todo: Page navigation

        $prev = $start - $amount;
        //$prev = max(0, ($current_page - 2)) * $amount;
        if ($prev < $minamount) {
            $prev = $minamount;
        }

        //$next = max(0, min($current_page, $total_pages) * $amount);
        $enable_cat_select = in_array(
            $action,
            ['itemlist', 'browseownitems']
        );
        if ($enable_cat_select) {
            $catid = max(0, intRequestVar('catid'));
        }
        $view_item_options = self::getValidViewItemOption(
            (string) requestVar('view_item_options', 'all')
        );

        if (isset($this->total)) {
            $maxamount = $this->total - 1;
            if ($start + $amount <= $maxamount) {
                $next = $start + $amount;
            } else {
                $next = $start;
            }
        } else {
            $next = $start + $amount;
        }

        ?>
        <form method="get" action="index.php" class="navigation">
            <input type="hidden" name="blogid" value="<?php echo $blogid; ?>"/>
            <input type="hidden" name="itemid" value="<?php echo $itemid; ?>"/>
            <input type="hidden" name="action" value="<?php echo $action; ?>"/>
            <input type="hidden" name="start" value="0"/>
            <div class="nav-controls">
                <div class="nav-left">
                    <div class="nav-group">
                        <input type="text" name="search" value="<?php echo $search; ?>" size="16" placeholder="キーワード"/>
                        <input type="submit" value="<?php echo _LISTS_SEARCH ?>"/>
                    </div>

                    <?php
                    if ($enable_cat_select) {
                        $query_extra = ADMIN::getQueryFilterForItemlist01(
                            $blogid,
                            $view_item_options
                        );
                        echo $this->getFormSelectCategoryBlog(
                            $action,
                            $blogid,
                            $catid,
                            'catid',
                            $query_extra
                        );
                        echo $this->getFormSelectViewItemOptions(
                            $action,
                            $blogid,
                            $catid,
                            $view_item_options
                        );
                    } else {
                        echo '<input type="hidden" name="view_item_options" value="'
                            . $view_item_options . '" />';
                    }

                    $perpageOptions = [10, 20, 50, 100];
                    if (!in_array($amount, $perpageOptions, true)) {
                        $perpageOptions[] = $amount;
                    }
                    sort($perpageOptions, SORT_NUMERIC);
                    ?>
                    <label class="nav-group">
                        <span class="sr-only"><?php echo _LISTS_PERPAGE; ?></span>
                        <select name="amount" onchange="this.form.submit()">
                            <?php
                            foreach ($perpageOptions as $perpageOption) {
                                $selected = ($perpageOption === $amount) ? ' selected' : '';
                                printf(
                                    '<option value="%d"%s>%d</option>',
                                    $perpageOption,
                                    $selected,
                                    $perpageOption
                                );
                            }
                            ?>
                        </select>
                        <span class="nav-label"><?php echo _LISTS_PERPAGE; ?></span>
                    </label>
                </div>

                <div class="nav-actions">
                    <button type="submit" name="start" value="<?php echo $prev; ?>" <?php
                    if ($start <= 0) {
                        echo 'disabled';
                    } ?>>&lt; <?php echo _LISTS_PREV; ?></button>
                    <button type="submit" name="start" value="<?php echo $next; ?>"><?php echo _LISTS_NEXT; ?> &gt;</button>
                </div>
            </div>
        </form>
        <?php
    }

    public static function getValidViewItemOption($name, $default = 'all')
    {
        $list = self::getFormSelectViewItemOptionLists();
        foreach ($list as $key) {
            if ($key == $name) {
                return $key;
            }
        }

        return $default;
    }

    public static function getFormSelectViewItemOptionLists()
    {
        $items = [
             'all','normal','normal_term','normal_term_future', 'normal_term_expired',
            'non_draft_term_expired','non_public_publishable','non_public_term_before',
            'non_public_term_during','non_public_expired',
            'term_invalid',
            'non_public',
            'draft',
            'draft_public',
            'draft_non_public',
        ];
        // non_publicは除外する
        $res = [];
        foreach ($items as $value) {
            if ( ! str_contains($value, 'non_public') && ! str_contains($value, 'non_draft_term_expired')) {
                $res[] = $value;
            }
        }
        return $res;
    }

    protected function getFormSelectViewItemOptions(
        $action,
        $blogid,
        $selected_catid = 0,
        $in_value = 'all',
        $input_name = 'view_item_options'
    ) {
        global $CONF;
        $list = self::getFormSelectViewItemOptionLists();
        if ( ! ITEM::existCol_ipublic()) {
            $list = ['all','normal','draft'];
        }

        if ( ! in_array($in_value, $list)) {
            $in_value = 'all';
        }

        // calc count
        static $count_cached = [];
        $cachekey            = sprintf('%d_%d', $blogid, $selected_catid);
        if ( ! isset($count_cached[$cachekey])) {
            global $member;
            $count_cached[$cachekey] = [];
            foreach ($list as $key) {
                if ('browseownitems' == $action) {
                    $sql = sprintf("SELECT count(*) FROM %s as i ", sql_tableQuote('item'))
                          . sprintf(" LEFT JOIN %s as m ON i.iauthor=m.mnumber ", sql_tableQuote('member'))
                          . sprintf(" LEFT JOIN %s as t ON i.iauthor=t.tmember AND i.iblog=t.tblog ", sql_tableQuote('team'))
                          . sprintf(" WHERE i.iauthor=%d ", $member->getID())
                          . ($selected_catid > 0 ? sprintf(' AND i.icat=%d', $selected_catid) : '');
                } else {
                    // show one blog
                    $sql = sprintf(
                        "SELECT count(*) as result FROM %s as i ",
                        sql_tableQuote('item')
                    )
                           . sprintf(
                               " LEFT JOIN %s as m ON i.iauthor=m.mnumber ",
                               sql_tableQuote('member')
                           )
                           . sprintf(
                               " LEFT JOIN %s as t ON i.iauthor=t.tmember AND i.iblog=t.tblog ",
                               sql_tableQuote('team')
                           )
                           . ' WHERE '
                           . sprintf(" i.iblog=%d ", $blogid)
                           . sprintf(
                               " AND (m.madmin='1' OR t.tadmin='1' OR i.iauthor=%d)",
                               $member->getID()
                           )
                           . ($selected_catid > 0 ? sprintf(
                               ' AND i.icat=%d',
                               $selected_catid
                           ) : '');
                }
                $query = $sql . ' '
                                                 . ADMIN::getQueryFilterForItemlist01(
                                                     $blogid,
                                                     $key
                                                 );
                $count_cached[$cachekey][$key] = (int) (quickQuery($query));
            }
        }

        $s = sprintf(
            '<select name="%s" onChange="this.form.submit()">',
            htmlentities($input_name, ENT_COMPAT, _CHARSET)
        );
        foreach ($list as $key) {
            if ('all' != $key && isset($count_cached[$cachekey][$key])
                && (0 == $count_cached[$cachekey][$key])) {
                continue;
            }
            $selected = ($key == $in_value ? ' selected' : '');
            $title    = '_LISTS_FORM_SELECT_ITEM_OPTION_' . strtoupper($key);
            $title    = hsc(defined($title) ? constant($title) : $key);
            $title .= sprintf(' (%d)', ($count_cached[$cachekey][$key] ?? 0));
            $s .= "\n\t\t" . sprintf(
                '<option value="%s"%s>%s</option>',
                $key,
                $selected,
                $title
            ) . "\n";
        }
        $s .= "\t\t</select>\n";

        return $s;
    }

    protected function getFormSelectCategoryBlog(
        $action,
        $blogid,
        $selected_catid = 0,
        $input_name = 'catid',
        $extraQuery = ''
    ) {
        global $member;

        if ('browseownitems' == $action) {
            return $this->getFormSelectCategoryOwn(
                $blogid,
                $selected_catid,
                $input_name,
                $extraQuery
            );
        }

        if ( ! $blogid) {
            return '';
        }
        if ( ! $member->teamRights($blogid) && ! $member->isAdmin()) {
            return '';
        }

        static $r  = [];
        $saved_key = sprintf(
            "%s_%d_%d_%s",
            $action,
            $blogid,
            $selected_catid,
            $input_name
        );
        if (isset($r[$saved_key])) {
            return $r[$saved_key];
        }

        $lists          = [];
        $selected       = false;
        $selected_catid = (int) $selected_catid;
        // @todo NP_MultipleCategories
        $sql = 'SELECT catid , cname , count(inumber) as count FROM '
                 . sql_table('category')
                 . ' LEFT JOIN ' . sql_tableQuote('item') . ' ON catid=icat '
                 . ' WHERE cblog=' . (int) $blogid
                 . " {$extraQuery} "
                 . ' group BY catid '
                 . ' ORDER BY corder ASC , cname ASC';
        $total = 0;
        $res   = sql_query($sql);
        if ($res) {
            while ($row = sql_fetch_assoc($res)) {
                $lists[] = sprintf(
                    '<option value="%d" %s>',
                    (int) ($row['catid']),
                    ((int) ($row['catid']) == $selected_catid ? 'selected'
                    : '')
                )
                           . hsc($row['cname'])
                           . sprintf('(%d)', $row['count']) . '</option>';
                $total += $row['count'];
                if ( ! $selected && (int) ($row['catid']) == $selected_catid) {
                    $selected = true;
                }
            }
        }

        $s = sprintf(
            '<select name="%s">',
            htmlentities($input_name, ENT_COMPAT, _CHARSET)
        );
        $s .= "\n\t\t" . '<option value="0"'
              . ($selected ? '' : ' selected')
              . ' >' . hsc(_LISTS_FORM_SELECT_ALL_CATEGORY)
              . sprintf('(%d)', $total) . "</option>\n";
        $s .= "\t\t" . implode("\n\t\t", $lists) . "\n";
        $s .= "\t\t</select>\n";

        $r[$saved_key] = $s;

        return $s;
    }

    protected function getFormSelectCategoryOwn(
        $blogid,
        $selected_catid = 0,
        $input_name = 'catid',
        $extraQuery = ''
    ) {
        global $member;
        static $r = [];

        $saved_key = sprintf(
            "%d_%d_%d_%s",
            $member->id,
            $blogid,
            $selected_catid,
            $input_name
        );
        if (isset($r[$saved_key])) {
            return $r[$saved_key];
        }

        $lists          = [];
        $selected       = false;
        $selected_catid = (int) $selected_catid;

        // blog(bnumber, bname or bshortname) , category(catid,cblog,cname,corder)
        $sql
            = 'SELECT bname, cblog, catid , cname , count(inumber) as count FROM '
              . sql_table('category')
              . ' LEFT JOIN ' . sql_table('item') . ' ON catid=icat '
              . ' LEFT JOIN ' . sql_table('blog') . ' ON cblog=bnumber '
              . ' WHERE iauthor=' . (int) ($member->id)
              //              . (($blogid>0) ? sprintf(' cblog=%d', $blogid) : '')
              . " {$extraQuery} "
              . ' group BY catid, bname ' // ERROR: 列"nucleus_blog.bname"はGROUP BY句で指定するか、集約関数内で使用しなければなりません
              . ' ORDER BY corder ASC , cname ASC';

        $total       = 0;
        $blog_titles = [];
        $res         = sql_query($sql);
        if ($res) {
            while ($row = sql_fetch_assoc($res)) {
                $b_id = $row['cblog'];
                if ( ! isset($blog_titles[$b_id])) {
                    $blog_titles[$b_id] = $row['bname'];
                }
                if ( ! isset($lists[$b_id])) {
                    $lists[$b_id] = [];
                }

                $lists[$b_id][] = sprintf(
                    '<option value="%d"%s>',
                    (int) ($row['catid']),
                    ((int) ($row['catid']) == $selected_catid ? ' selected'
                    : '')
                )
                                  . hsc($row['cname'])
                                  . sprintf('(%d)', $row['count'])
                                  . '</option>';
                $total += $row['count'];
                if ( ! $selected && (int) ($row['catid']) == $selected_catid) {
                    $selected = true;
                }
            }
        }

        asort($blog_titles);

        $s = sprintf(
            '<select name="%s">',
            htmlentities($input_name, ENT_COMPAT, _CHARSET)
        );
        $s .= "\n\t\t" . '<option value="0"'
              . ($selected ? '' : ' selected')
              . ' >' . hsc(_LISTS_FORM_SELECT_ALL_CATEGORY)
              . sprintf('(%d)', $total) . "</option>\n";

        // group
        foreach ($blog_titles as $b_id => $title) {
            $s .= sprintf(
                "\t" . '<optgroup label="%s">%s'
                          . "\n\t</optgroup>\n",
                htmlentities($title, ENT_COMPAT, _CHARSET),
                "\n\t\t" . implode("\n\t\t", $lists[$b_id])
            );
        }
        $s .= "\t\t</select>\n";

        $r[$saved_key] = $s;

        return $s;
    }
}
