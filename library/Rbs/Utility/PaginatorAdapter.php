<?php

/**
 * Paginator Adapter
 *
 * @package			Rbs Library
 * @category		Utility
 * @author			Raju Mazumder <rajuniit@gmail.com>
 * @author			Syed Abidur Rahman <aabid048@gmail.com>
 * @copyright		Copyright (c) 2011 Right Brain Solution Ltd. http://rightbrainsolution.com
 */

class Rbs_Utility_PaginatorAdapter extends Zend_Paginator_Adapter_Array
{
    public function __construct(array $resultSet, $count)
    {
        parent::__construct($resultSet);
        $this->_count = $count;
    }
}