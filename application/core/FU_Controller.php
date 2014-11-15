<?php
class FU_Controller extends CI_Controller{
    
    var $activeUser;
    
    function __construct()
    {
        parent::__construct();
        
        //add base url to twig
        $this->twig->add_function('base_url');
        
        //check if logged in
        if(!$this->auth->isAuthorized()){
            redirect(base_url(), 'refresh');
        }
         
        $this->twig->addData(array(
            'activeUser' => $this->auth->getSessionUser(),
            'activeUnit' => $this->auth->getSessionUnit()
            ));
    }
}