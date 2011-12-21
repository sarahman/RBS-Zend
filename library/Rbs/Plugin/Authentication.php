<?php

/**
 * Authentication Plugin
 *
 * @package			Rbs Library
 * @category		Plugin
 * @author			Syed Abidur Rahman <aabid048@gmail.com>
 * @author			Eftakhairul Islam <eftakhairul@gmail.com>
 * @copyright		Copyright (c) 2011 Right Brain Solution Ltd. http://rightbrainsolution.com
 */

class Rbs_Plugin_Authentication extends Zend_Controller_Plugin_Abstract
{
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        $actionToBeSkipped = array('login', 'sign-up', 'forget-password');
        $userInformation = new Zend_Session_Namespace('userInformation');

        $acl = Rbs_Library_Acl::getInstance();

        if ($userInformation->userData) {

//            $isAllowed = $acl->isRoleAllowed(
//                    $userInformation->userData['group_id'],
//                    $request->getControllerName('controller'),
//                    $request->getActionName('action')
//            );
//
//            if ($isAllowed == false) {
//
//                $this->setPath($request, array(
//                    'Module' => 'user',
//                    'Controller' => 'Error',
//                    'Action' => 'have-no-access',
//                ));
//            }

            //By passing the logged user to dashboard
            if (in_array($request->getActionName(), $actionToBeSkipped)) {

                $this->setPath($request, array(
                    'Module' => 'exam',
                    'Controller' => 'exams',
                    'Action' => 'index',
                ));
            }

        } else {

            if (!in_array($request->getActionName(), $actionToBeSkipped)) {

                $this->setPath($request, array(
                    'Module' => 'user',
                    'Controller' => 'users',
                    'Action' => 'login',
                ));
//            } else {
//
//                $this->setPath($request, array(
//                    'Module' => 'user',
//                    'Controller' => 'users',
//                    'Action' => 'login',
//                ));
            }
        }
    }

    protected function setPath(Zend_Controller_Request_Abstract $request, $data = array())
    {
        $request->setModuleName($data['Module']);
        $request->setControllerName($data['Controller']);
        $request->setActionName($data['Action']);
        $request->setDispatched(true);
    }
}