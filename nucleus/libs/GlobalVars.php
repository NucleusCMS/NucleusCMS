<?php

//class SampleVar
//{
//    use BaseGlobalVar;
//    const varname = 'Sample';
//    const casecmp = true;
//    const readonly = false;
//}

trait BaseGlobalVar
{
    protected static function &getGlobalVar()
    {
        $res = null;
        if (defined('self::varname')) {
            $varname = constant('self::varname');
            if (isset($GLOBALS[$varname])) {
                $res = & $GLOBALS[$varname];
            }
        }
        return $res;
    }

    public static function setValue($name, $value)
    {
        if (($name !== null) && defined('self::varname')) {
            $varname = constant('self::varname');
            if (!defined('self::readonly') || !constant('self::readonly')) {
                trigger_error(sprintf('Error: %s : %s is readonly', self::class, $varname), E_USER_WARNING);
                return false;
            }
            if (isset($GLOBALS[$varname])) {
                $GLOBALS[$varname][$name] = $value;
                return isset($GLOBALS[$varname][$name]);
            }
        }
        return false;
    }

    public static function searchValidKey($name)
    {
        if (($name === null)) {
            return false;
        }

        $VAR = & self::getGlobalVar();
        if (empty($VAR) || !is_array($VAR)) {
            return false;
        }

        if (isset($VAR[$name])) {
            return $name;
        }

        $casecmp = true;
        if (defined('self::casecmp')) {
            $casecmp = (bool)constant('self::casecmp');
        }

        if ($casecmp) {
            foreach ($VAR as $k => $v) {
                if (strcasecmp((string)$k, (string)$name) == 0) {
                    return (string)$k;
                }
            }
        }

        return false;
    }

    public static function existName($name)
    {
        return (false !== self::searchValidKey($name));
    }

    public static function getValue($name, $default = null)
    {
        if (($name === null) || !defined('self::varname')) {
            return false;
        }

        $VAR = & self::getGlobalVar();
        if (empty($VAR) || !is_array($VAR)) {
            return false;
        }

        if (isset($VAR[$name])) {
            return $VAR[$name];
        }

        return $default;
    }

    public static function value($name, $default = null)
    {
        return self::getValue($name, $default);
    }

    public static function valueAsInt($name, $default = 0)
    {
        if (!self::existName($name)) {
            return (int)$default;
        }

        return (int)self::value($name, $default);
    }

    public static function valueAsString($name, $default = '')
    {
        if (!self::existName($name)) {
            return (string)$default;
        }

        return (string)self::value($name, $default);
    }

    public static function valueAsBool($name, $default = false)
    {
        if (!self::existName($name)) {
            return (bool)$default;
        }

        return (bool)self::value($name, $default);
    }

    public static function isStr($name)
    {
        $v = self::value($name);
        return is_string($v);
    }

    public static function isInt($name)
    {
        $v = self::value($name);
        return is_int($v);
    }

    public static function asInt($name, $default = 0)
    {
        return self::valueAsInt($name, $default);
    }

    public static function asBool($name, $default = false)
    {
        return (bool)self::valueAsBool($name, $default);
    }

    public static function asStr($name, $default = '')
    {
        return self::valueAsString($name, $default);
    }

    public static function asHtmlEscaped($name, $default = '', $flags = ENT_QUOTES)
    {
        return self::asHsc($name, $default, (int)$flags);
    }

    public static function asHsc($name, $default = '', $flags = ENT_QUOTES)
    {
        // hsc : HtmlSpecialChars
        return htmlspecialchars(self::valueAsString($name, $default), (int)$flags, _CHARSET);
    }

    public static function asHscTrimed($name, $default = '', $flags = ENT_QUOTES)
    {
        return htmlspecialchars(trim(self::valueAsString($name, $default)), (int)$flags, _CHARSET);
    }

    public static function asHscWithPathSlash($name, $default = '', $flags = ENT_QUOTES)
    {
        return htmlspecialchars(self::asStrWithPathSlash($name, $default), (int)$flags, _CHARSET);
    }

    public static function asStrWithPathSlash($name, $default = '')
    {
        $v = str_replace('\\', '/', trim(self::valueAsString($name, $default)));
        if ((strlen($v) > 0) && !str_ends_with($v, '/')) {
            $v .= '/';
        }
        return $v;
    }

    public static function asStrTrimed($name, $default = '')
    {
        return trim(self::valueAsString($name, $default));
    }

    public static function setValueWithPathSlash($name, $value)
    {
        $v = str_replace('\\', '/', trim($value));
        if ((strlen($v) > 0) && !str_ends_with($v, '/')) {
            $v .= '/';
        }
        return self::setValue($name, $value);
    }

    public static function setTrimedValue($name, $value)
    {
        return self::setValue($name, trim($value));
    }
}

class PostVar
{
    use BaseGlobalVar;

    const varname  = '_POST';
    const casecmp  = false;
    const readonly = true;
}

class GetVar
{
    use BaseGlobalVar;

    const varname  = '_GET';
    const casecmp  = false;
    const readonly = true;
}

class CONF
{
    use BaseGlobalVar;

    const varname  = 'CONF';
    const casecmp  = true;
    const readonly = false;

    public static function setDbValue($name, $value)
    {
        $key = trim((string)$name);
        if (strlen($key) == 0) {
            trigger_error('Invalid $name length:0 : CONF::setValue', E_USER_ERROR);
            return false;
        }
        if (strlen($key) != strlen((string)$name)) {
            trigger_error('Invalid $name : CONF::setValue : $name contains space `%s`', E_USER_WARNING, (string)$name);
        }
        return Admin::updateOrInsertConfig($key, $value);
    }
}
