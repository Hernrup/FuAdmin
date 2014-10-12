<?php
/**
 * Created by PhpStorm.
 * User: mhe
 * Date: 11/10/14
 * Time: 19:33
 */

namespace acl;


/**
 * Class StaticResource
 * @package acl
 */
class StaticResource implements iAclResource {

    /**
     * @var array
     */
    protected $allowedActions;

    /**
     * @var string
     */
    protected $name;

    /**
     *
     */
    function __construct()
    {
        $this->allowedActions = [];
        $this->name = "";

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param $action
     * @return bool
     */
    public function isAllowed($action)
    {
        return in_array($action,$this->allowedActions);
    }

    /**
     * @param array $actions
     * @return $this
     */
    public function allow($actions){
        array_push($this->allowedActions, $actions);
        return $this;
    }





} 