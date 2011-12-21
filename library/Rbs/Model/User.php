<?php

/**
 * User Model
 *
 * @package			Rbs Library
 * @category		Model
 * @author			Eftakhairul Islam <eftakhairul@gmail.com>
 * @copyright		Copyright (c) 2011 Right Brain Solution Ltd. <http://www.rightbrainsolution.com>
 */

class Rbs_Model_User extends Rbs_Model_Abstract
{
    /**
     * @var Rbs_Model_Dao_Abstract
     */
    protected $dao;

	public function __construct(Rbs_Model_Dao_Abstract $dao = null)
	{
		if (empty ($dao)) {
			$this->dao = new Rbs_Model_Dao_User();
		} else {
			$this->dao = $dao;
		}
	}

	public function validateUser($data = array())
	{
		if (empty ($data)) {
			return false;
		}

		$data['password'] = empty($data['password']) ? '' : md5($data['password']);
		return $this->dao->validateUser($data);
	}

	public function save($data = array())
	{
		if (empty ($data)) {
			return false;
		}

		$data['password'] = empty($data['password']) ? '' : md5($data['password']);
		$data['create_date'] = date('Y-m-d');

		return $this->dao->create($data);
	}

	public function update($data = array(), $userId = null)
	{
		if (empty ($data) || empty ($userId)) {
			return false;
		}

		$data['password'] = empty($data['password']) ? '' : md5($data['password']);
		$this->dao->modify($data, $userId);

		return true;
	}

	public function changePassword($data = array(), $userId = null)
	{
		if (empty ($data) || empty ($userId)) {
			return false;
		}

		if (!empty($data['password'])) {
			$data['password'] = md5($data['password']);
		} else if (!empty($data['new_password'])) {
			$data['password'] = md5($data['new_password']);
		}

		$this->dao->modify($data, $userId);
		return true;
	}
}