<?php

/**
 * Kunena Component
 *
 * @package         Kunena.Template.Aurelia
 * @subpackage      Layout.Topic
 *
 * @copyright       Copyright (C) 2008 - @currentyear@ Kunena Team. All rights reserved.
 * @license         https://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link            https://www.kunena.org
 **/

defined('_JEXEC') or die();

use Joomla\CMS\Language\Text;
use Kunena\Forum\Libraries\Factory\KunenaFactory;
use Kunena\Forum\Libraries\Icons\KunenaIcons;

$this->ktemplate = KunenaFactory::getTemplate();
$fullactions     = $this->ktemplate->params->get('fullactions');
?>

<?php if (!$fullactions) : ?>
    <div class="clearfix"></div>
    <div id="topic-actions">
        <?php if (
        $this->topicButtons->get('reply')
            || $this->topicButtons->get('subscribe')
            || $this->topicButtons->get('favorite')
) : ?>
            <?php echo $this->topicButtons->get('reply') ?>
            <?php echo $this->topicButtons->get('subscribe') ?>
            <?php echo $this->topicButtons->get('favorite') ?>
        <?php endif ?>

        <?php if (
        $this->topicButtons->get('delete')
            || $this->topicButtons->get('permdelete')
            || $this->topicButtons->get('undelete')
            || $this->topicButtons->get('moderate')
            || $this->topicButtons->get('sticky')
            || $this->topicButtons->get('lock')
) : ?>
            <div class="btn-group">
                <a class="btn border" data-bs-toggle="dropdown">
                    <?php echo KunenaIcons::shuffle(); ?><?php echo Text::_('COM_KUNENA_TOPIC_ACTIONS_LABEL_MODERATION') ?>
                </a>
                <a class="btn border dropdown-toggle" data-bs-toggle="dropdown">
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><?php echo $this->topicButtons->get('delete_dropdown') ?></li>
                    <li><?php echo $this->topicButtons->get('permdelete_dropdown') ?></li>
                    <li><?php echo $this->topicButtons->get('undelete_dropdown') ?></li>
                    <li><?php echo $this->topicButtons->get('moderate_dropdown') ?></li>
                    <li><?php echo $this->topicButtons->get('sticky_dropdown') ?></li>
                    <li><?php echo $this->topicButtons->get('lock_dropdown') ?></li>
                </ul>
            </div>
        <?php endif ?>
    </div>
<?php endif; ?>

<?php if ($fullactions) : ?>
    <div class="clearfix"></div>
    <div class="btn-toolbar btn-marging kmessagepadding" id="topic-actions-toolbar">
        <div>
            <?php if (
            $this->topicButtons->get('reply')
                || $this->topicButtons->get('subscribe')
                || $this->topicButtons->get('favorite')
) : ?>
                <div class="btn-group">
                    <a class="btn border" data-bs-toggle="dropdown">
                        <?php echo KunenaIcons::pencil(); ?><?php echo Text::_('COM_KUNENA_TOPIC_ACTIONS_LABEL_ACTION') ?>
                    </a>
                    <a class="btn border dropdown-toggle" data-bs-toggle="dropdown">
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><?php echo $this->topicButtons->get('reply_dropdown') ?></li>
                        <li><?php echo $this->topicButtons->get('subscribe_dropdown') ?></li>
                        <li><?php echo $this->topicButtons->get('favorite_dropdown') ?></li>
                    </ul>
                </div>
            <?php endif ?>

            <?php if (
            $this->topicButtons->get('delete')
                || $this->topicButtons->get('permdelete')
                || $this->topicButtons->get('undelete')
                || $this->topicButtons->get('moderate')
                || $this->topicButtons->get('sticky')
                || $this->topicButtons->get('lock')
) : ?>
                <div class="btn-group">
                    <a class="btn border" data-bs-toggle="dropdown">
                        <?php echo KunenaIcons::shuffle(); ?><?php echo Text::_('COM_KUNENA_TOPIC_ACTIONS_LABEL_MODERATION') ?>
                    </a>
                    <a class="btn border dropdown-toggle" data-bs-toggle="dropdown">
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><?php echo $this->topicButtons->get('delete_dropdown') ?></li>
                        <li><?php echo $this->topicButtons->get('permdelete_dropdown') ?></li>
                        <li><?php echo $this->topicButtons->get('undelete_dropdown') ?></li>
                        <li><?php echo $this->topicButtons->get('moderate_dropdown') ?></li>
                        <li><?php echo $this->topicButtons->get('sticky_dropdown') ?></li>
                        <li><?php echo $this->topicButtons->get('lock_dropdown') ?></li>
                    </ul>
                </div>
            <?php endif ?>
        </div>
    </div>
<?php endif ?>
