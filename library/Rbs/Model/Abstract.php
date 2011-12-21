<?php

/**
 * Abstract Model
 *
 * @package			Rbs Library
 * @category		Model
 * @author			Syed Abidur Rahman <aabid048@gmail.com>
 * @copyright		Copyright (c) 2011 Right Brain Solution Ltd. <http://www.rightbrainsolution.com>
 */

class Rbs_Model_Abstract
{
    /**
     * @var Rbs_Model_Dao_Abstract
     */
	protected $dao;
	protected $page = 1;
	protected $rowPerPage = 10;

	public function getSummary($options = array())
	{
		$options = $this->setCountOffset($options);
		return $this->dao->getSummary($options);
	}

	protected function setCountOffset($data = array())
	{
		if (!empty ($data['page'])){
			$this->page =  $data['page'];
		}

		$offset = ($this->page - 1) * $this->rowPerPage;
		$data['offset'] = $offset;
		$data['total'] = $this->rowPerPage;

		return $data;
	}

	public function getTotalRows($options = array())
	{
		return $this->dao->getTotalRows($options);
	}

	public function getPaginator($resultSet, $count)
	{
		$paginator = new Zend_Paginator(new Rbs_Utility_PaginatorAdapter($resultSet, $count));
		$paginator->setCurrentPageNumber($this->page);
		$paginator->setItemCountPerPage($this->rowPerPage);

		return $paginator;
	}

	public function getDetail($id = null)
	{
		if (empty ($id)) {
			return array();
		}

		return $this->dao->getDetail($id);
	}

	public function delete($id = null)
	{
		if (empty ($id)) {
			return false;
		}

		return $this->dao->remove($id);
	}
}