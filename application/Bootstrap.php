<?php

/**
 * The application bootstrap used by Zend_Application
 *
 * @category   Bootstrap
 * @package    Bootstrap
 * @copyright  Copyright (c) 2011 Right Brain Solution Ltd. (http://www.rightbrainsolution.com)
 */

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    /**
     * @var Zend_Log
     */
    protected $_logger;
    /**
     * @var Zend_Controller_Front
     */
    public $frontController;

    /**
     * Setup the view
     */
    protected function _initViewSettings()
    {
        $cssFiles = array('bootstrap.min', 'styles');

        $jsFiles = array('jquery-1.6.4.min', 'jquery.tablesorter.min', 'bootstrap-modal', 'bootstrap-tabs', 'custom');

//        $this->_logger->info('Bootstrap ' . __METHOD__);

        $this->bootstrap('view');

        $this->_view = $this->getResource('view');

        // set encoding and doctype
        $this->_view->setEncoding('UTF-8');
        $this->_view->doctype('HTML5');

        // set the content type and language
        $this->_view->headMeta()->appendHttpEquiv('Content-Type', 'text/html; charset=UTF-8');
        $this->_view->headMeta()->appendHttpEquiv('Content-Language', 'en-US');

        // set css/js links and a special import for the accessibility styles
        foreach($cssFiles AS $cssFile) {
            $this->_view->headLink()->appendStylesheet('/css/' . $cssFile . '.css');
        }

        // adding javascript and jQuery UI related files
        foreach($jsFiles AS $jsFile) {
            $this->_view->headScript()->appendFile('/js/' . $jsFile . '.js');
        }

        // setting the site in the title
        $this->_view->headTitle('Devnet Exam System');
        $this->_view->headTitle()->setSeparator(' - ');

        // adding helper file(s).
        $this->_view->addHelperPath('Rbs/View/Helper', 'Rbs_View_Helper');
    }

    /**
     * Setup the autoload
     */
    protected function _initAutoload()
    {
        // List of active modules
        $modules = array(
            'Exam' => APPLICATION_PATH . '/modules/exam',
            'User' => APPLICATION_PATH . '/modules/user'
        );

        foreach ($modules as $namespace => $modulePath) {
            $autoloader = new Zend_Application_Module_Autoloader(array(
                        'namespace' => $namespace,
                        'basePath'  => $modulePath,
            ));
        }

        return $autoloader;
    }

    protected function _initValidateUser()
    {
        $this->bootstrap('frontController');
        $frontController = $this->getResource('FrontController');
        $authentication = new Rbs_Plugin_Authentication();
        $frontController->registerPlugin($authentication);
    }
}