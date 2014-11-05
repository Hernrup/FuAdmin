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

