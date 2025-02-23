<?php

/**
 * Kunena Component
 *
 * @package         Kunena.Site
 * @subpackage      Layout.widget
 *
 * @copyright       Copyright (C) 2008 - @currentyear@ Kunena Team. All rights reserved.
 * @license         https://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link            https://www.kunena.org
 **/

namespace Kunena\Forum\Site\Layout\Widget;

\defined('_JEXEC') or die;

use Kunena\Forum\Libraries\Layout\KunenaLayout;

/**
 * KunenaLayoutWidgetMenu
 *
 * @since   Kunena 6.1
 */
class WidgetModal extends KunenaLayout
{
    public $name;

    public $label;

    public $description;

    public $id;

    public $form;
}
