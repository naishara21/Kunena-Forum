<?php

/**
 * Kunena Component
 *
 * @package         Kunena.Template.Aurelia
 * @subpackage      Pages.Credits
 *
 * @copyright       Copyright (C) 2008 - @currentyear@ Kunena Team. All rights reserved.
 * @license         https://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link            https://www.kunena.org
 **/

namespace Kunena\Forum\Site;

\defined('_JEXEC') or die();

use Joomla\CMS\Language\Text;

$content = $this->execute('Credits');

$this->addBreadcrumb(
    Text::_('COM_KUNENA_VIEW_CREDITS_DEFAULT'),
    'index.php?option=com_kunena&view=credits'
);

echo $content;
