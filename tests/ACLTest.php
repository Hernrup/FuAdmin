<?php

namespace tests;

class ACLTest extends \PHPUnit_Framework_TestCase{
    private $CI;
    private $acl;
    private $em;
    private $roles;
    private $unit_access;
    private $unit_child;

    public function setUp() {
        $this->CI = &get_instance();
        $this->acl = new \acl\Acl();

        $this->em = $this->CI->doctrine->em;
        $user = $this->em->getRepository('Entities\User')->findOneBy(array('identificationNr' => 111));
        $this->roles = $user->getRoles();
        $this->unit_access = $this->em->getRepository('Entities\Unit')->findOneBy(array('name' => 'Level1_1'));
        $this->unit_child = $this->em->getRepository('Entities\Unit')->findOneBy(array('name' => 'Level2'));

//        $unit1 = $this->getMock('Entities\Unit');
//        $unit1->method('getParent')->will($this->returnValue(null));
//
//        $unit2 = $this->getMock('Entities\Unit');
//        $unit2->method('getParent')->will($this->returnValue($unit1));
//
//        $unit3 = $this->getMock('Entities\Unit');
//        $unit3->method('getParent')->will($this->returnValue($unit1));
//
//        $unit4 = $this->getMock('Entities\Unit');
//        $unit4->method('getParent')->will($this->returnValue($unit2));
//
//        $roletype1 = $this->getMock('Entities\RoleType');
//
//        $roletype2 = $this->getMock('Entities\RoleType');
//
//        $role = $this->getMock('Entities\Role');
//        $role->method('getRoleType')->will($this->returnValue($roletype1));
//        $role->method('getUnit')->will($this->returnValue(null));
//
//        $role2 = $this->getMock('Entities\Role');
//        $role2->method('getRoleType')->will($this->returnValue($roletype1));
//        $role2->method('getUnit')->will($this->returnValue($unit2));
//
//        $role2 = $this->getMock('Entities\Permission');
//        $role2->method('getRoleType')->will($this->returnValue($roletype1));
//
//
//        $perm1 = $this->_createPermission($em, $roletype1, "application", "staticaccess", false);
//        $perm1 = $this->_createPermission($em, $roletype2, "application", "access", true);
//        $perm1 = $this->_createPermission($em, $roletype2, "application", "access2", false);
    }


    public function test_StaticAccess(){
        $this->assertTrue($this->acl->isAllowedForRoleCollection($this->roles,"application","staticaccess", null));
    }
//
    public function test_check_access_to_non_static_access_without_unit(){
        $this->assertTrue($this->acl->isAllowedForRoleCollection($this->roles,"application","access", null));
    }

    public function test_check_non_existing_permission_should_fail(){
        $this->assertFalse($this->acl->isAllowedForRoleCollection($this->roles,"application","nonexistent", null));
    }

    public function test_check_permission_for_cascading_access_unit(){
        $this->assertTrue($this->acl->isAllowedForRoleCollection($this->roles,"application","access", $this->unit_access));
    }

    public function test_check_permission_for_cascading_access_child(){
        $this->assertTrue($this->acl->isAllowedForRoleCollection($this->roles,"application","access", $this->unit_child));
    }

    public function test_check_permission_for_non_cascading_access_unit(){
        $this->assertTrue($this->acl->isAllowedForRoleCollection($this->roles,"application","access2", $this->unit_access));
    }
    public function test_check_permission_for_non_cascading_access_child(){
        $this->assertFalse($this->acl->isAllowedForRoleCollection($this->roles,"application","access2", $this->unit_child));
    }



}

