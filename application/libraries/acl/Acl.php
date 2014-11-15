<?php

namespace acl;

class Acl
{

    protected $CI;
    protected $em;

    /**
     *
     */
    function __construct()
    {
        $this->CI =& get_instance();
        $this->em = $this->CI->doctrine->em;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getUserRoleCollection()
    {

        // fetch session
        $userId = $this->CI->session->userdata('activeUser');

        // verify session existance
        if (!$userId) {
            return array();
        }

        //fetchUser
        $user = $this->em->getRepository('Entities\User')->findBy(array('id' => $userId));
        if (!$user) {
            throw new \Exception("Logged in user could not be found");
        }

        return $user->getRoles();
    }

    /**
     * @param $resource
     * @param $action
     * @param $unit
     * @throws \Exception
     */
    public function isAllowed($resource, $action, $unit)
    {
        $this->isAllowedForRole($this->getUserRoleCollection(), $resource, $action, $unit);
    }

    /**
     * @param array $roleCollection
     * @param $resource
     * @param $action
     * @param $unit
     * @return bool
     */
    public function isAllowedForRoleCollection(Array $roleCollection, $resource, $action, $unit)
    {
        // check each role for access logic
        foreach ($roleCollection as $role) {
            if ($this->isAllowedForRole($role, $resource, $action, $unit)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param $role
     * @param $resource
     * @param $action
     * @param $unit
     * @return bool
     */
    public function isAllowedForRole($role, $resource, $action, $unit, $permissionRepository = null)
    {
        $repo = $permissionRepository != null ? $permissionRepository : $this->em->getRepository('Entities\Permission');
        $permissions = $repo->findBy(array(
            'roleType' => $role->getRoleType()->getId(),
            'resource' => $resource,
            'action' => $action
        ));

        // check permission
        if (count($permissions) == 0) {
            return false;
        }

        // not dependent on unit
        if ($unit == null) {
            return true;
        }

        //check permission on exact unit
        if($role->getUnit()->getId() == $unit->getId()){
            return true;
        }

        // check for cascading params
        foreach ($permissions as $perm) {
            if ($perm->getInherit() == true) {
                return ($this->checkUnitIdRecursive($role->getUnit(),$unit));
            }
        }

        // access could not be resolved, revoke access
        return false;
    }

    /**
     * @param $requiredUnit
     * @param $unitUnderTest
     * @return bool
     */
    public function checkUnitIdRecursive($requiredUnit, $unitUnderTest){
        // required unit found, quit
        if ($requiredUnit->getId() == $unitUnderTest->getId()) {
            return true;
        }

        // parent of current unit is null, search failed
        if($unitUnderTest->getParent() == null){
            return false;
        }

        // parent exists, continue search on parent
        return $this->checkUnitIdRecursive($requiredUnit, $unitUnderTest->getParent());
    }

}

