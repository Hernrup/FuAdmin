<?php
class Start extends CI_Controller{
    
    public function index(){
        $data = new stdClass();
        $data->username = 'dunken';
        
        // some testing thins
                 
        $parent = $this->doctrine->em->find('Unit', 1);
        $unitType = $this->doctrine->em->find('unitType', 3);
        
        $unit = new Unit();
        $unit->setName('Trelleborg');
        $unit->setParent($parent);
        $unit->setUnitType($unitType);
        
        $this->doctrine->em->persist($unit);
        //$this->doctrine->em->flush();
        
        // $this->load->view('user/index.twig');
        $this->twig->displayRoute($data);
    }
}