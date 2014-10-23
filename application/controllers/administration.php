<?php

/**
 * Description of administration
 *
 * @author dunken
 */
class Administration extends FU_Controller{
       
    
    public function index(){
        $data = new stdClass();
        
        //load twig and view
        $this->twig->displayRoute($data);    
    }
    
    public function unitCreate(){
        //Definera variabler
        $em = $this->doctrine->em;
        $data = new stdClass();
        
        //data to twig
        $data->treeLink = base_url('assets/administration/unitParents.twig');
        
        //load CI Resurces
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        
        //Get some data
        $data->unitTypes = $em->getRepository('UnitType')->findAll();
        $data->unitOrgs = $em->getRepository('UnitOrganisation')->findAll();
        $data->units = $em->getRepository('Unit')->findBy(array(), array('parent' => 'asc'), 1);        
        
        //Set rules
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        $this->form_validation->set_rules('unitName', 'Enhetsnamn', 'required');
        $this->form_validation->set_message('required', 'Fältet %s är obligatostiskt');
        
        if ($this->form_validation->run() == FALSE)
        {
            //load validation errors to twig
            $data->validation_errors = validation_errors();
            $this->twig->displayRoute($data);
        }
        else
        {
            $unitType = $em->find('UnitType', $this->input->post('unitType'));
            $orgType = $em->find('UnitOrganisation', $this->input->post('orgType'));
            $unitParent = $em->find('Unit', $this->input->post('parent'));
            
            $newUnit = new Unit();
            $newUnit->setName($this->input->post('unitName'));
            $newUnit->setEmail($this->input->post('email'));
            $newUnit->setCellphone($this->input->post('phone'));
            $newUnit->setIdentificationNr($this->input->post('identificationnr'));
            $newUnit->setUnitType($unitType);
            $newUnit->setOrganisationType($orgType);
            $newUnit->setParent($unitParent);
            
            $em->persist($newUnit);
            $em->flush();
            
            $unitId = $newUnit->getId();
            redirect(base_url('unit/'.$unitId), 'refresh');
        }
    }
    

}

?>
