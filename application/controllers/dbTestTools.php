<?php


class DBTestTools extends \CLIController {

    public function rebuild(){
        $this->down();
        $this->up();
    }

    public function up(){
        echo sprintf("Up! \n");
        try {
            $em = $this->doctrine->em;

            $user1 = $this->_createUser($em, "Admin", 'a45b6c5c12c38ab7b9a4fb94c618361c5d7c1a95', '111');
            $user2 = $this->_createUser($em, "Admin2", 'a45b6c5c12c38ab7b9a4fb94c618361c5d7c1a95', '222');

            $unit1 = $this->_createUnit($em, "Head", null);
            $unit2 = $this->_createUnit($em, "Level1_1", $unit1);
            $unit3 = $this->_createUnit($em, "Level1_2", $unit1);
            $unit4 = $this->_createUnit($em, "Level2", $unit2);

            $roletype1 = $this->_createRoleType($em, "Admin");
            $roletype2 = $this->_createRoleType($em, "Publisher");

            $role = $this->_createRole($em,$roletype1,$user1, null);
            $role2 = $this->_createRole($em,$roletype2,$user1, $unit2);

            $perm1 = $this->_createPermission($em, $roletype1, "application", "staticaccess", false);
            $perm1 = $this->_createPermission($em, $roletype2, "application", "access", true);
            $perm1 = $this->_createPermission($em, $roletype2, "application", "access2", false);

            echo sprintf("All entites created \n");
        }
        catch(Exception $err){
            die($err->getMessage());
        }
    }

    private function _createUser($em, $name, $password, $identification){
        $user2 = new Entities\User();
        $user2->setGivenname($name);
        $user2->setLastname('Test');
        $user2->setPassword($password);
        $user2->setEmail('test@test.test');
        $user2->setIdentificationNr($identification);
        $user2->setCellphone('070112233');
        $em->persist($user2);
        return $user2;
    }

    private function _createUnit($em, $name, $parent){
        $obj = new Entities\Unit();
        $obj->setName($name);
        if($parent != null){
            $obj->setParent($parent);
        }
        $em->persist($obj);
        return $obj;
    }

    private function _createRole($em, $roletype1, $user2, $unit){
        $role = new Entities\Role();
        $role->setRoleType($roletype1);
        $role->setUser($user2);
        if($unit != null){
            $role->setUnit($unit);
        }
        $em->persist($role);
        return $role;
    }

    private function _createRoleType($em, $name){
        $roletype2 = new Entities\RoleType();
        $roletype2->setName($name);
        $em->persist($roletype2);
        return $roletype2;
    }

    private function _createPermission($em, $type, $res, $action, $inherit){
        $obj = new Entities\Permission();
        $obj->setRoleType($type);
        $obj->setResource($res);
        $obj->setAction($action);
        $obj->setInherit($inherit);
        $em->persist($obj);
        $em->flush();
        return $obj;
    }

    public  function down(){
        try {
            $this->doctrine->truncateTable("Entities\\User");
            $this->doctrine->truncateTable("Entities\\Role");
            $this->doctrine->truncateTable("Entities\\RoleType");
            $this->doctrine->truncateTable("Entities\\Unit");
            $this->doctrine->truncateTable("Entities\\UnitType");
            $this->doctrine->truncateTable("Entities\\Permission");
        }
        catch(Exception $err){
            die($err->getMessage());
        }
    }
} 