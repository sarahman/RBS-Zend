<?php

/**
 * Login Form
 *
 * @category   Form
 * @copyright  Copyright (c) 2011 Right Brain Solution Ltd. http://www.rightbrainsolution.com
 * @author     Eftakhairul Islam <eftakhairul@gmail.com>
 */

class Application_Form_Login extends Rbs_Form_Base
{
    public function __construct()
    {
        parent::__construct();

        $this->initForm();
        $this->addLoginfield();
        $this->addUserPasswordField();
        $this->addSubmitButtonField();
        $this->finalizeForm();

    }

    public function initForm()
    {
        $options = array('name' => 'login',
                         'addLink' => 'login',
                         'class' => 'form label-inline');

        $this->initializeForm($options);
    }

    public function addLoginfield()
    {
        $options = array('name' => 'username',
                          'label' => 'User Name');

        $element  = $this->addTextField($options);
        $errorMsg = "Please enter correct user name";

        $this->setElementRequired($element, $errorMsg);
    }

    public function addUserPasswordField()
    {
        $options = array('name' => 'password',
                          'label' => 'Password');

         $element  = $this->addPasswordField($options);
         $errorMsg = "Please enter correct user name";

        $this->setElementRequired($element, $errorMsg);
    }

    public function addSubmitButtonField()
    {
        $submit = new Zend_Form_Element_Submit('submit');
        
        $submit->setIgnore(true)
               ->setValue('Submit')
               ->setLabel('Submit')
               ->removeDecorator('label');

        $this->formElements['submit'] = $submit;

    }
}
   