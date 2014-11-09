<?php
namespace Entities;

/**
 * @UserSetting(name="usersetting")
 * @Entity
 */
class UserSetting extends CoreEntity{
    
     /**
     * @var int
     * @Id
     * @Column(type="integer", nullable=false)
     * @GeneratedValue
     */
    protected $id;
    
    /**
     * @var user
     * @OneToOne(targetEntity="User", mappedBy="userSetting")
     */
    protected $user;
    
    /**
     *
     * @var unit
     * @ManyToOne(targetEntity="Unit", inversedBy="userSetting")
     */
    protected $startUnit;
    
    public function getId() {
        return $this->id;
    }

    public function getUser() {
        return $this->user;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function getStartUnit() {
        return $this->startUnit;
    }

    public function setStartUnit($startUnit) {
        $this->startUnit = $startUnit;
    }


}

?>
