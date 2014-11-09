<?php

/**
 * Contact information
 *
 * @author dunken
 */
class Contact extends FU_Controller{
    
    public function index(){
        //Definera variabler
        $em = $this->doctrine->em;
        $data = new stdClass();
        
        $this->twig->displayRoute($data);
    }
    
}

?>
