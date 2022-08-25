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
 */
/**
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) The Nucleus Group
 */

if (!function_exists('requestVar')) {
    exit;
}
require_once __DIR__ . '/BaseActions.php';

/**
 * This is the parser class of Nucleus. It is used for various things (skin parsing,
 * form generation, ...)
 */
class PARSER
{
    // array with the names of all allowed actions
    public $actions;

    // reference to actions handler
    public $handler;

    // delimiters that can be used for skin/templatevars
    public $delim;

    // parameter delimiter (to separate skinvar params)
    public $pdelim;

    // usually set to 0. When set to 1, all skinvars are allowed regardless of $actions
    public $norestrictions;

    /**
     * Creates a new parser object with the given allowed actions
     * and the given handler
     *
     * @param $allowedActions array
     * @param $handler class object with functions for each action (reference)
     * @param $delim optional delimiter
     * @param $paramdelim optional parameterdelimiter
     */
    public function __construct($allowedActions, &$handler, $delim = '(<%|%>)', $pdelim = ',')
    {
        $this->actions        = $allowedActions;
        $this->handler        = & $handler;
        $this->delim          = $delim;
        $this->pdelim         = $pdelim;
        $this->norestrictions = 0;    // set this to 1 to disable checking for allowedActions
    }

    /**
     * Parses the given contents and outputs it
     */
    public function parse(&$contents)
    {
        global $manager;
        if (is_null($contents)) {
            return;
        }
        if (!str_contains($contents, '<%')) {
            echo $contents;
            return;
        }
        $hashedTagBM = md5('<%BenchMark%>');
        if (str_contains($contents, '<%BenchMark%>')) {
            if (!$manager->pluginInstalled('NP_BenchMark')) {
                $contents = str_replace('<%BenchMark%>', $hashedTagBM, $contents);
            }
        }
        $hashedTagDI = md5('<%DebugInfo%>');
        if (str_contains($contents, '<%DebugInfo%>')) {
            if (!$manager->pluginInstalled('NP_DebugInfo')) {
                $contents = str_replace('<%DebugInfo%>', $hashedTagDI, $contents);
            }
        }

        $pieces = preg_split('/' . $this->delim . '/', $contents);

        $maxidx = count($pieces);
        for ($idx = 0; $idx < $maxidx; $idx++) {
            echo $pieces[$idx];
            $idx++;
            if ($idx < $maxidx) {
                $this->doAction($pieces[$idx]);
            }
        }
    }

    /**
     * Called from the parser to handle an action
     *
     * @param $action name of the action (e.g. blog, image ...)
     */
    public function doAction($action)
    {
        global $manager, $CONF, $doActionStack, $doActionCount;

        if (!$action) {
            return;
        }
        $raw_action = $action;
        // split into action name + arguments
        if (strstr($action, '(')) {
            $paramStartPos = strpos($action, '(');
            $params        = substr($action, $paramStartPos + 1, strlen($action) - $paramStartPos - 2);
            $action        = substr($action, 0, $paramStartPos);
            $params        = explode($this->pdelim, $params);

            foreach ($params as $key => $value) {
                $params[$key] = trim($value);
            }
        } else {
            // no parameters
            $params = array();
        }

        $actionlc = strtolower($action);

        // skip execution of skinvars while inside an if condition which hides this part of the page
        if (!$this->handler->if_currentlevel
            && ($actionlc !== 'else')
            && ($actionlc !== 'elseif')
            && ($actionlc !== 'endif')
            && ($actionlc !== 'ifnot')
            && ($actionlc !== 'elseifnot')
            && (substr($actionlc, 0, 2) !== 'if')) {
            return;
        }

        if (in_array($actionlc, $this->actions) || $this->norestrictions) {
            // when using PHP versions lower than 4.0.5, uncomment the line before
            // and comment the call_user_func_array call
            //$this->call_using_array($action, $this->handler, $params);
            $bt = microtime(true);
            call_user_func_array(array($this->handler, 'parse_' . $actionlc), $params);
            $doActionCount++;
            $et                            = microtime(true);
            $diff                          = number_format($et - $bt, 20);
            $hscAction                     = hsc("<%{$raw_action}%>");
            $doActionStack[$doActionCount] = "[{$doActionCount}] {$diff}s - {$hscAction}";
        } else {
            // redirect to plugin action if possible
//            define(DISABLE_PARSE_NP_PLUGIN, TRUE);
            if (!defined('DISABLE_PARSE_NP_PLUGIN') || !DISABLE_PARSE_NP_PLUGIN) {
                if ((strncmp($actionlc, 'np_', 3) == 0)
                    && in_array('plugin', $this->actions)
                    && ($manager->pluginInstalled($actionlc))) {
                    $action = substr($action, 3);
                }
            }
            if (in_array('plugin', $this->actions) && $manager->pluginInstalled("NP_{$action}")) {
                if (!HAS_CATCH_ERROR) {
                    $this->doAction('plugin(' . $action . $this->pdelim . implode($this->pdelim, $params) . ')');
                } else {
                    try {
                        $this->doAction('plugin(' . $action . $this->pdelim . implode($this->pdelim, $params) . ')');
                    } catch (Error $e) {
                        global $member, $CONF;
                        if ($member && $member->isLoggedIn() && $member->isAdmin()) {
                            $NP_Name = 'NP_' . $action;
                            $msg     = sprintf(
                                "php critical error in plugin(%s):[%s] Line:%d (%s) : ",
                                $NP_Name,
                                get_class($e),
                                $e->getLine(),
                                $e->getFile()
                            );
                            if ($CONF['DebugVars']) {
                                var_dump($e->getMessage());
                            }
                            SYSTEMLOG::addUnique('error', 'Error', $msg . $e->getMessage());
                            if (get_class($e) != 'ArgumentCountError') {
                                throw $e;
                            }
                        } else {
                            throw $e;
                        }
                    }
                }
            } else {
                if ($CONF['DebugVars'] == true) {
                    echo hsc('<%' . sprintf('%s(%s)', $action, implode($this->pdelim, $params)) . '%>');
                } elseif ($action === '_GET' && isset($params[0])) {
                    echo hsc($_GET[$params[0]]);
                }
            }
        }
    }

    /**
     * Calls a method using an array of parameters (for use with PHP versions lower than 4.0.5)
     * ( = call_user_func_array() function )
     */
    public function call_using_array($methodname, &$handler, $paramarray)
    {
        $methodname = 'parse_' . $methodname;

        if (!method_exists($handler, $methodname)) {
            return;
        }

        $command = 'call_user_func(array($handler,$methodname)';
        for ($i = 0; $i < count($paramarray); $i++) {
            $command .= ',$paramarray[' . $i . ']';
        }
        $command .= ');';
        eval($command);    // execute the correct method
    }

    /**
     * Set a property of the parser in the manager
     *
     * @param $property additional parser property (e.g. include prefix of the skin)
     * @param $value new value
     */
    public static function setProperty($property, $value)
    {
        global $manager;
        $manager->setParserProperty($property, $value);
    }

    /**
     * Get a property of the parser from the manager
     *
     * @param $name name of the property
     */
    public static function getProperty($name)
    {
        global $manager;
        return $manager->getParserProperty($name);
    }
}
