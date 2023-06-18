<!doctype html>
<html lang="{%lang%}">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex,nofollow,noarchive" />
    <title>{%_TITLE%}</title>
    <link rel="stylesheet" type="text/css" href="../nucleus/styles/manual.css" media="screen">
    <style type="text/css">
        #submit {
            width: 100%;
            cursor: pointer;
            margin-top: 8px;
            border: none;
            background-color: #1164a2;
            color: #fff;
            padding: 8px;
            font: inherit;
            border-radius: 5px;
        }
        h1 {font-weight:normal;}
    </style>
    <script src="script.js"></script>
</head>
<body>
    <div style="text-align:center; font-size: xx-large;margin-bottom:1em;"><img src="../nucleus/styles/logo.gif" alt="Nucleus CMS" /><br />
        {%_INSTALL_TEXT_VERSION%}
    </div>
    <div class="wrap">
    <h1>{%_HEADER1%}</h1>
    {%_TEXT1%}
    
    <form method="post" action="index.php?lang={%lang%}">
    <h1>{%_HEADER_LANG_SELECT%}</h1>

    {%_TEXT_LANG_SELECT1_1%}

    <fieldset>
        <legend>{%_TEXT_LANG_SELECT1_1_TAB_HEAD%}</legend>
        <table>
            <tr>
                <td>{%_TEXT_LANG_SELECT1_1_TAB_FIELD1%}</td>
                <td>{%dispINSTALL_LANG%}</td>
                <td>
                    <select id="lang" name="lang" tabindex="10000" onChange="location.href='index.php?lang='+this.value;">
                    {%lang_options%}
                    </select>
                </td>
            </tr>
        </table>
    </fieldset>
    </form>

    <form method="post" action="index.php?lang={%lang%}">

    <h1>{%_HEADER2%}</h1>

    {%_TEXT2%}

    <ul>
        <li>PHP:{%phpversion%}</li>
    </ul>

    <h1>{%_INSTALL_TEXT_DATABASE_SELECT%}</h1>
    {%selDB%}
    <h1>{%_INSTALL_TEXT_DATABASE_LOGIN_INFO%}</h1>
    <div id="db_login_data_sqlite" style="display: none;">
        <fieldset>
            <legend>{%_TEXT4_TAB_HEAD%}</legend>
            <table>
                <tr>
                    <td>{%_TEXT4_TAB_FIELD4%}:</td>
                    <td>settings/db_nucleus.sqlite</td>
                </tr>
            </table>
        </fieldset>
    </div>

    <div id="db_login_data">
    {%_TEXT4%}

    <fieldset>
        <legend>{%_TEXT4_TAB_HEAD%}</legend>
        <table>
            <tr>
                <td><label for="install_db_host">{%_TEXT4_TAB_FIELD1%}:</label></td>
                <td><input id="install_db_host" name="install_db_host" value="{%install_db_host_value%}"
                placeholder="localhost" /></td>
            </tr>
            <tr>
                <td><label for="install_db_user">{%_TEXT4_TAB_FIELD2%}:</label></td>
                <td><input id="install_db_user" name="install_db_user"
                placeholder="root" /></td>
            </tr>
            <tr>
                <td><label for="install_db_password">{%_TEXT4_TAB_FIELD3%}:</label></td>
                <td><input id="install_db_password" name="install_db_password" type="password" /></td>
            </tr>
            <tr>
                <td><label for="install_db_database">{%_TEXT4_TAB_FIELD4%}:</label></td>
                <td><input id="install_db_database" name="install_db_database"
                           pattern="^[a-zA-Z\$_\u0080-\uFFFF][0-9a-zA-Z\$_\u0080-\uFFFF]+$" /> ASCII: a-z A-Z 0-9 $ _ <br>U+0080 .. U+FFFF(<input name="install_db_create" value="1" type="checkbox" id="install_db_create" /><label for="install_db_create">{%_TEXT4_TAB_FIELD4_ADD%}</label>)</td>
            </tr>
        </table>
    </fieldset>

    <fieldset>
        <legend>{%_TEXT4_TAB2_HEAD%}</legend>
        <table>
            <tr>
                <td><input name="install_db_use_prefix" value="1" type="checkbox" id="install_db_use_prefix" />
                    <label for="install_db_use_prefix">{%_TEXT4_TAB2_FIELD%}:</label></td>
                <td><input name="install_db_tablePrefix" value="" /></td>
            </tr>
        </table>

        {%_TEXT4_TAB2_ADD%}

    </fieldset>
    </div>
    
    <h1>{%_HEADER5%}</h1>

    {%_TEXT5%}


    <fieldset>
        <legend>{%_TEXT5_TAB_HEAD%}</legend>
        <table>
            <tr>
                <td><label for="if_IndexURL">{%_TEXT5_TAB_FIELD1%}:</label></td>
                <td><input id="if_IndexURL" name="IndexURL" size="60" value="{%NC_SITE_URL%}" tabindex="10080" /></td>
            </tr>
            <tr>
                <td><label for="if_AdminURL">{%_TEXT5_TAB_FIELD2%}:</label></td>
                <td><input id="if_AdminURL" name="AdminURL" size="60" value="{%NC_SITE_URL%}nucleus/" tabindex="10090" /></td>
            </tr>
            <tr>
                <td><label for="if_AdminPath">{%_TEXT5_TAB_FIELD3%}:</label></td>
                <td><input id="if_AdminPath" name="AdminPath" size="60" value="{%NC_BASE_PATH%}nucleus/" tabindex="10100" /></td>
            </tr>
            <tr>
                <td><label for="if_MediaURL">{%_TEXT5_TAB_FIELD4%}:</label></td>
                <td><input id="if_MediaURL" name="MediaURL" size="60" value="{%NC_SITE_URL%}media/" tabindex="10110" /></td>
            </tr>
            <tr>
                <td><label for="if_MediaPath">{%_TEXT5_TAB_FIELD5%}:</label></td>
                <td><input id="if_MediaPath" name="MediaPath" size="60" value="{%NC_BASE_PATH%}media/" tabindex="10120" /></td>
            </tr>
            <tr>
                <td><label for="if_SkinsURL">{%_TEXT5_TAB_FIELD6%}:</label></td>
                <td><input id="if_SkinsURL" name="SkinsURL" size="60" value="{%NC_SITE_URL%}skins/" tabindex="10130" />
                    <br />({%_TEXT5_TAB_FIELD7_2%})
                </td>
            </tr>
            <tr>
                <td><label for="if_SkinsPath">{%_TEXT5_TAB_FIELD7%}:</label></td>
                <td><input id="if_SkinsPath" name="SkinsPath" size="60" value="{%NC_BASE_PATH%}skins/" tabindex="10140" />
                    <br />({%_TEXT5_TAB_FIELD7_2%})
                </td>
            </tr>
            <tr>
                <td><label for="if_PluginURL">{%_TEXT5_TAB_FIELD8%}:</label></td>
                <td><input id="if_PluginURL" name="PluginURL" size="60" value="{%NC_SITE_URL%}nucleus/plugins/" tabindex="10150" /></td>
            </tr>
            <tr>
                <td><label for="if_ActionURL">{%_TEXT5_TAB_FIELD9%}:</label></td>
                <td><input id="if_ActionURL" name="ActionURL" size="60" value="{%NC_SITE_URL%}action.php" tabindex="10160" />
                    <br />({%_TEXT5_TAB_FIELD9_2%})
                </td>
            </tr>
        </table>
    </fieldset>

    {%_TEXT5_2%}

    <h1>{%_HEADER6%}</h1>
    {%_TEXT6%}

    <fieldset>
        <legend>{%_TEXT6_TAB_HEAD%}</legend>
        <table>
            <tr>
                <td><label for="if_User_name">{%_TEXT6_TAB_FIELD1%}:</label></td>
                <td><input id="if_User_name" name="User_name" value="" tabindex="10170" /> <small>({%_TEXT6_TAB_FIELD1_2%})</small></td>
            </tr>
            <tr>
                <td><label for="if_User_realname">{%_TEXT6_TAB_FIELD2%}:</label></td>
                <td><input id="if_User_realname" name="User_realname" value="" tabindex="10180" /></td>
            </tr>
            <tr>
                <td><label for="if_User_password">{%_TEXT6_TAB_FIELD3%}:</label></td>
                <td><input id="if_User_password" name="User_password" type="password" value="" tabindex="10190" /></td>
            </tr>
            <tr>
                <td><label for="if_User_password2">{%_TEXT6_TAB_FIELD4%}:</label></td>
                <td><input id="if_User_password2" name="User_password2" type="password" value="" tabindex="10200" /></td>
            </tr>
            <tr>
                <td><label for="if_User_email">{%_TEXT6_TAB_FIELD5%}:</label></td>
                <td><input id="if_User_email" name="User_email" value="" tabindex="10210" /> <small>({%_TEXT6_TAB_FIELD5_2%})</small></td>
            </tr>
        </table>
    </fieldset>

    <h1>{%_HEADER7%}</h1>
    {%_TEXT7%}

    <fieldset>
        <legend>{%_TEXT7_TAB_HEAD%}</legend>
        <table>
            <tr>
                <td><label for="if_Blog_name">{%_TEXT7_TAB_FIELD1%}:</label></td>
                <td><input id="if_Blog_name" name="Blog_name" size="60" value="My Nucleus CMS" /></td>
            </tr>
            <tr>
                <td><label for="if_Blog_shortname">{%_TEXT7_TAB_FIELD2%}:</label></td>
                <td><input id="if_Blog_shortname" name="Blog_shortname" value="mynucleuscms" /> <small>({%_TEXT7_TAB_FIELD2_2%})</small></td>
            </tr>
        </table>
    </fieldset>

    <h1>{%_HEADER9%}</h1>
    {%_TEXT9%}

    <p>
    <input name="action" value="go" type="hidden" />
    <input type="submit" id="submit" value="{%_BUTTON1%}" onclick="return checkSubmit();" />
    </p>

    </form>
<script type="text/javascript">
<!--
db_change();
var submitcount = 0;
retryformtitle = "{%_CONFIRM_RETRY_SEND_FORM%}";

//-->
</script>
</div>
</body>
</html>
