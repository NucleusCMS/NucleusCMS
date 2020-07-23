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
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) The Nucleus Group

 * The formfactory class can be used to insert add/edit item forms into
 * admin area, bookmarklet, skins or any other places where such a form
 * might be needed
 */

class PAGEFACTORY extends BaseActions
{

    // ref to the blog object for which an add:edit form is created
    public $blog;

    // allowed actions (for parser)
    public $actions;

    // allowed types of forms (bookmarklet/admin)
    public $allowedTypes;
    public $type;        // one of the types in $allowedTypes

    // 'add' or 'edit'
    public $method;

    // info to fill out in the form (e.g. catid, itemid, ...)
    public $variables;

    /**
     * creates a new PAGEFACTORY object
     */
    function __construct($blogid)
    {
        // call constructor of superclass first
        parent::__construct();

        global $manager;
        $this->blog =& $manager->getBlog($blogid);

        // TODO: move the definition of actions to the createXForm
        // methods
        $this->actions = array(
            'actionurl',
            'title',
            'body',
            'more',
            'blogid',
            'bloglink',
            'blogname',
            'authorname',
            'checkedonval',
            'helplink',
            'currenttime',
            'itemtime',
            'init',
            'text',
            'jsinput',
            'jsbuttonbar',
            'categories',
            'contents',
            'ifblogsetting',
            'ifitemproperty',
            'else',
            'endif',
            'pluginextras',
            'itemoptions',
            'extrahead',
            'ticket',
            'autosave',
            'autosaveinfo',
            'ifautosave',
            'iftext',
            'checked_valtext',
            'inctabindex',
            'copytabindex',
            'tabindex',
            'settabindex'
        );

        // TODO: maybe add 'skin' later on?
        // TODO: maybe add other pages from admin area
        $this->allowedTypes = array('bookmarklet', 'admin');
    }

    public function PAGEFACTORY($blogid)
    {
        $this->__construct($blogid);
    }

    /**
     * creates a "add item" form for a given type of page
     *
     * @param type
     *        'admin' or 'bookmarklet'
     */
    function createAddForm($type, $contents = array())
    {
        if (!in_array($type, $this->allowedTypes)) {
            return;
        }
        $this->type = $type;
        $this->method = 'add';

        global $manager;
        $param = array(
            'contents' => &$contents,
            'blog' => &$this->blog
        );
        $manager->notify('PreAddItemForm', $param);

        $this->createForm($contents);
    }

    /**
     * creates a "add item" form for a given type of page
     *
     * @param type
     *        'admin' or 'bookmarklet'
     * @param contents
     *        An associative array
     *            'author' => author
     *            '' =>
     */
    function createEditForm($type, $contents)
    {
        if (!in_array($type, $this->allowedTypes)) {
            return;
        }
        $this->type = $type;
        $this->method = 'edit';
        $this->createForm($contents);
    }

    /**
     * (private) creates a form for a given type of page
     */
    function createForm($contents)
    {
        // save contents
        $this->variables = $contents;

        // get template to use
        $template = $this->getTemplateFor($this->type);

        // use the PARSER engine to parse that template
        $parser = new PARSER($this->actions, $this);
        $parser->parse($template);
    }

    /**
     * returns an appropriate template
     */
    function getTemplateFor($type)
    {
        global $DIR_LIBS;

        $filename = "{$DIR_LIBS}include/{$this->type}-{$this->method}.template";

        if (!is_file($filename)) {
            return '';
        }

        $contents = file_get_contents($filename);

        if (($contents !== false) && preg_match("#^(admin|bookmarklet)$#", $this->type) && preg_match("#^(add|edit)$#",
                $this->method, $m2)) {
            $this->replace_date_time_picker($contents);
        }

        return ($contents !== false ? $contents : '');
    }

    private function replace_date_time_picker(&$data)
    {
        $items = array();
        $spa = explode(',', _EDIT_DATE_FORMAT_SEPARATOR);
        foreach (array('itemtime', 'currenttime') as $stime) {
            $s = array();
            foreach (explode(',', _EDIT_DATE_FORMAT) as $key => $value) {
                switch ($value) {
                    case 'year' :
                        $s[] = '<input id="inputyear" name="year" tabindex="<%tabindex()%>" size="4" value="<%' . $stime . '(year)%>" onchange="document.forms[0].act_future.checked=true;" />';
                        break;
                    case 'month' :
                        $s[] = '<input id="inputmonth" name="month" tabindex="<%tabindex()%>" size="2" value="<%' . $stime . '(mon)%>" onchange="document.forms[0].act_future.checked=true;" />';
                        break;
                    case 'day' :
                        $s[] = '<input id="inputday" name="day" tabindex="<%tabindex()%>" size="2" value="<%' . $stime . '(mday)%>" onchange="document.forms[0].act_future.checked=true;" />';
                        break;
                }
                if (isset($spa[$key])) {
                    $s[] = $spa[$key];
                }
            }
            $s[] = '<input id="inputhour" name="hour" tabindex="<%tabindex()%>" size="2" value="<%' . $stime . '(hours)%>" onchange="document.forms[0].act_future.checked=true;" />';
            $key = 3;
            if (isset($spa[$key])) {
                $s[] = $spa[$key];
            }
            $s[] = '<input id="inputminutes" name="minutes" tabindex="<%tabindex()%>" size="2" value="<%' . $stime . '(minutes)%>" onchange="document.forms[0].act_future.checked=true;" />';
            $key = 4;
            if (isset($spa[$key])) {
                $s[] = $spa[$key];
            }
            $s[] = '<br />' . hsc(_ITEM_ADDEDITTEMPLATE_FORMAT) . hsc(_EDIT_DATE_FORMAT_DESC);

            $s[] = '<input tabindex="<%tabindex()%>" type="button" value="' . _ADD_DATEINPUTNOW . '" onclick = "document.forms[0].act_future.checked=true;  return edit_form_change_date_now();" />';
            $s[] = '<input tabindex="<%tabindex()%>" type="button" value="' . _ADD_DATEINPUTRESET . '" onclick = " return date_' . $stime . '_reset();" />';

            $items[$stime] = &$s;
            unset($s);
        }

        foreach ($items as $key => $value) {
            $items[$key] = implode("\n\t\t\t\t", $value);
        }
        $items['itemtime'] = str_replace('act_future.', 'act_changedate.', $items['itemtime']);

        $data = str_replace('<%date_time_picker%>', $items['currenttime'], $data);
        $data = str_replace('<%date_time_picker(currenttime)%>', $items['currenttime'], $data);
        $data = str_replace('<%date_time_picker(itemtime)%>', $items['itemtime'], $data);
    }

    // create category dropdown box
    function parse_categories($startidx = 0)
    {
        if (array_key_exists('catid', $this->variables) && $this->variables['catid']) {
            $catid = $this->variables['catid'];
        }                // on edit item
        else {
            $catid = $this->blog->getDefaultCategory();
        }        // on add item

        ADMIN::selectBlogCategory('catid', $catid, $startidx, 1, $this->blog->getID());
    }

    function parse_blogid()
    {
        echo $this->blog->getID();
    }

    function parse_blogname()
    {
        echo hsc($this->blog->getName());
    }

    function parse_bloglink()
    {
        echo '<a href="' . hsc($this->blog->getRealURL()) . '">' . hsc($this->blog->getName()) . '</a>';
    }

    function parse_authorname()
    {
        // don't use on add item?
        global $member;
        echo $member->getDisplayName();
    }

    function parse_title()
    {
        echo $this->contents['title'];
    }

    /**
     * Indicates the start of a conditional block of data. It will be added to
     * the output only if the blogsetting with the given name equals the
     * given value (default for value = 1 = true)
     *
     * the name of the blogsetting is the column name in the nucleus_blog table
     *
     * the conditional block ends with an <endif> var
     */
    function parse_ifblogsetting($name, $value = 1)
    {
        $this->_addIfCondition(($this->blog->getSetting($name) == $value));
    }

    function parse_ifitemproperty($name, $value = 1)
    {
        $this->_addIfCondition((isset($this->variables[$name]) && $this->variables[$name] == $value));
    }

    function parse_iftext($name, $value)
    {
        $flag = false;
        if (defined($name) && isset($value)) {
            $flag = (strcasecmp(constant($name), $value) == 0);
        }
        $this->_addIfCondition($flag);
    }

    function parse_ifautosave($name, $value = 1)
    {
        global $member;
        $this->_addIfCondition($member->getAutosave() == $value);
    }

    function parse_helplink($topic)
    {
        help($topic);
    }

    // for future items
    function parse_currenttime($what)
    {
        $nu = getdate($this->blog->getCorrectTime());
        echo $nu[$what];
    }

    // date change on edit item
    function parse_itemtime($what)
    {
        $itemtime = getdate($this->variables['timestamp']);
        echo $itemtime[$what];
    }

    // some init stuff for all forms
    function parse_init()
    {
        $authorid = ($this->method == 'edit') ? $this->variables['authorid'] : '';
        $this->blog->insertJavaScriptInfo($authorid);
    }

    // on bookmarklets only: insert extra html header information (by plugins)
    function parse_extrahead()
    {
        global $manager;

        $extrahead = '';

        $param = array(
            'extrahead' => &$extrahead
        );
        $manager->notify('BookmarkletExtraHead', $param);

        echo $extrahead;
    }

    // inserts some localized text
    function parse_text($which)
    {
        if (defined($which)) {
            echo strval(constant($which));
        } else {
            echo $which;    // this way we see where definitions are missing
        }

    }

    function parse_contents($which)
    {
        if (!isset($this->variables[$which])) {
            $this->variables[$which] = '';
        }
        echo hsc($this->variables[$which]);
    }

    function parse_checkedonval($value, $name)
    {
        if (!isset($this->variables[$name])) {
            $this->variables[$name] = '';
        }
        if ($this->variables[$name] == $value) {
            echo "checked='checked'";
        }
    }

    function parse_checked_valtext($name, $value)
    {
        if (!isset($this->variables[$name])) {
            $this->variables[$name] = '';
        }
        if (strcasecmp($this->variables[$name], $value) == 0) {
            echo "checked='checked'";
        }
    }

    // extra javascript for input and textarea fields
    function parse_jsinput($which)
    {
        global $CONF, $member;

        $attributes = " name=\"{$which}\"";
        $attributes .= " id=\"input{$which}\"";

        if ($CONF['DisableJsTools'] != 1) {
            $attributes .= ' onclick="storeCaret(this);"';
            $attributes .= ' onselect="storeCaret(this);"';
            if ($member->getAutosave()) {
                $attributes .= " onkeyup=\"storeCaret(this); updPreview('{$which}'); doMonitor();\"";
            } else {
                $attributes .= " onkeyup=\"storeCaret(this); updPreview('{$which}');\"";
            }
        } else {
            if ($CONF['DisableJsTools'] == 0) {
                $attributes .= ' onkeypress="shortCuts();"';
            }
            if ($member->getAutosave()) {
                $attributes .= ' onkeyup="doMonitor();"';
            }
        }
        echo $attributes;
    }

    // shows the javascript button bar
    function parse_jsbuttonbar($extrabuttons = "")
    {
        global $CONF;
        switch ($CONF['DisableJsTools']) {

            case "0":
                echo '<div class="jsbuttonbar">';

                $this->_jsbutton('cut', 'cutThis()', _ADD_CUT_TT . " (Ctrl + X)");
                $this->_jsbutton('copy', 'copyThis()', _ADD_COPY_TT . " (Ctrl + C)");
                $this->_jsbutton('paste', 'pasteThis()', _ADD_PASTE_TT . " (Ctrl + V)");
                $this->_jsbuttonspacer();
                $this->_jsbutton('bold', "boldThis()", _ADD_BOLD_TT . " (Ctrl + Shift + B)");
                $this->_jsbutton('italic', "italicThis()", _ADD_ITALIC_TT . " (Ctrl + Shift + I)");
                $this->_jsbutton('link', "ahrefThis()", _ADD_HREF_TT . " (Ctrl + Shift + A)");
                $this->_jsbuttonspacer();
                $this->_jsbutton('alignleft', "alignleftThis()", _ADD_ALIGNLEFT_TT);
                $this->_jsbutton('alignright', "alignrightThis()", _ADD_ALIGNRIGHT_TT);
                $this->_jsbutton('aligncenter', "aligncenterThis()", _ADD_ALIGNCENTER_TT);
                $this->_jsbuttonspacer();
                $this->_jsbutton('left', "leftThis()", _ADD_LEFT_TT);
                $this->_jsbutton('right', "rightThis()", _ADD_RIGHT_TT);


                if ($extrabuttons) {
                    $btns = explode('+', $extrabuttons);
                    $this->_jsbuttonspacer();
                    foreach ($btns as $button) {
                        switch ($button) {
                            case "media":
                                $this->_jsbutton('media', "addMedia()", _ADD_MEDIA_TT . " (Ctrl + Shift + M)");
                                break;
                            case "preview":
                                $this->_jsbutton('preview', "showedit()", _ADD_PREVIEW_TT);
                                break;
                        }
                    }
                }

                echo '</div>';

                break;
            case "2":
                echo '<div class="jsbuttonbar">';

                $this->_jsbutton('bold', "boldThis()", _ADD_BOLD_TT);
                $this->_jsbutton('italic', "italicThis()", _ADD_ITALIC_TT);
                $this->_jsbutton('link', "ahrefThis()", _ADD_HREF_TT);
                $this->_jsbuttonspacer();
                $this->_jsbutton('alignleft', "alignleftThis()", _ADD_ALIGNLEFT_TT);
                $this->_jsbutton('alignright', "alignrightThis()", _ADD_ALIGNRIGHT_TT);
                $this->_jsbutton('aligncenter', "aligncenterThis()", _ADD_ALIGNCENTER_TT);
                $this->_jsbuttonspacer();
                $this->_jsbutton('left', "leftThis()", _ADD_LEFT_TT);
                $this->_jsbutton('right', "rightThis()", _ADD_RIGHT_TT);


                if ($extrabuttons) {
                    $btns = explode('+', $extrabuttons);
                    $this->_jsbuttonspacer();
                    foreach ($btns as $button) {
                        switch ($button) {
                            case "media":
                                $this->_jsbutton('media', "addMedia()", _ADD_MEDIA_TT);
                                break;
                        }
                    }
                }

                echo '</div>';

                break;
        }
    }

    /**
     * Allows plugins to add their own custom fields
     */
    function parse_pluginextras()
    {
        global $manager;

        switch ($this->method) {
            case 'add':
                $param = array(
                    'blog' => &$this->blog
                );
                $manager->notify('AddItemFormExtras', $param);
                break;
            case 'edit':
                $param = array(
                    'variables' => $this->variables,
                    'blog' => &$this->blog,
                    'itemid' => $this->variables['itemid']
                );
                $manager->notify('EditItemFormExtras', $param);
                break;
        }
    }

    /**
     * Adds the itemOptions of a plugin to a page
     * @author TeRanEX
     */
    function parse_itemoptions()
    {
        global $itemid;
        ADMIN::_insertPluginOptions('item', $itemid);
    }

    function parse_ticket()
    {
        global $manager;
        $manager->addTicketHidden();
    }

    function parse_tabindex($inc = 1, $key = "")
    {
        global $manager;
        $name = 'tabindex' . $key;
        $value = 0;
        if (is_string($inc) && strlen($inc) == 0) {
            $inc = 1;
        }
        $inc = intval($inc);
        if (isset($manager->parserPrefs[$name])) {
            $value = intval($manager->getParserProperty($name));
        }
        printf("%d", $value);
        if ($inc !== 0) {
            $manager->setParserProperty($name, $value + $inc);
        }
    }

    function parse_settabindex($baseindex, $inc = 0, $key = "")
    {
        global $manager;
        if (is_string($inc) && strlen($inc) == 0) {
            $inc = 1;
        }
        $name = 'tabindex' . $key;
        $value = intval($baseindex) + intval($inc);
        $manager->setParserProperty($name, $value);
    }

    function parse_copytabindex($keyfrom = "", $keyto = "0")
    {
        global $manager;
        $namefrom = 'tabindex' . $keyfrom;
        if (is_string($keyto) && strlen($keyto) == 0) {
            $keyto = "0";
        }
        $nameto = 'tabindex' . $keyto;
        $value = "";
        if (isset($manager->parserPrefs[$namefrom])) {
            $value = intval($manager->getParserProperty($namefrom));
        }
        $manager->setParserProperty($nameto, $value);
    }

    function parse_inctabindex($inc = 1, $key = "")
    {
        global $manager;
        if (is_string($inc) && strlen($inc) == 0) {
            $inc = 1;
        }
        $name = 'tabindex' . $key;
        $value = 0;
        $inc = intval($inc);
        if (isset($manager->parserPrefs[$name])) {
            $value = intval($manager->getParserProperty($name));
        }
        if ($inc !== 0) {
            $manager->setParserProperty($name, $value + $inc);
        }
    }

    /**
     * convenience method
     */
    function _jsbutton($type, $code, $tooltip)
    {
        ?>
        <span class="jsbutton"
              onmouseover="BtnHighlight(this);"
              onmouseout="BtnNormal(this);"
              onclick="<?php echo $code ?>">
                <img src="images/button-<?php echo $type ?>.gif" alt="<?php echo $tooltip ?>"
                     title="<?php echo $tooltip ?>" width="16" height="16"/>
            </span>
    <?php }

    function _jsbuttonspacer()
    {
        echo '<span class="jsbuttonspacer">&nbsp;</span>';
    }

}

