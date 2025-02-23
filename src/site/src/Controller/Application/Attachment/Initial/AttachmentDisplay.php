<?php

/**
 * Kunena Component
 *
 * @package         Kunena.Site
 * @subpackage      Controller.Application
 *
 * @copyright       Copyright (C) 2008 - @currentyear@ Kunena Team. All rights reserved.
 * @license         https://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link            https://www.kunena.org
 **/

namespace Kunena\Forum\Site\Controller\Application\Attachment\Initial;

\defined('_JEXEC') or die();

use Exception;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Kunena\Forum\Libraries\Attachment\KunenaAttachmentHelper;
use Kunena\Forum\Libraries\Config\KunenaConfig;
use Kunena\Forum\Libraries\Controller\KunenaControllerDisplay;
use Kunena\Forum\Libraries\Exception\KunenaExceptionAuthorise;
use Kunena\Forum\Libraries\Factory\KunenaFactory;
use Kunena\Forum\Libraries\User\KunenaUser;
use Kunena\Forum\Libraries\User\KunenaUserHelper;
use RuntimeException;

/**
 * Class ComponentKunenaControllerApplicationAttachmentDefaultDisplay
 *
 * Only implemented on raw format as it's faster to run.
 *
 * @since   Kunena 4.0
 */
class AttachmentDisplay extends KunenaControllerDisplay
{
    /**
     * @var KunenaUser|null
     * @since version
     */
    private $me;

    /**
     * Return true if layout exists.
     *
     * @return  boolean
     *
     * @since   Kunena 6.0
     */
    public function exists()
    {
        return true;
    }

    /**
     * Display attachment.
     *
     * @return  void
     *
     * @since   Kunena 6.0
     *
     * @throws  KunenaExceptionAuthorise
     * @throws  RuntimeException
     * @throws  null
     */
    public function execute()
    {
        try {
            $this->display();
        } catch (Exception $e) {
            // In case of an error we want to set HTTP error code.
            // We want to wrap the exception to be able to display correct HTTP status code.
            $error = new KunenaExceptionAuthorise($e->getMessage(), $e->getCode(), $e);
            header('HTTP/1.1 ' . $error->getResponseStatus(), true);

            echo $error->getResponseStatus();

            if (JDEBUG) {
                echo "<pre>{$e->getTraceAsString()}</pre>";
            }
        }

        flush();
        $this->app->close();
    }

    /**
     * Display attachment.
     *
     * @return  void
     *
     * @since   Kunena 6.0
     *
     * @throws  null
     * @throws  Exception
     */
    public function display()
    {
        KunenaFactory::loadLanguage('com_kunena');

        $format   = $this->input->getWord('format', 'html');
        $id       = $this->input->getInt('id', 0);
        $thumb    = $this->input->getBool('thumb', false);
        $download = $this->input->getBool('download', false);

        // Run before executing action.
        $this->before();

        if ($format != 'raw' || !$id) {
            throw new KunenaExceptionAuthorise(Text::_('COM_KUNENA_NO_ACCESS'), 404);
        }

        if ($this->config->boardOffline && !$this->me->isAdmin()) {
            // Forum is offline.
            throw new KunenaExceptionAuthorise(Text::_('COM_KUNENA_FORUM_IS_OFFLINE'), 503);
        }

        if ($this->config->regOnly && !$this->me->exists()) {
            // Forum is for registered users only.
            throw new KunenaExceptionAuthorise(Text::_('COM_KUNENA_LOGIN_NOTIFICATION'), 403);
        }

        $attachment = KunenaAttachmentHelper::get($id);
        $attachment->tryAuthorise();

        $path = $attachment->getPath($thumb);

        if ($thumb && !$path) {
            $path = $attachment->getPath(false);
        }

        if (!$path) {
            // File doesn't exist.
            throw new KunenaExceptionAuthorise(Text::_('COM_KUNENA_NO_ACCESS'), 404);
        }

        if (headers_sent()) {
            throw new KunenaExceptionAuthorise('HTTP headers were already sent. Sending attachment failed.', 500);
        }

        // Close all output buffers, just in case.
        while (@ob_end_clean()) {
        }

        // Handle 304 Not Modified
        if (isset($_SERVER['HTTP_IF_NONE_MATCH'])) {
            $etag = stripslashes($_SERVER['HTTP_IF_NONE_MATCH']);

            if ($etag == $attachment->hash) {
                header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime($path)) . ' GMT', true, 304);

                // Give fast response.
                flush();
                $this->app->close();
            }
        }

        // Set file headers.
        header('ETag: ' . $attachment->hash);
        header('Pragma: public');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime($path)) . ' GMT');

        if (!$download && $attachment->isImage()) {
            // By default display images inline.
            $guest = new KunenaUser();

            // If guests can access the image, we allow it to be cached for an hour.
            if ($attachment->isAuthorised('read', $guest)) {
                $maxage = 60 * 60;
                header('Expires: ' . gmdate('D, d M Y H:i:s', time() + $maxage) . ' GMT');
                header('Cache-Control: maxage=' . $maxage);
            }
            // No guest access -- force re-validate.
            else {
                header('Expires: 0');
                header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            }

            header('Content-type: ' . $attachment->filetype);
            header('Content-Disposition: inline; filename="' . $attachment->getFilename(false) . '"');
        } else {
            // Otherwise force file download.
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Content-Description: File Transfer');
            header('Content-Type: application/force-download');
            header('Content-Type: application/octet-stream');
            header('Content-Type: application/download');
            header('Content-Disposition: attachment; filename="' . $attachment->getFilename(false) . '"');
        }

        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . fileSize($path));
        flush();

        // Output the file contents.
        @readfile($path);
        flush();

        $this->app->close();
    }

    /**
     * Prepare attachment display.
     *
     * @return  void
     *
     * @since   Kunena 6.0
     *
     * @throws  Exception
     */
    protected function before()
    {
        // Load language files.
        KunenaFactory::loadLanguage('com_kunena.sys', 'admin');

        $this->me       = KunenaUserHelper::getMyself();
        $this->config   = KunenaConfig::getInstance();
        $this->document = $this->app->getDocument();
    }
}
