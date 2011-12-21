<?php

/**
 * Rbs Base Form
 *
 * @package			Rbs Library
 * @category		Form
 * @author			Syed Abidur Rahman <aabid048@gmail.com>
 * @copyright		Copyright (c) 2011 Right Brain Solution Ltd. <http://rightbrainsolution.com>
 */

class Rbs_Form_Base extends Zend_Form
{
    protected $formElements;

    protected function initializeForm($options = array())
    {
        if (!empty ($options['name'])) {
            $this->setName($options['name']);
            $this->setAttrib('id', $options['name']);
        }

        if (!empty ($options['class'])) {
            $this->setAttrib('class', $options['class']);
        }

        if (empty ($options['isEdit']) && !empty ($options['addLink'])) {
            $this->setAction($options['addLink']);
        } else if (!empty ($options['editLink'])) {
            $this->setAction($options['editLink']);
        } else if (!empty ($options['link'])) {
            $this->setAction($options['link']);
        }
    }

    protected function finalizeForm()
    {
        foreach ($this->formElements AS $element) {
            $this->addElement($element);
        }
    }

    protected function addHiddenField($name, $value = null)
    {
        $field = new Zend_Form_Element_Hidden($name);

        if (!empty ($value)) {
            $field->setValue($value);
        }

        $this->formElements[$name] = $field;
    }

    protected function addTextField(array $options)
    {
        $field = new Zend_Form_Element_Text($options['name']);

        $field->setLabel($options['label'])
              ->addFilter('StringTrim');

        if (!empty ($options['class'])) {
            $field->setAttrib('class', $options['class']);
        }

        if (!empty ($options['messageForRequired'])) {
            $this->setElementRequired($field, $options['messageForRequired']);
        }

        $this->formElements[$options['name']] = $field;
        return $field;
    }

    protected function addNumberTextField(array $options)
    {
        $field = $this->addTextField($options);

        $field->addValidator('Digits');

        $this->formElements[$options['name']] = $field;
        return $field;
    }

    protected function addDecimalTextField(array $options)
    {
        $field = $this->addTextField($options);

        $field->addValidator('Float');

        $this->formElements[$options['name']] = $field;
        return $field;
    }

    protected function addEmailAddressField(array $options)
    {
        $field = $this->addTextField($options);

        $field->addValidator('EmailAddress');

        $this->formElements[$options['name']] = $field;
        return $field;
    }

    protected function addPasswordField(array $options)
    {
        $field = new Zend_Form_Element_Password($options['name']);

        $field->setLabel($options['label'])
              ->addFilter('StringTrim');

        if (!empty ($options['class'])) {
            $this->setAttrib('class', $options['class']);
        }

        if (!empty ($options['messageForRequired'])) {
            $this->setElementRequired($field, $options['messageForRequired']);
        }

        $this->formElements[$options['name']] = $field;
        return $field;
    }

    protected function addTextAreaField(array $options)
    {
        $field = new Zend_Form_Element_Textarea($options['name']);

        $field->setLabel($options['label']);

        if (!empty ($options['class'])) {
            $this->setAttrib('class', $options['class']);
        }

        if (!empty ($options['attributes'])) {
            $field->setAttribs($options['attributes']);
        }

        $this->formElements[$options['name']] = $field;
        return $field;
    }

    protected function addSubmitButton($name = '', $isEdit = false)
    {
        $name = empty ($name) ? 'done' : $name;
        $field = new Zend_Form_Element_Submit($name);

        $field->setLabel(($name === 'done') ? 'Submit' : (empty ($isEdit) ? 'Add' : 'Update'));
        $this->setMainButton($field);

        $this->formElements[$name] = $field;
        return $field;
    }

    protected function addCancelButton($name = '', $redirectLink = '')
    {
        $name = empty ($name) ? 'cancel' : $name;
        $field = new Zend_Form_Element_Submit($name);

        $field->setLabel(ucfirst($name));
        $this->setMainButton($field);

        if (empty ($redirectLink)) {
            $field->setAttrib('onClick', 'javascript:history.go(-1); return false;');
        } else {
            $field->setAttrib('onClick', 'window.location="' . $redirectLink . '"; return false;');
        }

        $this->formElements[$name] = $field;
        return $field;
    }

    protected function setElementRequired(Zend_Form_Element $element, $errorMsg)
    {
        $element->setRequired(true)
                ->addDecorator('Label', $this->getOptionsForReqLabel($element))
                ->addErrorMessage($errorMsg);

        return $this;
    }

    protected function getOptionsForReqLabel(Zend_Form_Element $element)
    {
        $options = $element->getDecorator('Label')->getOptions();

        $options['escape']         = false;
        $options['requiredSuffix'] = '<sup>*</sup>';

        return $options;
    }

    protected function setMainButton(Zend_Form_Element $element)
    {
        $element->setDecorators(array(
            'ViewHelper',
            array('HtmlTag', array('tag' => 'dd', 'class' => 'same-line'))
        ));

        return $this;
    }
}