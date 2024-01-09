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
 * A class used to encapsulate a list of some sort in a batch selection
 *
 * @property  type
 */
class BATCH extends ENCAPSULATE
{
    public $type;

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
        <?php
    }

    public function showOperationList()
    {
        global $manager;
        ?>
        <div class="batchoperations">
            <?php
            echo _BATCH_WITH_SEL ?>
            <select name="batchaction">
                <?php
                $options = [];
        switch ($this->type) {
            case 'item':
                $options = [
                    'delete' => _BATCH_ITEM_DELETE,
                    'move'   => _BATCH_ITEM_MOVE,
                ];
                break;
            case 'member':
                $options = [
                    'delete'     => _BATCH_MEMBER_DELETE,
                    'setadmin'   => _BATCH_MEMBER_SET_ADM,
                    'unsetadmin' => _BATCH_MEMBER_UNSET_ADM,
                ];
                break;
            case 'team':
                $options = [
                    'delete'     => _BATCH_TEAM_DELETE,
                    'setadmin'   => _BATCH_TEAM_SET_ADM,
                    'unsetadmin' => _BATCH_TEAM_UNSET_ADM,
                ];
                break;
            case 'category':
                $options = [
                    'change_corder' => _BATCH_CAT_CAHANGE_ORDER,
                    'delete'        => _BATCH_CAT_DELETE,
                    'move'          => _BATCH_CAT_MOVE,
                ];
                break;
            case 'comment':
                $options = [
                    'delete' => _BATCH_COMMENT_DELETE,
                ];
                break;
        }
        foreach ($options as $option => $label) {
            echo '<option value="', $option, '">', $label, '</option>';
        }
        ?>
            </select>
            <input type="hidden" name="action" value="batch<?php
            echo $this->type ?>"/>
            <?php
            $manager->addTicketHidden();

        // add hidden fields for 'team' and 'comment' batchlists
        if ('team' === $this->type) {
            echo '<input type="hidden" name="blogid" value="', intRequestVar('blogid'), '" />';
        }
        if ('comment' === $this->type) {
            echo '<input type="hidden" name="itemid" value="', intRequestVar('itemid'), '" />';
        }

        echo '<input type="submit" value="', _BATCH_EXEC, '" />';
        ?>(
            <a href=""
               onclick="if (event &amp;&amp; event.preventDefault) event.preventDefault(); return batchSelectAll(1); "><?php
            echo _BATCH_SELECTALL ?></a> -
            <a href=""
               onclick="if (event &amp;&amp; event.preventDefault) event.preventDefault(); return batchSelectAll(0); "><?php
            echo _BATCH_DESELECTALL ?></a>
            )
        </div>
        <?php
    }

    // shortcut :)
    public function showList($query, $type, $template, $errorMessage = _LISTS_NOMORE)
    {
        $call   = 'showlist';
        $params = [$query, $type, $template];

        return $this->doEncapsulate($call, $params, $errorMessage);
    }
}
