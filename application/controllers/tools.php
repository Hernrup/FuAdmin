<?php

class Tools extends CI_Controller {

	public function test(){
            $em = $this->doctrine->em;

            $user = new User();
            $user->setName('A name');
            $user->setEmail('m@h.se');

            try {
                //save to database
                $em->persist($user);
                $em->flush();
            }
            catch(Exception $err){
                die($err->getMessage());
            }

            echo "Created User with ID " . $user->getId() . "\n";

            $users = $em->getRepository('User')->findAll();

            foreach ($users as $u) {
                echo sprintf("%s-%s\n",$u->getId(), $u->getName());
            }
	}

    public function aclTest(){
        $acl = new acl\Acl();
        $roles = [];

        $role = new Role();
        $role->setId(1);

        $roletype = new RoleType();
        $roletype->setName("Styrelse");
        $role->setRoleType($roletype);

        array_push($roles,$role);

        $resource = new acl\StaticResource();
        $resource->setName("Dynamic");

        echo $acl->isAllowed($roles,"login","register") ? 'y':'n';
        echo "\n";
        echo $acl->isAllowed($roles,"login","reset_password") ? 'y':'n';
        echo "\n";
        echo $acl->isAllowed($roles,$resource,"test") ? 'y':'n';
        echo "\n";
        echo $acl->isAllowed($roles,new stdClass(),"test") ? 'y':'n';
        echo "\n";


    }

	public function phpinfo()
	{

		phpinfo();
	}

	
}