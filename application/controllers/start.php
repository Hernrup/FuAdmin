<?php
class Start extends FU_Controller{
    
    public function index(){
        $data = new stdClass();
        $data->username = 'dunken';
        
       
        $this->twig->displayRoute($data);
    }
}