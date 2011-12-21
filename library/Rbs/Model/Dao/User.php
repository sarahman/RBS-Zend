<?php

/**
 * User Dao
 *
 * @package			Rbs Library
 * @category		Dao Model
 * @author			Eftakhairul Islam <eftakhairul@gmail.com>
 * @copyright		Copyright (c) 2011 Right Brain Solution Ltd. <http://www.rightbrainsolution.com>
 */

class Rbs_Model_Dao_User extends Rbs_Model_Dao_Abstract
{
	public function  __construct()
	{
		parent::__construct();
		$this->loadTable('users','user_id');
	}

	public function getSummary($options = array())
	{
		$select = $this->select()
					   ->from($this->_name);

        if (!empty ($options)) {
            foreach ($options AS $attribute => $condition) {
                $select->where("{$attribute} = ?", $condition);
            }
        }

		return $this->returnResultAsAnArray($this->fetchRow($select));
	}

	public function getDetail($userId)
	{
		$select = $this->select()
					   ->from($this->_name)
					   ->where("{$this->_primaryKey} = ?", $userId);

		return $this->returnResultAsAnArray($this->fetchRow($select));
	}
	
	public function validateUser(array $data)
	{
		$select = $this->select()
					   ->from($this->_name, array($this->_primaryKey, 'username'))
					   ->where("username = ?", $data['username'])
					   ->where("password = ?", $data['password']);

		return $this->returnResultAsAnArray($this->fetchRow($select));
	}
}