<?php

/**
 * ACL Library
 *
 * @package			Rbs Library
 * @category		Library
 * @author			Syed Abidur Rahman <aabid048@gmail.com>
 * @author			Eftakhairul Islam <eftakhairul@gmail.com>
 * @copyright		Copyright (c) 2011 Right Brain Solution Ltd. http://rightbrainsolution.com
 */

class Rbs_Library_Acl extends Zend_Acl
{
    protected static $_instance = null;
    protected $resources = array();
    protected $roles = array();

    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Rbs_Library_Acl();
        }

        return self::$_instance;
    }

    private function __construct()
    {
        $resources = new Zend_Config_Ini(APPLICATION_PATH . '/configs/resources.ini');
        $this->resources = empty($resources) ? array() : $resources->toArray();

        $this->addResources();
        $this->addRoles();
        $this->addPermissions();
    }

    protected function addResources()
    {
        foreach ($this->resources as $resource) {

            $resourceId = $resource['controller'];
            $this->addResource(new Zend_Acl_Resource($resourceId));
        }
    }

    protected function addRoles()
    {
        foreach ($this->roles as $role) {
            $this->addRole(new Zend_Acl_Role($role));
        }
    }

    protected function addPermissions()
    {
        $permissions = new Zend_Config_Ini(APPLICATION_PATH . '/configs/permissions.ini');
        $permissions = $permissions->toArray();

        foreach ($permissions as $role => $permission) {
            foreach ($permission AS $controller) {
                foreach ($controller AS $resource) {
                    $this->allow($this->roles[$role], $resource['controller'], $resource['action']);
                }
            }
        }
    }

    public function isRoleAllowed($role, $module = 'user', $controller, $action = null)
    {
        if ($action != null) {
            $action = strtolower($action);
        }

        $resource = strtolower(trim($module) . ':' . trim($controller));

        if (($this->hasRole($role) && $this->isAllowed($role, $resource, $action))) {
            return true;
        }

        return false;
    }
}