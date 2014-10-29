<?php
use Entities\User;

class Tools extends CI_Controller {

	public function test(){
            $em = $this->doctrine->em;

            $user = new User();
            $user->setGivenname('A name');
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
        $em = $this->doctrine->em;
        $roles = $em->getRepository('Entities\User')->findBy(array('identificationNr' => 111));

        $unit_access = $em->getRepository('Entities\Unit')->findBy(array('name' => 'Level1_1'));
        $unit_child = $em->getRepository('Entities\Unit')->findBy(array('name' => 'Level2'));

        //check static access
        echo $acl->isAllowed($roles,"application","staticaccess", null) == true ? 'y':'n';

        //check access to non static access without unit
        echo $acl->isAllowed($roles,"application","access", null) == true ? 'y':'n';

        //check non existing permission, should fail
        echo $acl->isAllowed($roles,"application","nonexistent", null) == false ? 'y':'n';

        //check permission for cascading access
        echo $acl->isAllowed($roles,"application","access", $unit_access) == true ? 'y':'n';
        echo $acl->isAllowed($roles,"application","access", $unit_child) == true ? 'y':'n';

        //check permission for non-cascading access
        echo $acl->isAllowed($roles,"application","access2", $unit_access) == true ? 'y':'n';
        echo $acl->isAllowed($roles,"application","access2", $unit_child) == false ? 'y':'n';
        echo "\n";


    }

	public function phpinfo()
	{

		phpinfo();
	}

	
}