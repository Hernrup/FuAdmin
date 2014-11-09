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
        //Definera variabler
        $em = $this->doctrine->em;
        $data = new stdClass();
                

        $this->twig->displayRoute($data);
        
    }

        public function members(){
        //Definera variabler
        $em = $this->doctrine->em;
        $data = new stdClass();
                

        $this->twig->displayRoute($data);
    }

}

?>
