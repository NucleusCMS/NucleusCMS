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
 *    This class contains two classes that can be used for importing and
 *    exporting Nucleus skins: SKINIMPORT and SKINEXPORT
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) The Nucleus Group
 */

class SKINEXPORT
{
    public $templates;
    public $skins;
    public $info;

    /**
     * Constructor initializes data structures
     */
    public function __construct()
    {
        // list of templateIDs to export
        $this->templates = [];

        // list of skinIDs to export
        $this->skins = [];

        // extra info to be in XML file
        $this->info = '';
    }

    /**
     * Adds a template to be exported
     *
     * @param   id
     *        template ID
     *
     * @result false when no such ID exists
     */
    public function addTemplate($id)
    {
        if (! TEMPLATE::existsID($id)) {
            return 0;
        }

        $this->templates[$id] = TEMPLATE::getNameFromId($id);

        return 1;
    }

    /**
     * Adds a skin to be exported
     *
     * @param   id
     *        skin ID
     *
     * @result false when no such ID exists
     */
    public function addSkin($id)
    {
        if (! SKIN::existsID($id)) {
            return 0;
        }

        $this->skins[$id] = SKIN::getNameFromId($id);

        return 1;
    }

    /**
     * Sets the extra info to be included in the exported file
     */
    public function setInfo($info)
    {
        $this->info = $info;
    }

    /**
     * Outputs the XML contents of the export file
     *
     * @param $setHeaders
     *        set to 0 if you don't want to send out headers
     *        (optional, default 1)
     */
    public function export($setHeaders = 1)
    {
        if ($setHeaders) {
            // make sure the mimetype is correct, and that the data does not show up
            // in the browser, but gets saved into and XML file (popup download window)
            header('Content-Type: text/xml');
            header('Content-Disposition: attachment; filename="skinbackup.xml"');
            header('Expires: 0');
            header('Pragma: no-cache');
        }

        // sort by skinname , templatename
        asort($this->skins);
        asort($this->templates);

        $has_mb_func = function_exists('mb_convert_encoding');

        echo "<nucleusskin>\n";

        // export as UTF-8 character set

        // meta
        echo "\t<meta>\n";
        // skins
        foreach ($this->skins as $skinId => $skinName) {
            $skinName = hsc($skinName, ENT_QUOTES);
            if ($has_mb_func && strtoupper(_CHARSET) != 'UTF-8') {
                $skinName = mb_convert_encoding($skinName, 'UTF-8', _CHARSET);
            }
            echo "\t\t" . '<skin name="' . hsc($skinName, ENT_QUOTES) . '" />'
                 . "\n";
        }
        // templates
        foreach ($this->templates as $templateId => $templateName) {
            $templateName = hsc($templateName, ENT_QUOTES);
            if ($has_mb_func && strtoupper(_CHARSET) != 'UTF-8') {
                $templateName = mb_convert_encoding(
                    $templateName,
                    'UTF-8',
                    _CHARSET
                );
            }
            echo "\t\t" . '<template name="' . hsc($templateName, ENT_QUOTES)
                 . '" />' . "\n";
        }
        // extra info
        if ($this->info) {
            if ($has_mb_func && strtoupper(_CHARSET) != 'UTF-8') {
                $skin_info = mb_convert_encoding(
                    $this->info,
                    'UTF-8',
                    _CHARSET
                );
            } else {
                $skin_info = $this->info;
            }
            echo "\t\t<info><![CDATA[" . $skin_info . "]]></info>\n";
        }
        echo "\t</meta>\n\n\n";

        // contents skins
        foreach ($this->skins as $skinId => $skinName) {
            $skinId   = (int)$skinId;
            $skinObj  = new SKIN($skinId);
            $skinName = hsc($skinName, ENT_QUOTES);
            $contentT = hsc($skinObj->getContentType(), ENT_QUOTES);
            $incMode  = hsc($skinObj->getIncludeMode(), ENT_QUOTES);
            $incPrefx = hsc($skinObj->getIncludePrefix(), ENT_QUOTES);
            $skinDesc = hsc($skinObj->getDescription(), ENT_QUOTES);
            if ($has_mb_func && strtoupper(_CHARSET) != 'UTF-8') {
                $skinName = mb_convert_encoding($skinName, 'UTF-8', _CHARSET);
                $contentT = mb_convert_encoding($contentT, 'UTF-8', _CHARSET);
                $incMode  = mb_convert_encoding($incMode, 'UTF-8', _CHARSET);
                $incPrefx = mb_convert_encoding($incPrefx, 'UTF-8', _CHARSET);
                $skinDesc = mb_convert_encoding($skinDesc, 'UTF-8', _CHARSET);
            }

            echo "\t" . '<skin name="' . $skinName . '" type="' . $contentT
                 . '" includeMode="' . $incMode . '" includePrefix="'
                 . $incPrefx . '">' . "\n";

            echo "\t\t" . '<description>' . $skinDesc . '</description>' . "\n";

            $suborder2 = "CASE WHEN spartstype = 'specialpage' THEN 1"
                         . " WHEN stype NOT IN ('index', 'item', 'error', 'search', 'archive', 'archivelist', 'imagepopup', 'member') THEN 1"
                         . " ELSE 0"
                         . " END AS suborder2";

            $sql
                 = sprintf(
                     "SELECT stype, scontent, spartstype, %s FROM `%s` WHERE sdesc = %d",
                     $suborder2,
                     sql_table('skin'),
                     intval($skinId)
                 );
            $sql .= " ORDER BY spartstype ASC, suborder2 ASC, stype ASC";
            $res = sql_query($sql);
            while ($partObj = sql_fetch_object($res)) {
                $type   = escapeHTML($partObj->stype, ENT_QUOTES);
                $cdata  = $this->escapeCDATA($partObj->scontent);
                $tmptag = ($partObj->spartstype == 'specialpage' ? 'specialpage'
                    : 'part');
                if (strtoupper(_CHARSET) != 'UTF-8') {
                    $type  = mb_convert_encoding($type, 'UTF-8', _CHARSET);
                    $cdata = mb_convert_encoding($cdata, 'UTF-8', _CHARSET);
                }
                printf("\t\t" . '<%s name="%s">', $tmptag, $type);
                echo '<![CDATA[' . $cdata . ']]>';
                echo "</{$tmptag}>\n\n";
            }

            echo "\t</skin>\n\n\n";
        }

        // contents templates
        foreach ($this->templates as $templateId => $templateName) {
            $templateId   = (int)$templateId;
            $templateName = hsc($templateName, ENT_QUOTES);
            $templateDesc = hsc(TEMPLATE::getDesc($templateId), ENT_QUOTES);
            if ($has_mb_func && strtoupper(_CHARSET) != 'UTF-8') {
                $templateName = mb_convert_encoding(
                    $templateName,
                    'UTF-8',
                    _CHARSET
                );
                $templateDesc = mb_convert_encoding(
                    $templateDesc,
                    'UTF-8',
                    _CHARSET
                );
            }

            echo "\t" . '<template name="' . $templateName . '">' . "\n";

            echo "\t\t" . '<description>' . $templateDesc . "</description>\n";

            $que
                 = sprintf(
                     'SELECT tpartname, tcontent FROM `%s` WHERE tdesc=%d',
                     sql_table('template'),
                     $templateId
                 );
            $res = sql_query($que);
            while ($partObj = sql_fetch_object($res)) {
                $type  = hsc($partObj->tpartname, ENT_QUOTES);
                $cdata = $this->escapeCDATA($partObj->tcontent);
                if ($has_mb_func && strtoupper(_CHARSET) != 'UTF-8') {
                    $type  = mb_convert_encoding($type, 'UTF-8', _CHARSET);
                    $cdata = mb_convert_encoding($cdata, 'UTF-8', _CHARSET);
                }
                echo "\t\t" . '<part name="' . $type . '">';
                echo '<![CDATA[' . $cdata . ']]>';
                echo '</part>' . "\n\n";
            }

            echo "\t</template>\n\n\n";
        }

        echo '</nucleusskin>';
    }

    /**
     * Escapes CDATA content so it can be included in another CDATA section
     */
    public function escapeCDATA($cdata)
    {
        return preg_replace('/]]>/', ']]]]><![CDATA[>', $cdata);
    }
}
