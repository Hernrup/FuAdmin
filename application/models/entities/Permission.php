<?php

namespace Entities;

/**
 *
 *
 * @Role(name="permisson")
 * @Entity
 */
class Permission extends CoreEntity{
    /**
     * @var int
     * @Id
     * @Column(type="integer", nullable=false)
     * @GeneratedValue
     */
    protected $id;

    /**
     * @ManyToOne(targetEntity="RoleType", inversedBy="permissions")
     **/
    protected $roleType;

    /**
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $resource;

    /**
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $action;

    /**
     * @var boolean
     * @Column(type="boolean", nullable=false)
     */
    protected $inherit;

    /**
     * @param boolean $inherit
     */
    public function setInherit($inherit)
    {
        $this->inherit = $inherit;
    }

    /**
     * @return boolean
     */
    public function getInherit()
    {
        return $this->inherit;
    }


    /**
     * @param mixed $roleType
     */
    public function setRoleType($roleType)
    {
        $this->roleType = $roleType;
    }

    /**
     * @return mixed
     */
    public function getRoleType()
    {
        return $this->roleType;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param mixed $resource
     */
    public function setResource($resource)
    {
        $this->resource = $resource;
    }

    /**
     * @return mixed
     */
    public function getResource()
    {
        return $this->resource;
    }



} 