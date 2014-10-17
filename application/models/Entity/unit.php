<?php
/**
 * 
 *
 * @Unit(name="unit")
 * @Entity
 * 
 */
class Unit
{
    /**
     * @var int
     * @Id
	 * @Column(type="integer", nullable=false)
	 * @GeneratedValue
     */
    protected $id;
    
    /**
     * @OneToMany(targetEntity="Unit", mappedBy="parent")
     */
    protected $children;

    /**
     * @ManyToOne(targetEntity="Unit", inversedBy="children")
     * @JoinColumn(name="parent", referencedColumnName="id")
     */
    private $parent;
    
    /**
     * @ManyToOne(targetEntity="UnitType", inversedBy="units")
     **/
    protected $unitType;

    /**
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $name;

   /**
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $email;

    /**
     *
     * @var string 
     * @Column(type="string", nullable=true, name="identificationnr")
     */
    protected $identificationNr;
    
    /**
     *
     * @var string
     * @Column (type="string", nullable=true)
     */
    protected $cellphone;   
    
    function __construct() {
        //$this->children = new ArrayCollection(); ????
    }

    public function getId() {
        return $this->id;
    }

    public function getChildren() {
        return $this->children;
    }

    public function setChildren(Unit $children) {
       $this->children[] = $child;
       $child->setParent($this);
    }

    public function getParent() {
        return $this->parent;
    }

    public function setParent(Unit $parent) {
        $this->parent = $parent;
    }

    public function getUnitType() {
        return $this->unitType;
    }

    public function setUnitType($unitType) {
        $this->unitType = $unitType;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
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


}