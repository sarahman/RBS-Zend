<?php

/**
 * Exam Controller
 *
 * @category    Controller
 * @package     Exam
 * @author      Md. Eftakhairul Islam <eftakhairul@gmail.com>
 * @author      Syed Abidur Rahman <aabid048@gmail.com>
 * @copyright   Copyright (c) Right Brain Solution Ltd. <info@rightbrainsolution.com>
 */

class Exam_ExamsController extends Rbs_Controller_ActionController
{
    public function indexAction()
    {
        $this->view->status = $this->_request->getParam('status');
    }

    public function addAction()
    {
        $this->disableLayout();
    }
}