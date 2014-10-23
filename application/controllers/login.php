<?php
class Login extends CI_Controller{

    public function index(){
        $data = new stdClass();
        $data->base_url = base_url();
        
        //load CI Resurces
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        //Set rules
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        $this->form_validation->set_rules('username', 'Personnummer', 'required');
        $this->form_validation->set_rules('password', 'Lösenord', 'required|callback__check_login');
        $this->form_validation->set_message('required', 'Fältet %s är obligatostiskt');
        
        if ($this->form_validation->run() == FALSE)
        {
            //load validation errors to twig
            $data->validation_errors = validation_errors();
            $this->twig->displayRoute($data);
        }
        else
        {
             redirect('start', 'refresh');
        }
    }
    
    public function logout(){
        $this->session->sess_destroy();
        redirect(base_url(), 'refresh');
    }

    public function _check_login(){
        //get post data
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        
        //load own library
        $this->load->library('auth');
        $this->form_validation->set_message('check_login', 'Ditt användarnamn eller lösenord är fel!');
        
        //if true login sets session and data
        if ($this->auth->login($username, $password)): return true; else: return false; endif;
    }
}