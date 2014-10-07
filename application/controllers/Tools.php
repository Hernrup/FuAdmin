<?php

class Tools extends CI_Controller {

	public function test()
	{

		$em = $this->doctrine->em;

		$user = new User();
		$user->setName('A name');
		$em->persist($user);
		$em->flush();

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

	public function phpinfo()
	{

		phpinfo();
	}

	
}