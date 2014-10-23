<?php
/**
 *
 *
 * @RoleType(name="unitorganisation")
 * @Entity
 */
class UnitOrganisation
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
     * @OneToMany(targetEntity="unit", mappedBy="organisationType")
     * @var organisations[]
     **/
    protected $organisations = null;

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getOrganisations() {
        return $this->organisations;
    }

    public function setOrganisations($organisations) {
        $this->organisations = $organisations;
    }


}