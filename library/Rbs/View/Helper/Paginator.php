<?php

/**
 * Paginator Helper
 *
 * @package			Rbs Library
 * @category		View Helper
 * @author			Raju Mazumder <rajuniit@gmail.com>
 * @author			Syed Abidur Rahman <aabid048@gmail.com>
 * @copyright		Copyright (c) 2011 Right Brain Solution Ltd. http://rightbrainsolution.com
 */

class Rbs_View_Helper_Paginator extends Zend_View_Helper_Abstract
{
    public function paginator()
    {
        return $this;
    }

    public function slide(Zend_View_Helper_Abstract $paginator, $options = array())
    {
        if ($paginator->count() <= 1) {
            return '';
        }

//        $this->view->addScriptPath(APPLICATION_PATH . DIRECTORY_SEPARATOR . 'order'. DIRECTORY_SEPARATOR. 'views'. DIRECTORY_SEPARATOR. 'scripts');

        return $this->view->paginationControl($paginator, 'Sliding',
            'partials' . DIRECTORY_SEPARATOR. 'pagination.phtml',
            array('paginatorOptions' => $options));
    }

    public function buildLink($page, $label, $options = array())
    {
        $url = $options['path'];
        $str = str_replace('%d', $page, $options['itemLink']);

        /**
         * 10 is length of "javascript" (without ")
         */
        if (0 == strncasecmp($options['itemLink'], 'javascript', 10)) {
            $url = $str;
        } else {
            $url = rtrim($url, '/') . $str;
        }

        return sprintf('<a href="%s">%s</a>', $url, $label);
    }
}