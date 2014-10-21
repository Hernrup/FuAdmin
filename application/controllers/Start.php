<?php
class Start extends CI_Controller{
    
    public function index(){
        $data = new stdClass();

        
        // $this->load->view('user/index.twig');
        $this->twig->displayRoute($data);
    }
}