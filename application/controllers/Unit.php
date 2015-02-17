<?php

/**
 * Description of unit
 *
 * @author dunken
 */
class Unit extends FU_Controller{
    
    private $activeUnit;
    
    function __construct() {
        parent::__construct();
        
        //get the active unit from session
        $em = $this->doctrine->em;
        $sessionUnit = $this->session->userdata('unit');
        $this->activeUnit =  $this->doctrine->em->merge($sessionUnit);
 
    }
    
    public function index(){
        //Definera variabler and load resurces
        $em = $this->doctrine->em;
        $data = new stdClass();
        $this->load->library('form_validation');
              
        //get data for form
        $data->unitId = $this->activeUnit->getId();
        $data->unitName = $this->activeUnit->getName();
        
        $data->unitEmail = $this->activeUnit->getEmail();
        $data->unitIdentificationNr = $this->activeUnit->getIdentificationNr();
        $data->unitCellphone = $this->activeUnit->getCellphone();
        
        //if form is runned we check data and send back
        if ($this->form_validation->run() == FALSE)
        {
            //load validation errors to twig
            $data->validation_errors = validation_errors();
            
            //get the data
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
        }

        $this->twig->displayRoute($data);
        
    }

        public function members(){
        //Definera variabler
        $em = $this->doctrine->em;
        $data = new stdClass();
        
        //get the roles to unit
        //$this->activeUnit
        
        //get
        $qb = $em->createQueryBuilder()
            ->select('*')
            ->from('Entity\User', 'u')
            ->leftjoin('u.id', 'Entity\Role');
        
        
        $this->twig->displayRoute($data);
    }

}

?>
