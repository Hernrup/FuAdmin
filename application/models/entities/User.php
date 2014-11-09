<?php

namespace Entities;

/**
 * 
 *
 * @User(name="user")
 * @Entity
 * 
 */
class User extends CoreEntity
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
     * @Column(type="string", nullable=false)
     */
    protected $givenname;
    
    /**
     *
     * @var string
     * @Column (type="string", nullable=false)
     */
    protected $lastname;

   /**
     * @var string
     * @Column(type="string", nullable=false, unique=true)
     */
    protected $email;
    
    /**
     *
     * @var string
     * @Column (type="string", nullable=false, length=255)
     */
    protected $password;


    /**
     *
     * @var string 
     * @Column(type="string", nullable=false, name="identificationnr")
     */
    protected $identificationNr;
    
    /**
     *
     * @var string
     * @Column (type="string")
     */
    protected $cellphone;

    /**
     * @OneToMany(targetEntity="Role", mappedBy="user")
     * @var Roles[]
     **/
    protected $roles = null;
    
    /**
     * @var userSetting
     * @OneToOne(targetEntity="UserSetting", inversedBy="user")
     */
    protected $userSetting;


    public function getId() {
        return $this->id;
    }

    public function getGivenname() {
        return $this->givenname;
    }

    public function setGivenname($givenname) {
        $this->givenname = $givenname;
    }

    public function getLastname() {
        return $this->lastname;
    }

    public function setLastname($lastname) {
        $this->lastname = $lastname;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }
    
    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getIdentificationNr() {
        return $this->identificationNr;
    }

    public function setIdentificationNr($identificationNr) {
        $this->identificationNr = $identificationNr;
    }

    public function getCellphone() {
        return $this->cellphone;
    }

    public function setCellphone($cellphone) {
        $this->cellphone = $cellphone;
    }

    public function getUserSetting() {
        return $this->userSetting;
    }

    public function setUserSetting($userSetting) {
        $this->userSetting = $userSetting;
    }


    
}