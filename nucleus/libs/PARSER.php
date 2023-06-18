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
 * @license   http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) The Nucleus Group
 */

if ( ! function_exists('requestVar')) {
    exit;
}
require_once __DIR__ . '/BaseActions.php';

/**
 * This is the parser class of Nucleus. It is used for various things (skin
 * parsing, form generation, ...)
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
     * @param $handler        class object with functions for each action
     *                         (reference)
     * @param $delim          optional delimiter
     * @param $paramdelim     optional parameterdelimiter
     */
    public function __construct(
        $allowedActions,
        &$handler,
        $delim = '<%,%>',
        $pdelim = ','
    ) {
        $this->actions = $allowedActions;
        $this->handler = & $handler;
        $this->delim   = $delim;
        $this->pdelim  = $pdelim;
        $this->norestrictions
                       = 0;    // set this to 1 to disable checking for allowedActions
    }

    /**
     * Parses the given contents and outputs it
     */
    public function parse(&$content)
    {
        if (null === $content) {
            return;
        }
        if ( ! str_contains($this->delim, ',')) {
            $this->legacyParse($content);

            return;
        }

        list($left, $right) = explode(',', $this->delim);

        if ( ! str_contains($content, $left)) {
            echo $content;

            return;
        }

        $pieces = explode($left, $content);
        foreach ($pieces as $piece) {
            if ( ! str_contains($piece, $right)) {
                echo $piece;
                continue;
            }
            list($action, $html) = explode($right, $piece, 2);
            $this->doAction($action);
            echo preg_replace('@^\n@', '', $html);
        }
    }

    public function legacyParse(&$contents)
    {
        $pieces = preg_split('/' . $this->delim . '/', $contents);
        $maxidx = count($pieces);
        foreach ($pieces as $idx => $idxValue) {
            echo $idxValue;
            $idx++;
            if ($idx < $maxidx) {
                $this->doAction($idxValue);
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
        global $manager;

        if ( ! $action) {
            return;
        }

        // split into action name + arguments
        if (str_contains($action, '(')) {
            list($action, $paramText) = explode('(', $action, 2);
            if (')' === substr($paramText, -1)) {
                $paramText = substr($paramText, 0, -1);
            }
            $params = explode($this->pdelim, $paramText);
            // trim parameters
            foreach ($params as $key => $value) {
                $params[$key] = trim($value);
            }
            $paramText = implode(',', $params);
        } else {
            // no parameters
            $params    = [];
            $paramText = '';
        }
        $actionlc = strtolower($action);

        // skip execution of skinvars while inside an if condition which hides this part of the page
        if ( ! $this->handler->if_currentlevel
             &&
             ! in_array($actionlc, ['else', 'elseif', 'endif', 'ifnot', 'elseifnot'])
             &&
             ! str_starts_with($actionlc, 'if')) {
            return;
        }

        if (in_array($actionlc, $this->actions) || $this->norestrictions) {
            call_user_func_array(
                [$this->handler, 'parse_' . $actionlc],
                $params
            );
        } elseif ('_' === $action) {
            // MARKER_FEATURE_LOCALIZATION_SKIN_TEXT
            global $manager;
            $paramText = trim($paramText);
            if (strlen($paramText) > 0) {
                // echo $this->handler->skin->_getText($paramText);
                echo $manager->_getText('skin', $paramText);
            }

            return;
        } elseif (in_array(
            $actionlc,
            [
                    'getvar',
                    'postvar',
                    'cookievar',
                    'requestvar',
                    'servervar',
                    'confvar',
            ]
        )
                  && isset($params[0])) {
            $default = isset($params[1]) ? $params[1] : '';
            echo hsc($actionlc($params[0], $default));
        } else {
            // redirect to plugin action if possible
            //            define(DISABLE_PARSE_NP_PLUGIN, TRUE);
            if ( ! defined('DISABLE_PARSE_NP_PLUGIN')
                 || ! DISABLE_PARSE_NP_PLUGIN) {
                if ((0 == strncmp($actionlc, 'np_', 3))
                    && in_array('plugin', $this->actions)
                    && ($manager->pluginInstalled($actionlc))) {
                    $action = substr($action, 3);
                }
            }
            if (in_array('plugin', $this->actions)
                && $manager->pluginInstalled('NP_' . $action)) {
                if ( ! HAS_CATCH_ERROR) {
                    $this->doAction(sprintf(
                        'plugin(%s%s%s)',
                        $action,
                        $this->pdelim,
                        implode($this->pdelim, $params)
                    ));
                } else {
                    try {
                        $this->doAction(sprintf(
                            'plugin(%s%s%s)',
                            $action,
                            $this->pdelim,
                            implode($this->pdelim, $params)
                        ));
                    } catch (Error $e) {
                        global $member;
                        if ($member && $member->isLoggedIn()
                            && $member->isAdmin()) {
                            $msg = sprintf(
                                'php critical error in plugin(%s):[%s] Line:%d (%s) : ',
                                'NP_' . $action,
                                get_class($e),
                                $e->getLine(),
                                $e->getFile()
                            );
                            if (confVar('DebugVars')) {
                                var_dump($e->getMessage());
                            }
                            SYSTEMLOG::addUnique(
                                'error',
                                'Error',
                                $msg . $e->getMessage()
                            );
                            if ('ArgumentCountError' !== get_class($e)) {
                                throw $e;
                            }
                        } else {
                            throw $e;
                        }
                    }
                }
            } elseif (confVar('DebugVars')) {
                echo '&lt;%', $action, '(', implode(
                    $this->pdelim,
                    $params
                ), ')%&gt;';
            }
        }
    }

    /**
     * Set a property of the parser in the manager
     *
     * @param $property additional parser property (e.g. include prefix of the
     *                   skin)
     */
    public static function setProperty($property, $value)
    {
        global $manager;
        $manager->setParserProperty($property, $value);
    }

    /**
     * Get a property of the parser from the manager
     *
     * @param $name string of the property
     */
    public static function getProperty($name)
    {
        global $manager;

        return $manager->getParserProperty($name);
    }
}
