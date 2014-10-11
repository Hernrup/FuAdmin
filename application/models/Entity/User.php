<?php
/**
 * 
 *
 * @User(name="user")
 * @Entity
 */
class User
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
     * @Column(type="string", nullable=false)
     */
    protected $email;
    
    public function setEmail($email) {
        $this->email = $email;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
}