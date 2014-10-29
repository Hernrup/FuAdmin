<?php

namespace Entities;

/**
 *
 *
 * @RoleType(name="roletype")
 * @Entity
 */
class RoleType extends CoreEntity
{
    /**
     * @var int
     * @Id
     * @Column(type="integer", nullable=false)
     * @GeneratedValue
     */
    protected $id;

    /**
     * @var string
     * @Column(type="string", nullable=false, unique=true)
     */
    protected $name;

    /**
     * @OneToMany(targetEntity="Role", mappedBy="roleType")
     * @var Roles[]
     **/
    protected $roles = null;

    /**
     * @OneToMany(targetEntity="Permission", mappedBy="roleType")
     * @var Roles[]
     **/
    protected $permissions = null;

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }




}