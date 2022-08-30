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

class ENCAPSULATE
{
    /**
      * Uses $call to call a function using parameters $params
      * This function should return the amount of entries shown.
      * When entries are show, batch operation handlers are shown too.
      * When no entries were shown, $errormsg is used to display an error
      *
      * Passes on the amount of results found (for further encapsulation)
      */
    public function doEncapsulate(&$call, &$params, $errorMessage = _ENCAPSULATE_ENCAPSULATE_NOENTRY)
    {
        // start output buffering
        ob_start();

        $nbOfRows = call_user_func_array($call, $params);

        // get list contents and stop buffering
        $list = ob_get_contents();
        ob_end_clean();

        if ($nbOfRows > 0) {
            $this->showHead();
            echo $list;
            $this->showFoot();
        } else {
            echo $errorMessage;
        }

        return $nbOfRows;
    }
}

/**
  * A class used to encapsulate a list of some sort inside next/prev buttons
  */
class NAVLIST extends ENCAPSULATE
{
    public $total = null;

    public function __construct($action, $start, $amount, $minamount, $maxamount, $blogid, $search, $itemid)
    {
        $this->action    = $action;
        $this->start     = $start;
        $this->amount    = $amount;
        $this->minamount = $minamount;
        $this->maxamount = $maxamount;
        $this->blogid    = $blogid;
        $this->search    = $search;
        $this->itemid    = $itemid;
    }

    public function showBatchList($batchtype, &$query, $type, $template, $errorMessage = _LISTS_NOMORE)
    {
        $batch  = new BATCH($batchtype);
        $call   = array($batch, 'showlist');
        $params = array(&$query, $type, $template);
        $this->doEncapsulate($call, $params, $errorMessage);
    }

    public function showHead()
    {
        $this->showNavigation();
    }
    public function showFoot()
    {
        $this->showNavigation();
    }

    /**
      * Displays a next/prev bar for long tables
      */
    public function showNavigation()
    {
        $action    = $this->action;
        $start     = $this->start;
        $amount    = $this->amount;
        $minamount = $this->minamount;
        $maxamount = $this->maxamount;
        $blogid    = $this->blogid;
        $search    = hsc($this->search);
        $itemid    = $this->itemid;

        $prev = $start - $amount;
        if ($prev < $minamount) {
            $prev = $minamount;
        }

        $enable_cat_select = in_array($action, array('itemlist' , 'browseownitems'));
        if ($enable_cat_select) {
            $catid = isset($_POST['catid']) ? max(0, intval($_POST['catid'])) : 0;
        }

        // maxamount not used yet
    //    if ($start + $amount <= $maxamount)
        $next = $start + $amount;
    //    else
    //        $next = $start;

        ?>
    <table class="navigation">
    <tr><td>
        <form method="post" action="index.php"><div>
        <input type="submit" value="&lt;&lt; <?php echo  _LISTS_PREV?>" />
        <input type="hidden" name="blogid" value="<?php echo  $blogid; ?>" />
        <input type="hidden" name="itemid" value="<?php echo  $itemid; ?>" />
        <?php if ($enable_cat_select) {
            echo '<input type="hidden" name="catid" value="' . $catid . '" />';
        } ?>
        <input type="hidden" name="action" value="<?php echo  $action; ?>" />
        <input type="hidden" name="amount" value="<?php echo  $amount; ?>" />
        <input type="hidden" name="search" value="<?php echo  $search; ?>" />
        <input type="hidden" name="start" value="<?php echo  $prev; ?>" />
        </div></form>
    </td><td>
        <form method="post" action="index.php"><div>
        <input type="hidden" name="blogid" value="<?php echo  $blogid; ?>" />
        <input type="hidden" name="itemid" value="<?php echo  $itemid; ?>" />
        <?php if ($enable_cat_select) {
            echo '<input type="hidden" name="catid" value="' . $catid . '" />';
        } ?>
        <input type="hidden" name="action" value="<?php echo  $action; ?>" />
        <input name="amount" size="3" value="<?php echo  $amount; ?>" /> <?php echo _LISTS_PERPAGE?>
        <input type="hidden" name="start" value="<?php echo  $start; ?>" />
        <input type="hidden" name="search" value="<?php echo  $search; ?>" />
        <input type="submit" value="&gt; <?php echo _LISTS_CHANGE?>" />
        </div></form>
    </td><td>
        <form method="post" action="index.php"><div>
        <?php if ($enable_cat_select) {
            echo $this->getFormSelectCategoryBlog($action, $blogid, $catid);
        } ?>
        <input type="hidden" name="blogid" value="<?php echo  $blogid; ?>" />
        <input type="hidden" name="itemid" value="<?php echo  $itemid; ?>" />
        <input type="hidden" name="action" value="<?php echo  $action; ?>" />
        <input type="hidden" name="amount" value="<?php echo  $amount; ?>" />
        <input type="hidden" name="start" value="0" />
        <input type="text" name="search" value="<?php echo  $search; ?>" size="16" />
        <input type="submit" value="&gt; <?php echo  _LISTS_SEARCH?>" />
        </div></form>
    </td><td>
        <form method="post" action="index.php"><div>
        <input type="submit" value="<?php echo _LISTS_NEXT?> &gt; &gt;" />
        <input type="hidden" name="search" value="<?php echo  $search; ?>" />
        <input type="hidden" name="blogid" value="<?php echo  $blogid; ?>" />
        <input type="hidden" name="itemid" value="<?php echo  $itemid; ?>" />
        <?php if ($enable_cat_select) {
            echo '<input type="hidden" name="catid" value="' . $catid . '" />';
        } ?>
        <input type="hidden" name="action" value="<?php echo  $action; ?>" />
        <input type="hidden" name="amount" value="<?php echo  $amount; ?>" />
        <input type="hidden" name="start" value="<?php echo  $next; ?>" />
        </div></form>
    </td></tr>
    </table>
    <?php    }

    protected function getFormSelectCategoryBlog($action, $blogid, $selected_catid = 0, $input_name = 'catid')
    {
        global $member;

        if ($action == 'browseownitems') {
            return $this->getFormSelectCategoryOwn($blogid, $selected_catid, $input_name);
        }

        if (!$blogid) {
            return '';
        }
        if (!$member->teamRights($blogid) && !$member->isAdmin()) {
            return '';
        }

        static $r  = array();
        $saved_key = sprintf("%s_%d_%d_%s", $action, $blogid, $selected_catid, $input_name);
        if (isset($r[$saved_key])) {
            return $r[$saved_key];
        }

        $lists          = array();
        $selected       = false;
        $selected_catid = intval($selected_catid);
        // @todo NP_MultipleCategories
        $sql = 'SELECT catid , cname , count(inumber) as count FROM ' . sql_table('category')
              . ' LEFT JOIN `' . sql_table('item') . '` ON catid=icat '
              . ' WHERE cblog=' . intval($blogid)
              . ' group BY catid '
              . ' ORDER BY corder ASC , cname ASC';
        $total = 0;
        $res   = sql_query($sql);
        if ($res) {
            while ($row = sql_fetch_assoc($res)) {
                $lists[] = sprintf('<option value="%d" %s>', intval($row['catid']), (intval($row['catid']) == $selected_catid ? 'selected' : ''))
                         . hsc($row['cname'])
                         . sprintf('(%d)', $row['count']) . '</option>';
                $total += $row['count'];
                if (!$selected && intval($row['catid']) == $selected_catid) {
                    $selected = true;
                }
            }
        }

        $s = sprintf('<select name="%s">', htmlentities($input_name, ENT_COMPAT, _CHARSET));
        $s .= "\n\t\t".'<option value="0"'
              . ($selected ? '' : 'selected')
              .' >' . hsc(_LISTS_FORM_SELECT_ALL_CATEGORY)
              . sprintf('(%d)', $total) . "</option>\n";
        $s .= "\t\t".implode("\n\t\t", $lists)."\n";
        $s .= "\t\t</select>\n";

        $r[$saved_key] = $s;
        return $s;
    }

    protected function getFormSelectCategoryOwn($blogid, $selected_catid = 0, $input_name = 'catid')
    {
        global $member;
        static $r = array();

        $saved_key = sprintf("%d_%d_%d_%s", $member->id, $blogid, $selected_catid, $input_name);
        if (isset($r[$saved_key])) {
            return $r[$saved_key];
        }

        $lists          = array();
        $selected       = false;
        $selected_catid = intval($selected_catid);

        // blog(bnumber, bname or bshortname) , category(catid,cblog,cname,corder)
        $sql = 'SELECT bname, cblog, catid , cname , count(inumber) as count FROM ' . sql_table('category')
              . ' LEFT JOIN ' . sql_table('item') . ' ON catid=icat '
              . ' LEFT JOIN ' . sql_table('blog') . ' ON cblog=bnumber '
              . ' WHERE iauthor=' . intval($member->id)
//              . (($blogid>0) ? sprintf(' cblog=%d', $blogid) : '')
              . ' group BY catid '
              . ' ORDER BY corder ASC , cname ASC';

        $total       = 0;
        $blog_titles = array();
        $res         = sql_query($sql);
        if ($res) {
            while ($row = sql_fetch_assoc($res)) {
                $b_id = $row['cblog'];
                if (!isset($blog_titles[$b_id])) {
                    $blog_titles[$b_id] = $row['bname'];
                }
                if (!isset($lists[$b_id])) {
                    $lists[$b_id] = array();
                }

                $lists[$b_id][] = sprintf('<option value="%d" %s>', intval($row['catid']), (intval($row['catid']) == $selected_catid ? 'selected' : ''))
                         . hsc($row['cname'])
                         . sprintf('(%d)', $row['count']) . '</option>';
                $total += $row['count'];
                if (!$selected && intval($row['catid']) == $selected_catid) {
                    $selected = true;
                }
            }
        }

        asort($blog_titles);

        $s = sprintf('<select name="%s">', htmlentities($input_name, ENT_COMPAT, _CHARSET));
        $s .= "\n\t\t".'<option value="0"'
              . ($selected ? '' : 'selected')
              .' >' . hsc(_LISTS_FORM_SELECT_ALL_CATEGORY)
              . sprintf('(%d)', $total) . "</option>\n";

        // group
        foreach ($blog_titles as $b_id => $title) {
            $s .= sprintf(
                "\t<optgroup label='%s'>%s\n\t</optgroup>\n",
                htmlentities($title, ENT_COMPAT, _CHARSET),
                "\n\t\t".implode("\n\t\t", $lists[$b_id])
            );
        }
        $s .= "\t\t</select>\n";

        $r[$saved_key] = $s;
        return $s;
    }
}

/**
 * A class used to encapsulate a list of some sort in a batch selection
 */
class BATCH extends ENCAPSULATE
{
    public function __construct($type)
    {
        $this->type = $type;
    }

    public function showHead()
    {
        ?>
            <form method="post" action="index.php">
        <?php
// TODO: get a list op operations above the list too
// (be careful not to use the same names for the select...)
//        $this->showOperationList();
    }

    public function showFoot()
    {
        $this->showOperationList();
        ?>
            </form>
        <?php    }

    public function showOperationList()
    {
        global $manager;
        ?>
        <div class="batchoperations">
            <?php echo _BATCH_WITH_SEL ?>
            <select name="batchaction">
            <?php                $options = array();
        switch($this->type) {
            case 'item':
                $options = array(
                    'delete' => _BATCH_ITEM_DELETE,
                    'move'   => _BATCH_ITEM_MOVE
                );
                break;
            case 'member':
                $options = array(
                    'delete'     => _BATCH_MEMBER_DELETE,
                    'setadmin'   => _BATCH_MEMBER_SET_ADM,
                    'unsetadmin' => _BATCH_MEMBER_UNSET_ADM
                );
                break;
            case 'team':
                $options = array(
                    'delete'     => _BATCH_TEAM_DELETE,
                    'setadmin'   => _BATCH_TEAM_SET_ADM,
                    'unsetadmin' => _BATCH_TEAM_UNSET_ADM,
                );
                break;
            case 'category':
                $options = array(
                    'change_corder' => _BATCH_CAT_CAHANGE_ORDER ,
                    'delete'        => _BATCH_CAT_DELETE,
                    'move'          => _BATCH_CAT_MOVE,
                );
                break;
            case 'comment':
                $options = array(
                    'delete' => _BATCH_COMMENT_DELETE,
                );
                break;
        }
        foreach ($options as $option => $label) {
            echo '<option value="',$option,'">',$label,'</option>';
        }
        ?>
            </select>
            <input type="hidden" name="action" value="batch<?php echo $this->type?>" />
            <?php
            $manager->addTicketHidden();

        // add hidden fields for 'team' and 'comment' batchlists
        if ($this->type == 'team') {
            echo '<input type="hidden" name="blogid" value="',intRequestVar('blogid'),'" />';
        }
        if ($this->type == 'comment') {
            echo '<input type="hidden" name="itemid" value="',intRequestVar('itemid'),'" />';
        }

        echo '<input type="submit" value="',_BATCH_EXEC,'" />';
        ?>(
             <a href="" onclick="if (event &amp;&amp; event.preventDefault) event.preventDefault(); return batchSelectAll(1); "><?php echo _BATCH_SELECTALL?></a> -
             <a href="" onclick="if (event &amp;&amp; event.preventDefault) event.preventDefault(); return batchSelectAll(0); "><?php echo _BATCH_DESELECTALL?></a>
            )
        </div>
        <?php    }

    // shortcut :)
    public function showList($query, $type, $template, $errorMessage = _LISTS_NOMORE)
    {
        $call   = 'showlist';
        $params = array($query, $type, $template);
        return $this->doEncapsulate($call, $params, $errorMessage);
    }
}
