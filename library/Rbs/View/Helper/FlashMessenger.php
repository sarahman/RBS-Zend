<?php

/**
 * Flash Messenger
 *
 * @package			Rbs Library
 * @category		View Helper
 * @author			Raju Mazumder <rajuniit@gmail.com>
 * @author			Syed Abidur Rahman <aabid048@gmail.com>
 * @copyright		Copyright (c) 2011 Right Brain Solution Ltd. http://rightbrainsolution.com
 */

class Rbs_View_Helper_FlashMessenger extends Zend_View_Helper_Abstract
{
    /**
     * @var Zend_Controller_Action_Helper_FlashMessenger
     */
    private $_flashMessenger = null;

    /**
     * @param string $key       Message level for string messages
     * @return string $output   Messages formatted for output
     */
    public function flashMessenger($key = 'warning')
    {
        $flashMessenger = $this->_getFlashMessenger();

        $messages = $flashMessenger->getMessages();

        if ($flashMessenger->hasCurrentMessages()) {
            $messages = array_merge(
                $messages,
                $flashMessenger->getCurrentMessages()
            );
            $flashMessenger->clearCurrentMessages();
        }

        $output = '';

        foreach ($messages as $message)
        {
            if (is_array($message)) {
                list($key,$message) = each($message);
            }
            $output .= sprintf($this->_getTemplate(),$key,$message);
        }

        return $output;
    }

    /**
     * @return Zend_Controller_Action_Helper_FlashMessenger
     */
    public function _getFlashMessenger()
    {
        if (empty ($this->_flashMessenger)) {
            $this->_flashMessenger =
                Zend_Controller_Action_HelperBroker::getStaticHelper(
                    'FlashMessenger');
        }

        return $this->_flashMessenger;
    }

    private function _getTemplate()
    {
        return '<div class="message-block %s"><p>%s</p></div>';
    }
}