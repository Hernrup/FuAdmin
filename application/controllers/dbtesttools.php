<?php


class DBTestTools extends \CLIController {

    public function rebuild(){
        $this->down();
        $this->up();
    }

    public function up(){
        try {
            $em = $this->doctrine->em;

            $user = new Entities\User();
            $user->setGivenname('MHE');
            $user->setLastname('Admin');
            $user->setPassword('a45b6c5c12c38ab7b9a4fb94c618361c5d7c1a95');
            $user->setEmail('mikael@hernrup.se');
            $user->setIdentificationNr('111');
            $user->setCellphone('070112233');
            $em->persist($user);
            $em->flush();
            echo sprintf("Created User %s \n", $user->getGivenname());

            $user = new Entities\User();
            $user->setGivenname('FRO');
            $user->setLastname('Admin');
            $user->setPassword('a45b6c5c12c38ab7b9a4fb94c618361c5d7c1a95');
            $user->setEmail('frosenlind@gmail.com');
            $user->setIdentificationNr('222');
            $user->setCellphone('070112233');
            $em->persist($user);
            $em->flush();
            echo sprintf("Created User %s \n", $user->getGivenname());
        }
        catch(Exception $err){
            die($err->getMessage());
        }
    }

    public  function down(){
        try {
            $this->doctrine->truncateTable("Entities\\User");

        }
        catch(Exception $err){
            die($err->getMessage());
        }
    }
} 