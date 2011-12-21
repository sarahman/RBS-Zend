<?php

/**
 * Users Controller
 *
 * @category    Controller
 * @package     User
 * @author      Md. Eftakhairul Islam <eftakhairul@gmail.com>
 * @author      Syed Abidur Rahman <aabid048@gmail.com>
 * @copyright   Copyright (c) Right Brain Solution Ltd. <info@rightbrainsolution.com>
 */

class User_UsersController extends Rbs_Controller_ActionController
{
    public function indexAction()
    {
    }

    public function loginAction()
    {
        $this->disableLayout();
        if ($this->_request->isPost()) {
            $authNamespace = new Zend_Session_Namespace('userInformation');
            $authNamespace->userData = array('username' => 'emran007', 'user_id' => 777);

            $this->_redirect('/exam/exams');
        }
    }

    public function logoutAction()
    {
        $this->disableRendering();

        Zend_Session::destroy(true);
        $this->_redirect('/user/users/login');
    }

    public function addAction()
    {
    }

    public function profileAction()
    {
    }

    public function signUpAction()
    {
        $this->disableLayout();
    }

    public function forgetAction()
    {
        $this->disableLayout();
    }
}