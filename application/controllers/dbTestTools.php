<?php


class DBTestTools extends \CLIController {

    public function rebuild(){
        $this->down();
        $this->up();
    }

    public function up(){
        try {
            $em = $this->doctrine->em;

            $user2 = new Entities\User();
            $user2->setGivenname('Sys');
            $user2->setLastname('Admin');
            $user2->setPassword('a45b6c5c12c38ab7b9a4fb94c618361c5d7c1a95');
            $user2->setEmail('test@test.test');
            $user2->setIdentificationNr('111');
            $user2->setCellphone('070112233');
            $em->persist($user2);

            $entityUnitHead = new Entities\Unit();
            $entityUnitHead->setName("Head");
            $em->persist($entityUnitHead);

            $entityLev1 = new Entities\Unit();
            $entityLev1->setName("Level1_1");
            $entityLev1->setParent($entityUnitHead);
            $em->persist($entityLev1);

            $entityLev1 = new Entities\Unit();
            $entityLev1->setName("Level1_2");
            $entityLev1->setParent($entityUnitHead);
            $em->persist($entityLev1);

            $entityLev2 = new Entities\Unit();
            $entityLev2->setName("Level2");
            $entityLev2->setParent($entityLev1);
            $em->persist($entityLev2);

            $roletype1 = new Entities\RoleType();
            $roletype1->setName("Admin");
            $em->persist($roletype1);

            $roletype2 = new Entities\RoleType();
            $roletype2->setName("Sysadmin");
            $em->persist($roletype2);

            $role = new Entities\Role();
            $role->setRoleType($roletype1);
            $role->setUser($user2);
            $em->persist($role);

            $role = new Entities\Role();
            $role->setRoleType($roletype1);
            $role->setUser($user2);
            $role->setUnit($entityLev1);
            $em->persist($role);
            
            $userSetting1 = new Entities\UserSetting();
            $userSetting1->setStartUnit($entityLev1);
            $user2->setUserSetting($userSetting1);
            
            $em->persist($userSetting1);
            $em->persist($user2);
            

            $em->flush();

            echo sprintf("All entites created \n");
        }
        catch(Exception $err){
            die($err->getMessage());
        }
    }

    public  function down(){
        try {
            $this->doctrine->truncateTable("Entities\\User");
            $this->doctrine->truncateTable("Entities\\UserSetting");
            $this->doctrine->truncateTable("Entities\\Role");
            $this->doctrine->truncateTable("Entities\\RoleType");
            $this->doctrine->truncateTable("Entities\\Unit");
            $this->doctrine->truncateTable("Entities\\UnitType");
        }
        catch(Exception $err){
            die($err->getMessage());
        }
    }
} 