<?php

class User extends FU_Controller {

    public function index()
    {
            // $this->load->view('user/index.twig');
            $this->twig->displayRoute(array("myTestVar" => "testVal"));
    }

    public function new_member(){

        //Define variables and load resurces
        $em = $this->doctrine->em;
        $data = new stdClass();
        $this->load->library('form_validation');

        
        //Set rules
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        $this->form_validation->set_rules('identificationNr', 'Personnummer', 'required');
        $this->form_validation->set_rules('givenname', 'Förnamn', 'required');
        $this->form_validation->set_rules('lastname', 'Efternamn', 'required');
        $this->form_validation->set_rules('email', 'E-postadress', 'required|valid_email');
        $this->form_validation->set_message('required', 'Fältet %s är obligatostiskt');

        //if form is runned we check data and send back
        if ($this->form_validation->run() == FALSE)
        {
            //load validation errors to twig
            $data->validation_errors = validation_errors();
            $this->twig->displayRoute($data); 
            
        }else{
            //load some data
            $activeUnit = $this->auth->getSessionUnit();
            $RoleType = $em->getRepository('Entities\RoleType')->findOneBy(array('id' => 3));  
            
            
            //get the data
            $identificationNr = $this->input->post('identificationNr');
            $givenname = $this->input->post('givenname');
            $lastname = $this->input->post('lastname');
            $email = $this->input->post('email');
            
            
            //skapa user setting
            $newUserSetting = new Entities\UserSetting();
            $newUserSetting->setStartUnit($activeUnit);
            $em->persist($newUserSetting);
            
            //skapa användare och lägg till basdata
            $newUser = new Entities\User();
            $newUser->setIdentificationNr($identificationNr);
            $newUser->setGivenname($givenname);
            $newUser->setLastname($lastname);
            $newUser->setEmail($email);
            $newUser->setUserSetting($newUserSetting);
            $em->persist($newUser);
                        
            //lägg till Role
            $newRole = new Entities\Role();
            $newRole->setRoleType($RoleType);
            $newRole->setUnit($activeUnit);
            $newRole->setUser($newUser);
            $em->persist($newRole);
            
            $em->flush();

            $userId = $newUser->getId();
            redirect(base_url('user/'.$userId), 'refresh');
        }

        
    }
}

