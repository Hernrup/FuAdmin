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
        $data->unitTypes = $em->getRepository('Entities\UnitType')->findAll();
        $data->unitOrgs = $em->getRepository('Entities\UnitOrganisation')->findAll();
        $data->units = $em->getRepository('Entities\Unit')->findBy(array(), array('parent' => 'asc'), 1);        
        
        //Set rules
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        $this->form_validation->set_rules('unitName', 'Enhetsnamn', 'required|callback__alpha_int');
        $this->form_validation->set_rules('email', 'E-postadress', 'valid_email');
        $this->form_validation->set_rules('parent', 'Förälder', 'required|integer');
        $this->form_validation->set_message('required', 'Fältet %s är obligatostiskt');
        $this->form_validation->set_message('integer', 'Fältet %s måste vara numeriskt');
        $this->form_validation->set_message('alpha_numeric', 'Fältet %s får endast innehålla siffor och bokstäver');
        
        if ($this->form_validation->run() == FALSE)
        {
            //load validation errors to twig
            $data->validation_errors = validation_errors();
            $this->twig->displayRoute($data);
        }
        else
        {
            try {
                //unitType
                if(!is_numeric($this->input->post('unitType')))
                    {throw new Exception('unitType must be integer');}
                    $unitType = $em->find('Entities\UnitType', $this->input->post('unitType'));
                
                //orgType
                if(!is_numeric($this->input->post('orgType')))
                    {throw new Exception('orgType must be integer');}
                    $orgType = $em->find('Entities\UnitOrganisation', $this->input->post('orgType'));
                    
                //parent
                if(!is_numeric($this->input->post('parent')))
                    {throw new Exception('parent must be integer');}
                    $unitParent = $em->find('Entities\Unit', $this->input->post('parent'));    
                
                
                
                $newUnit = new Entities\Unit();
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
            catch(Exception $err){
                die($err->getMessage());
            }
        }
    }
    
    public function unitType(){
        //Definera variabler
        $em = $this->doctrine->em;
        $data = new stdClass();
        
        //load CI Resurces
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        //Get some data
        $data->unitTypes = $em->getRepository('Entities\UnitType')->findAll();        
        
        //Set rules
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        $this->form_validation->set_rules('unitTypeName', 'Enhetsnamn', 'required|callback__alpha_int|is_unique[UnitType.name]');
        $this->form_validation->set_message('required', 'Fältet %s är obligatostiskt');
        $this->form_validation->set_message('alpha_numeric', 'Fältet %s får endast innehålla siffor och bokstäver');
        $this->form_validation->set_message('is_unique', 'Fältet %s måste vara unikt');
        
        if ($this->form_validation->run() == FALSE)
        {
            //load validation errors to twig
            $data->validation_errors = validation_errors();
            $this->twig->displayRoute($data);
        }
        else
        {
            try {

                $newUnitType = new Entities\UnitType();
                $newUnitType->setName($this->input->post('unitTypeName'));    

                $em->persist($newUnitType);
                $em->flush();

                redirect(base_url('administration/unitType'), 'refresh');
            }
            catch(Exception $err){
                die($err->getMessage());
            }
        } 
    }
    
public function unitOrg(){
        //Definera variabler
        $em = $this->doctrine->em;
        $data = new stdClass();
        
        //load CI Resurces
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        //Get some data
        $data->unitOrgs = $em->getRepository('Entities\UnitOrganisation')->findAll();        
        
        //Set rules
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        $this->form_validation->set_rules('unitOrgName', 'Enhetsnamn', 'required|callback__alpha_int|is_unique[UnitType.name]');
        $this->form_validation->set_message('required', 'Fältet %s är obligatostiskt');
        $this->form_validation->set_message('alpha_numeric', 'Fältet %s får endast innehålla siffor och bokstäver');
        $this->form_validation->set_message('is_unique', 'Fältet %s måste vara unikt');
        
        if ($this->form_validation->run() == FALSE)
        {
            //load validation errors to twig
            $data->validation_errors = validation_errors();
            $this->twig->displayRoute($data);
        }
        else
        {
            try {

                $newUnitOrganisation = new Entities\UnitOrganisation();
                $newUnitOrganisation->setName($this->input->post('unitOrgName'));    

                $em->persist($newUnitOrganisation);
                $em->flush();

                redirect(base_url('administration/unitOrg'), 'refresh');
            }
            catch(Exception $err){
                die($err->getMessage());
            }
        } 
    }
    
public function roleType(){
        //Definera variabler
        $em = $this->doctrine->em;
        $data = new stdClass();
        
        //load CI Resurces
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        //Get some data
        $data->roleTypes = $em->getRepository('Entities\RoleType')->findAll();        
        
        //Set rules
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        $this->form_validation->set_rules('roleTypeName', 'Rolltypsnamn', 'required|callback__alpha_int|is_unique[RoleType.name]');
        $this->form_validation->set_message('required', 'Fältet %s är obligatostiskt');
        $this->form_validation->set_message('alpha_numeric', 'Fältet %s får endast innehålla siffor och bokstäver');
        $this->form_validation->set_message('is_unique', 'Fältet %s måste vara unikt');
        
        if ($this->form_validation->run() == FALSE)
        {
            //load validation errors to twig
            $data->validation_errors = validation_errors();
            $this->twig->displayRoute($data);
        }
        else
        {
            try {

                $newRoleType = new Entities\RoleType();
                $newRoleType->setName($this->input->post('roleTypeName'));    

                $em->persist($newRoleType);
                $em->flush();

                redirect(base_url('administration/roleType'), 'refresh');
            }
            catch(Exception $err){
                die($err->getMessage());
            }
        } 
    }
    
    public function _alpha_int($str)
    {
        $this->form_validation->set_message('_alpha_int', 'Du kan bara använda text');
        
        $str = (strtolower($this->config->item('charset')) != 'utf-8') ? utf8_encode($str) : $str;

        return ( ! preg_match("/^[[:alpha:]- ÀÁÂÃÄÅĀĄĂÆÇĆČĈĊĎĐÈÉÊËĒĘĚĔĖĜĞĠĢĤĦÌÍÎÏĪĨĬĮİĲĴĶŁĽĹĻĿÑŃŇŅŊÒÓÔÕÖØŌŐŎŒŔŘŖŚŠŞŜȘŤŢŦȚÙÚÛÜŪŮŰŬŨŲŴÝŶŸŹŽŻàáâãäåæçèéêëìíîïñòóôõöøùúûüýÿœšß_.]+$/", $str)) ? FALSE : TRUE;
    } 
    

}

?>
