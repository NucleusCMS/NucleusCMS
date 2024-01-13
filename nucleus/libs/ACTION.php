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
 * Actions that can be called via action.php
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) The Nucleus Group
 */

class ACTION
{
    /**
     *  Constructor for an new ACTION object
     */
    public function __construct()
    {
        // do nothing
    }

    /**
     *  Calls functions that handle an action called from action.php
     */
    public function doAction($action)
    {
        switch ($action) {
            case 'autodraft':
                return $this->autoDraft();

            case 'updateticket':
                return $this->updateTicket();

            case 'addcomment':
                return $this->addComment();

            case 'sendmessage':
                return $this->sendMessage();

            case 'createaccount':
                return $this->createAccount();

            case 'forgotpassword':
                $this->forgotPassword();
                break;

            case 'votenegative':
            case 'votepositive':
                $this->doVote('votepositive' === $action ? '+' : '-');
                break;

            case 'plugin':
                $this->callPlugin();
                break;

            default:
                doError(_ERROR_BADACTION);
                break;
        }

        return '';
    }

    /**
     *  Adds a new comment to an item (if IP isn't banned)
     */
    public function addComment()
    {
        global $CONF, $errormessage, $manager;

        $post['itemid']   = intPostVar('itemid');
        $post['user']     = postVar('user');
        $post['userid']   = postVar('userid');
        $post['email']    = postVar('email');
        $post['body']     = postVar('body');
        $post['remember'] = intPostVar('remember');

        // set cookies when required
        #$remember = intPostVar('remember');

        // begin if: "Remember Me" box checked
        if (1 == $post['remember']) {
            $lifetime = time() + 2592000;
            setcookie(
                $CONF['CookiePrefix'] . 'comment_user',
                $post['user'],
                $lifetime,
                '/',
                '',
                false
            );
            setcookie(
                $CONF['CookiePrefix'] . 'comment_userid',
                $post['userid'],
                $lifetime,
                '/',
                '',
                false
            );
            setcookie(
                $CONF['CookiePrefix'] . 'comment_email',
                $post['email'],
                $lifetime,
                '/',
                '',
                false
            );
        } // end if

        $blog_id = getBlogIDFromItemID($post['itemid']);
        $this->checkban($blog_id);
        $blog     = &$manager->getBlog($blog_id);
        $comments = new COMMENTS($post['itemid']);

        // note: PreAddComment and PostAddComment gets called somewhere inside addComment
        $errormessage = $comments->addComment($blog->getCorrectTime(), $post);
        // begin if:
        if (1 == $errormessage) {
            // redirect when adding comments succeeded
            if (postVar('url')) {
                redirect(postVar('url'));
                exit;
            }
            $url = createItemLink($post['itemid']);
            redirect($url); // end if
            exit;
        }
        return [
            'message' => $errormessage,
            'skinid'  => $blog->getDefaultSkin(),
        ]; // end if
    }

    /**
     *  Sends a message from the current member to the member given as argument
     * @return array|void
     */
    public function sendMessage()
    {
        global $CONF, $member;

        $error = $this->validateMessage();

        if ('' != $error) {
            return ['message' => $error];
        }

        $tomem = new MEMBER();
        $tomem->readFromId(postVar('memberid'));

        @Utils::mail(
            $tomem->getEmail(),
            sprintf(
                "%s %s",
                _MMAIL_TITLE,
                $member->isLoggedIn() ? $member->getDisplayName() : _MMAIL_FROMANON
            ),
            sprintf(
                "%s %s\n(%s %s) \n\n%s \n\n%s\n%s",
                _MMAIL_MSG,
                $member->isLoggedIn() ? $member->getDisplayName() : _MMAIL_FROMANON,
                _MMAIL_FROMNUC,
                $CONF['IndexURL'],
                _MMAIL_MAIL,
                postVar('message'),
                getMailFooter()
            ),
            'From: ' . $member->isLoggedIn() ? $member->getEmail() : postVar('frommail')
        );

        if (postVar('url')) {
            redirect(postVar('url'));
            exit;
        }
        $CONF['MemberURL'] = $CONF['IndexURL'];

        if ('pathinfo' !== $CONF['URLMode']) {
            redirect($CONF['IndexURL'] . createMemberLink($tomem->getID()));
            exit;
        }

        redirect(createLink(
            'member',
            [
                'memberid' => $tomem->getID(),
                'name'     => $tomem->getDisplayName(),
            ]
        ));
    }

    /**
     *  Checks if a mail to a member is allowed
     *  Returns a string with the error message if the mail is disallowed
     */
    public function validateMessage()
    {
        global $CONF, $member, $manager;

        if ( ! $CONF['AllowMemberMail']) {
            return _ERROR_MEMBERMAILDISABLED;
        }

        if ( ! $member->isLoggedIn() && ! $CONF['NonmemberMail']) {
            return _ERROR_DISALLOWED;
        }

        if ( ! $member->isLoggedIn()
             && ! isValidMailAddress(postVar('frommail'))) {
            return _ERROR_BADMAILADDRESS;
        }

        // let plugins do verification (any plugin which thinks the comment is invalid
        // can change 'error' to something other than '')
        $result = '';
        $param  = [
            'type'  => 'membermail',
            'error' => &$result,
        ];
        $manager->notify('ValidateForm', $param);

        return $result;
    }

    /**
     *  Creates a new user account
     */
    public function createAccount()
    {
        global $CONF, $manager;

        if ( ! $CONF['AllowMemberCreate']) {
            doError(_ERROR_MEMBERCREATEDISABLED);
        }

        // evaluate content from FormExtra
        $result = 1;
        $param  = [
            'type'  => 'membermail',
            'error' => &$result,
        ];
        $manager->notify('ValidateForm', $param);

        if (1 != $result) {
            return $result;
        }

        // even though the member can not log in, set some random initial password. One never knows.
        mt_srand((float) microtime() * 1000000);
        $initialPwd = md5(uniqid(mt_rand(), true));

        // create member (non admin/can not login/no notes/random string as password)
        $name = shorten(postVar('name'), 32, '');
        $r    = MEMBER::create(
            $name,
            postVar('realname'),
            $initialPwd,
            postVar('email'),
            postVar('url'),
            0,
            0,
            ''
        );

        if (1 != $r) {
            return $r;
        }

        // send message containing password.
        $newmem = new MEMBER();
        $newmem->readFromName($name);
        $newmem->sendActivationLink('register');

        $param = ['member' => &$newmem];
        $manager->notify('PostRegister', $param);

        if (postVar('desturl')) {
            redirect(postVar('desturl'));
            exit;
        }

        if ( ! headers_sent()) {
            sendContentType('text/html', '', _CHARSET);
        }
        echo _MSG_ACTIVATION_SENT;
        echo sprintf(
            '<br /><br />Return to <a href="%s" title="%s">%s</a>',
            $CONF['IndexURL'],
            $CONF['SiteName'],
            $CONF['SiteName']
        );
        echo "\n</body>\n</html>";

        exit;
    }

    /**
     *  Sends a new password
     */
    public function forgotPassword()
    {
        $membername = trim(postVar('name'));

        if ( ! MEMBER::exists($membername)) {
            doError(_ERROR_NOSUCHMEMBER);
        }

        $mem = MEMBER::createFromName($membername);

        /* below keeps regular users from resetting passwords using forgot password feature
             Removing for now until clear why it is required.*/
        /*if (!$mem->canLogin())
            doError(_ERROR_NOLOGON_NOACTIVATE);*/

        // check if user halt or invalid
        if ($mem->isHalt()) {
            doError(_ERROR_LOGIN_MEMBER_HALT_OR_INVALID);
        }

        // check if e-mail address is correct
        if ( ! ($mem->getEmail() == postVar('email'))) {
            doError(_ERROR_INCORRECTEMAIL);
        }

        // send activation link
        $mem->sendActivationLink('forgot');

        if (postVar('url')) {
            redirect(postVar('url'));
            exit;
        }

        global $CONF;
        sendContentType('text/html', '', _CHARSET);
        echo sprintf(
            '%s<br /><br />Return to <a href="%s" title="%s">%s</a>',
            _MSG_ACTIVATION_SENT,
            $CONF['IndexURL'],
            $CONF['SiteName'],
            $CONF['SiteName']
        );

        exit;
    }

    /**
     *  Handle karma votes
     */
    public function doKarma($type)
    {
        $this->doVote(('pos' === $type || '+' === $type) ? '+' : '-');
    }

    /**
     *  Handle votes
     */
    public function doVote($type)
    {
        global $itemid, $member, $CONF, $manager;

        // check if itemid exists
        if ( ! $manager->existsItem($itemid, 0, 0)) {
            doError(_ERROR_NOSUCHITEM);
        }

        $blogid = getBlogIDFromItemID($itemid);
        $this->checkban($blogid);

        $karma         = &$manager->getKarma($itemid);
        $isVoteAllowed = $karma->isVoteAllowed(serverVar('REMOTE_ADDR'));

        $params = [
            'done'  => false,
            'type'  => $type,
            'allow' => &$isVoteAllowed,
        ];
        $manager->notify('PreVote', $params);

        // check if not already voted
        if ( ! $isVoteAllowed) {
            doError(_ERROR_VOTEDBEFORE);
        }

        // check if item does allow voting
        $item = &$manager->getItem($itemid, 0, 0);

        if ($item['closed']) {
            doError(_ERROR_ITEMCLOSED);
        }

        switch ($type) {
            case '+':
                $karma->votePositive();
                break;

            case '-':
                $karma->voteNegative();
                break;
        }

        $params = ['done' => false, 'type' => $type];
        $manager->notify('PostVote', $params);

        //        $blogid = getBlogIDFromItemID($itemid);
        $blog = &$manager->getBlog($blogid);

        // send email to notification address, if any
        if ($blog->getNotifyAddress() && $blog->notifyOnVote()) {
            $mailto_msg = sprintf(
                "%s %s\n",
                _NOTIFY_KV_MSG,
                $itemid
            );
            $itemLink = createItemLink((int) $itemid);
            $temp     = parse_url($itemLink);

            if ( ! $temp['scheme']) {
                $itemLink = $CONF['IndexURL'] . $itemLink;
            }

            $mailto_msg .= $itemLink . "\n\n";

            if ($member->isLoggedIn()) {
                $mailto_msg .= sprintf(
                    "%s %s (ID=%s)\n",
                    _NOTIFY_MEMBER,
                    $member->getDisplayName(),
                    $member->getID()
                );
            }

            $mailto_msg .= sprintf(
                "%s %s\n",
                _NOTIFY_IP,
                serverVar('REMOTE_ADDR')
            );
            $mailto_msg .= sprintf(
                "%s %s\n",
                _NOTIFY_HOST,
                gethostbyaddr(serverVar('REMOTE_ADDR'))
            );
            $mailto_msg .= sprintf(
                "%s\n %s\n",
                _NOTIFY_VOTE,
                $type
            );
            $mailto_msg .= getMailFooter();

            $notify = new NOTIFICATION($blog->getNotifyAddress());
            $notify->notify(
                sprintf(
                    '%s %s (%s)',
                    _NOTIFY_KV_TITLE,
                    strip_tags($item['title']),
                    $itemid
                ),
                $mailto_msg,
                $member->getNotifyFromMailAddress()
            );
        }

        redirect(serverVar('HTTP_REFERER') ?: $itemLink);
    }

    /**
     * Calls a plugin action
     */
    public function callPlugin()
    {
        global $manager;

        $pluginName = 'NP_' . requestVar('name');

        // 1: check if plugin is installed
        if ( ! $manager->pluginInstalled($pluginName)) {
            doError(_ERROR_NOSUCHPLUGIN);
        }

        // 2: call plugin
        $pluginObject = &$manager->getPlugin($pluginName);

        $error = $pluginObject
            ? $pluginObject->doAction((string) requestVar('type'))
            : 'Could not load plugin (see actionlog)';

        // doAction returns error when:
        // - an error occurred (duh)
        // - no actions are allowed (doAction is not implemented)
        if ($error) {
            doError($error);
        }

        exit;
    }

    /**
     *  Checks if an IP or IP range is banned
     */
    public function checkban($blogid)
    {
        // check if banned
        $baninfo = BAN::isBanned($blogid, serverVar('REMOTE_ADDR'));

        if (false === $baninfo) {
            return;
        }
        doError(sprintf(
            '%s%s%s%s%s',
            _ERROR_BANNED1,
            $baninfo->iprange,
            _ERROR_BANNED2,
            $baninfo->message,
            _ERROR_BANNED3
        ));
    }

    /**
     * Gets a new ticket
     */
    public function updateTicket()
    {
        global $manager;

        if ($manager->checkTicket()) {
            echo json_encode(["success" => true, "value" => $manager->getNewTicket()]);
        } else {
            echo json_encode(["success" => false, "value" => _ERROR . ':' . _ERROR_BADTICKET]);
        }

        return false;
    }

    /**
     * Handles AutoSaveDraft
     */
    public function autoDraft()
    {
        global $manager;

        if ( ! $manager->checkTicket()) {
            echo json_encode(["success" => false, "value" => _ERROR . ':' . _ERROR_BADTICKET]);
            return false;
        }

        $manager->loadClass('ITEM');
        $info = ITEM::createDraftFromRequest();

        if ('error' === $info['status']) {
            echo json_encode(["success" => false, "value" => _ERROR . ':' . $info['message']]);
        } else {
            echo json_encode(["success" => true, "value" => $info['draftid']]);
        }

        return false;
    }
}
