<?php

/**
 * Rbs Crud Controller
 *
 * @package			Rbs Library
 * @category		Controller
 * @author			Syed Abidur Rahman <aabid048@gmail.com>
 * @copyright		Copyright (c) 2011 Right Brain Solution Ltd. <http://rightbrainsolution.com>
 */

class Rbs_Controller_CrudController extends Rbs_Controller_ActionController
{
    /**
     * Validate and insert user data into a table of a database
     * and redirect to another page with setting message.
     *
     * The following option keys are supported:
     * 'form'           => The form to validate against
     * 'model'          => The model corresponding to the table to be inserted into
     * 'dataToBeAdded'  => The data which is to be included into the post data
     * 'redirectLink'   => The link where to redirect
     * 'message'        => The message to be set while redirecting
     *
     * @param array $data Options to use for this function
     * @return void
     */
    protected function create(array $data)
    {
        $form = $data['form'];
        $model = $data['model'];
        $dataToBeAdded = empty ($data['dataToBeAdded']) ? array() : $data['dataToBeAdded'];
        $redirectLink = $data['redirectLink'];
        $message = empty ($data['message']) ? 'Data is successfully added.' : $data['message'];

        if ($this->_request->isPost()) {

            $postData = $this->_request->getPost();

            if ($form->isValid($postData)) {

                $postData = array_merge($postData, $dataToBeAdded);
                $model->save($postData);

                $this->redirectForSuccess($redirectLink, $message);

            } else {
                $form->populate($postData);
            }
        }
    }

    /**
     * Validate and update user data into a table of a database
     * corresponding to a value of the primary key of that table
     * and redirect to another page with setting message.
     *
     * The following option keys are supported:
     * 'form'           => The form to validate against
     * 'model'          => The model corresponding to a table to be updated
     * 'dataToBeAdded'  => The data which is to be included into the post data
     * 'id'             => The value of the primary key of the table
     * 'redirectLink'   => The link where to redirect
     * 'message'        => The message to be set while redirecting
     *
     * @param array $data Options to use for this function
     * @return void
     */
    protected function update(array $data)
    {
        $form = $data['form'];
        $model = $data['model'];
        $id = $data['id'];
        $dataToBeAdded = empty ($data['dataToBeAdded']) ? array() : $data['dataToBeAdded'];
        $redirectLink = $data['redirectLink'];
        $message = empty ($data['message']) ? 'Data is successfully updated.' : $data['message'];

        if ($this->_request->isPost()) {

            $postData = $this->_request->getPost();

            if ($form->isValid($postData)) {

                $postData = array_merge($postData, $dataToBeAdded);
                $model->modify($postData);

                $this->redirectForSuccess($redirectLink, $message);

            } else {
                $form->populate($postData);
            }
        } else if (empty ($id)) {

            $this->redirectForFailure($redirectLink, $message);

        } else {
            $detailData = $model->getDetail($id);
            $form->populate($detailData);
        }
    }

    /**
     * Remove user data from a table corresponding to its primary key
     * and confirm the data is deleted or not.
     *
     * The following option keys are supported:
     * 'model'          => The model corresponding to the table to be deleted from
     * 'redirectLink'   => The link where to redirect
     * 'message'        => The message to be set while redirecting
     *
     * @param string $id
     * @param Rbs_Model_Abstract $model
     * @return void
     */
    protected function delete($id, Rbs_Model_Abstract $model)
    {
        $this->disableRendering();

        if ($model->delete($id)) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    protected function validateUser()
    {
        if (empty ($this->userData)){
            $this->redirectForFailure('/user/users/login', 'Please login first.');
        }
    }
}