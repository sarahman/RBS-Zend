<?php

/**
 * Create Domain Form
 *
 * @category   Form
 * @package    DCE
 * @copyright  Copyright (c) 2011 Right Brain Solution Ltd.
 * @author     Eftakhairul Islam <eftakhairul@gmail.com>
 */

class Application_Form_ChangePassword extends Rbs_Form_Base
{
    public function __construct($options = array())
    {
        parent::__construct();

        $this->initForm();
        $this->userPasswordField();
        $this->userConfirmedPasswordField();
        $this->addUpdateButtonField();
        $this->finalizeForm();
    }

     public function initForm()
    {
        $options = array('name' => 'ChangePassword',
                         'class' => 'form label-inline');

        $this->initializeForm($options);
    }

    public function userPasswordField()
    {
        $options = array('name' => 'password',
                         'label' => 'Password',
                         'class' => 'medium',
                         'messageForRequired' => 'Please enter your password');
        
        $this->addPasswordField($options);
    }

    public function userConfirmedPasswordField()
    {
        $options = array('name' => 'confirmedPassword',
                         'label' => 'Confirmed Password',
                         'class' => 'medium',
                         'messageForRequired' => 'Retype your password');

        $element = $this->addPasswordField($options);
        $element->addValidator('Identical', false, array('token' => 'password'));
    }

    public function addUpdateButtonField()
    {
        $submit = new Zend_Form_Element_Submit('Update');

        $submit->setIgnore(true)
               ->setValue('Update')
               ->setLabel('Update')
               ->removeDecorator('label');

        $this->formElements['update'] = $submit;
    }
}
