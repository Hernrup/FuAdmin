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



}