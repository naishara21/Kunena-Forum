<?php

/**
 * Kunena Component
 *
 * @package         Kunena.Administrator.Template
 * @subpackage      SyncUsers
 *
 * @copyright       Copyright (C) 2008 - @currentyear@ Kunena Team. All rights reserved.
 * @license         https://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link            https://www.kunena.org
 **/

defined('_JEXEC') or die();

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Kunena\Forum\Libraries\Version\KunenaVersion;
use Kunena\Forum\Libraries\Route\KunenaRoute;

?>

<div id="kunena" class="container-fluid">
    <div class="row">
        <div id="j-main-container" class="col-md-12" role="main">
            <div class="card card-block bg-faded p-2">
                <form action="<?php echo KunenaRoute::_('administrator/index.php?option=com_kunena&view=tools') ?>"
                      method="post" id="adminForm"
                      name="adminForm">
                    <input type="hidden" name="task" value="syncUsers"/>
                    <?php echo HTMLHelper::_('form.token'); ?>

                    <fieldset>
                        <legend><?php echo Text::_('COM_KUNENA_SYNC_USERS'); ?></legend>
                        <table class="table table-bordered table-striped">
                            <tr>
                                <td><?php echo Text::_('COM_KUNENA_SYNC_USERS_ADD'); ?></td>
                                <td><input type="checkbox" checked="checked" name="userAdd" value="1"/></td>
                                <td><?php echo Text::_('COM_KUNENA_SYNC_USERS_ADD_DESC'); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo Text::_('COM_KUNENA_SYNC_USERS_DEL'); ?></td>
                                <td><input type="checkbox" name="userDel" value="1"/></td>
                                <td><?php echo Text::_('COM_KUNENA_SYNC_USERS_DEL_DESC'); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo Text::_('COM_KUNENA_SYNC_USERS_RENAME'); ?></td>
                                <td><input type="checkbox" name="userRename" value="1"/></td>
                                <td><?php echo Text::_('COM_KUNENA_SYNC_USERS_RENAME_DESC'); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo Text::_('COM_KUNENA_SYNC_USERS_DELLIFE'); ?></td>
                                <td><input type="checkbox" name="userDelLife" value="1"/></td>
                                <td><?php echo Text::_('COM_KUNENA_SYNC_USERS_DELLIFE_DESC'); ?></td>
                            </tr>
                        </table>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    <div class="pull-right small">
        <?php echo KunenaVersion::getLongVersionHTML(); ?>
    </div>
</div>
