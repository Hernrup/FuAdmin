<?php
class Start extends FU_Controller{
    
    public function index(){
        $data = new stdClass();
        $data->username = 'dunken';
        
        // some testing thins
        $this->load->model('entity/unittype');
        $this->load->model('entity/unit');
                 
        $parent = $this->doctrine->em->find('Unit', 4);
        $unitType = $this->doctrine->em->find('unitType', 2);
        
        $unit = new Unit();
        $unit->setName('Malmö');
        $unit->setParent($parent);
        $unit->setUnitType($unitType);
        
        $this->doctrine->em->persist($unit);
        //$this->doctrine->em->flush();
        
        // $this->load->view('user/index.twig');
        $this->twig->displayRoute($data);
    }
}