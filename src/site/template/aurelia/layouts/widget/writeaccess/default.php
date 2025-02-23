<?php

/**
 * Kunena Component
 *
 * @package         Kunena.Template.Aurelia
 * @subpackage      Layout.Widget
 *
 * @copyright       Copyright (C) 2008 - @currentyear@ Kunena Team. All rights reserved.
 * @license         https://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link            https://www.kunena.org
 **/

defined('_JEXEC') or die();

use Joomla\CMS\Language\Text;
use Kunena\Forum\Libraries\Factory\KunenaFactory;
use Kunena\Forum\Libraries\Forum\Topic\KunenaTopicHelper;
use Kunena\Forum\Libraries\Icons\KunenaIcons;
use Kunena\Forum\Libraries\User\KunenaUserHelper;

$topic  = KunenaTopicHelper::get($this->id);
$config = KunenaFactory::getConfig();
?>

<div class="kfrontend shadow-lg rounded mt-4 border">
    <div class="btn-toolbar float-end">
        <div class="btn-group">
            <div class="btn btn-outline-primary border btn-sm" data-bs-toggle="collapse"
                 data-bs-target="#writeaccess"><?php echo KunenaIcons::collapse(); ?></div>
        </div>
    </div>

    <h3 class="btn-link">
        <?php echo Text::_('COM_KUNENA_WRITEACCESS'); ?>
    </h3>

    <div class="row-fluid " id="writeaccess">
        <div class="card card-block bg-faded p-2">
            <ul class="unstyled col-md-6">
                <li>
                    <?php
                    if ($topic->getCategory()->isAuthorised('topic.create')) { ?>
                <li>
                    <b><?php echo Text::_('COM_KUNENA_ACCESS_ALLOWED'); ?></b> <?php echo Text::_('COM_KUNENA_ACCESS_ALLOWED_CREATETOPIC'); ?>
                </li>
                    <?php } else { ?>
                    <li>
                        <b><?php echo Text::_('COM_KUNENA_ACCESS_NOTALLOWED'); ?></b> <?php echo Text::_('COM_KUNENA_ACCESS_ALLOWED_CREATETOPIC'); ?>
                    </li>
                    <?php }

                    if ($topic->isAuthorised('reply', KunenaUserHelper::getMyself())) { ?>
                    <li>
                        <b><?php echo Text::_('COM_KUNENA_ACCESS_ALLOWED'); ?></b> <?php echo Text::_('COM_KUNENA_ACCESS_ALLOWED_REPLY'); ?>
                    </li>
                    <?php } else { ?>
                    <li>
                        <b><?php echo Text::_('COM_KUNENA_ACCESS_NOTALLOWED'); ?></b> <?php echo Text::_('COM_KUNENA_ACCESS_ALLOWED_REPLY'); ?>
                    </li>
                    <?php }

                    if ($topic->isAuthorised('edit') || $topic->isAuthorised('reply')) {
                        if ($config->imageUpload == '') {
                            ?>
                        <li>
                            <b><?php echo Text::_('COM_KUNENA_ACCESS_NOTALLOWED'); ?></b> <?php echo Text::_('COM_KUNENA_ACCESS_ALLOWED_IMAGE_ADDATTACH'); ?>
                        </li> <?php
                        } elseif ($config->imageUpload == 'everybody') {
                            ?>
                        <li>
                            <b><?php echo Text::_('COM_KUNENA_ACCESS_ALLOWED'); ?></b> <?php echo Text::_('COM_KUNENA_ACCESS_ALLOWED_IMAGE_ADDATTACH'); ?>
                        </li> <?php
                        } elseif (
                            $config->imageUpload == 'admin' && KunenaUserHelper::getMyself()->isAdmin() ||
                            $config->imageUpload == 'moderator' && KunenaUserHelper::getMyself()->isModerator() ||
                            $config->imageUpload == 'registered' && KunenaUserHelper::getMyself()->exists()
                        ) {
                            ?>
                        <li>
                            <b><?php echo Text::_('COM_KUNENA_ACCESS_ALLOWED'); ?></b> <?php echo Text::_('COM_KUNENA_ACCESS_ALLOWED_IMAGE_ADDATTACH'); ?>
                        </li> <?php
                        } else {
                            ?>
                        <li>
                            <b><?php echo Text::_('COM_KUNENA_ACCESS_NOTALLOWED'); ?></b> <?php echo Text::_('COM_KUNENA_ACCESS_ALLOWED_IMAGE_ADDATTACH'); ?>
                        </li> <?php
                        }

                        if ($config->fileUpload == '') {
                            ?>
                        <li>
                            <b><?php echo Text::_('COM_KUNENA_ACCESS_NOTALLOWED'); ?></b> <?php echo Text::_('COM_KUNENA_ACCESS_ALLOWED_ADDATTACH'); ?>
                        </li> <?php
                        } elseif ($config->fileUpload == 'everybody') {
                            ?>
                        <li>
                            <b><?php echo Text::_('COM_KUNENA_ACCESS_ALLOWED'); ?></b> <?php echo Text::_('COM_KUNENA_ACCESS_ALLOWED_ADDATTACH'); ?>
                        </li> <?php
                        } elseif (
                            $config->fileUpload == 'admin' && KunenaUserHelper::getMyself()->isAdmin() ||
                            $config->fileUpload == 'moderator' && KunenaUserHelper::getMyself()->isModerator() ||
                            $config->fileUpload == 'registered' && KunenaUserHelper::getMyself()->exists()
                        ) {
                            ?>
                        <li>
                            <b><?php echo Text::_('COM_KUNENA_ACCESS_ALLOWED'); ?></b> <?php echo Text::_('COM_KUNENA_ACCESS_ALLOWED_ADDATTACH'); ?>
                        </li> <?php
                        } else {
                            ?>
                        <li>
                            <b><?php echo Text::_('COM_KUNENA_ACCESS_NOTALLOWED'); ?></b> <?php echo Text::_('COM_KUNENA_ACCESS_ALLOWED_ADDATTACH'); ?>
                        </li> <?php
                        }
                    }

                    if ($topic->isAuthorised('edit') || $topic->getUserTopic()->posts && $config->userEdit) {
                        if ($config->userEdit == 3 && $topic->getLastPostAuthor()->userid != KunenaUserHelper::getMyself()->userid) {
                            ?>
                        <li>
                            <b><?php echo Text::_('COM_KUNENA_ACCESS_NOTALLOWED'); ?></b> <?php echo Text::_('COM_KUNENA_ACCESS_ALLOWED_EDITPOST'); ?>
                        </li>
                            <?php
                        } elseif ($config->userEdit == 4 && $topic->getFirstPostAuthor()->userid != KunenaUserHelper::getMyself()->userid) {
                            if (KunenaUserHelper::getMyself()->isAdmin()) {
                                ?>
                            <li>
                                <b><?php echo Text::_('COM_KUNENA_ACCESS_ALLOWED'); ?></b> <?php echo Text::_('COM_KUNENA_ACCESS_ALLOWED_EDITPOST'); ?>
                            </li>
                                <?php
                            } else {
                                ?>
                            <li>
                                <b><?php echo Text::_('COM_KUNENA_ACCESS_NOTALLOWED'); ?></b> <?php echo Text::_('COM_KUNENA_ACCESS_ALLOWED_EDITPOST'); ?>
                            </li>
                                <?php
                            }
                        } else {
                            ?>
                        <li>
                            <b><?php echo Text::_('COM_KUNENA_ACCESS_ALLOWED'); ?></b> <?php echo Text::_('COM_KUNENA_ACCESS_ALLOWED_EDITPOST'); ?>
                        </li>
                            <?php
                        }
                    } else { ?>
                    <li>
                        <b><?php echo Text::_('COM_KUNENA_ACCESS_NOTALLOWED'); ?></b> <?php echo Text::_('COM_KUNENA_ACCESS_ALLOWED_EDITPOST'); ?>
                    </li>
                    <?php }
                    ?>
                </li>
            </ul>
        </div>
    </div>
</div>
