<?php
class Login extends FU_Controller{

    public function index(){
        $data = new stdClass();
        $data->username = 'dunken';
        
        // $this->load->view('user/index.twig');
        $this->twig->displayRoute($data);
    }
}