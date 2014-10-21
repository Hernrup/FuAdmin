<?php
namespace Entities;

use acl\IAclRole;
/**
 * 
 *
 * @Role(name="role")
 * @Entity
 */
class Role extends CoreEntity implements iAclRole
{
    /**
     * @var int
     * @Id
	 * @Column(type="integer", nullable=false)
	 * @GeneratedValue
     */
    protected $id;

    /**
     * @ManyToOne(targetEntity="RoleType", inversedBy="roles")
     **/
    protected $roleType;

    /**
     * @ManyToOne(targetEntity="User", inversedBy="roles")
     **/
    protected $user;

    /**
     * @ManyToOne(targetEntity="Unit", inversedBy="roles")
     **/
    protected $unit;

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

    public function getAclRoleId()
    {
        return $this->getId();
    }

    /**
     * @param mixed $roleType
     */
    public function setRoleType($roleType)
    {
        $this->roleType = $roleType;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $unit
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;
    }

    /**
     * @return mixed
     */
    public function getUnit()
    {
        return $this->unit;
    }



}