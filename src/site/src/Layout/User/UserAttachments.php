<?php

/**
 * Kunena Component
 *
 * @package         Kunena.Site
 * @subpackage      Layout.User
 *
 * @copyright       Copyright (C) 2008 - @currentyear@ Kunena Team. All rights reserved.
 * @license         https://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link            https://www.kunena.org
 **/

namespace Kunena\Forum\Site\Layout\User;

\defined('_JEXEC') or die;

use Exception;
use Kunena\Forum\Libraries\Config\KunenaConfig;
use Kunena\Forum\Libraries\Layout\KunenaLayout;
use Kunena\Forum\Libraries\User\KunenaUser;

/**
 * KunenaLayoutUserItem
 *
 * @since   Kunena 6.1
 */
class UserAttachments extends KunenaLayout
{
    /**
     * @var     KunenaUser
     * @since   Kunena 6.1
     */
    public $profile;

    /**
     * @var     KunenaUser
     * @since   Kunena 6.1
     */
   public $me;

    /**
     * @var     KunenaConfig
     * @since   Kunena 6.1
     */
    public $config;

    /**
     * @var     KunenaUser
     * @since   Kunena 6.1
     */
    public $user;

    public $output;

    public $headerText;

    public $pagination;

    public $total;

    public $attachments;

    public $moreUri;

    public $template;
}
