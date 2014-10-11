<?php
class FU_Controller extends CI_Controller{
    
    function __construct()
    {
        parent::__construct();
        $this->twig->add_function('base_url');
    }
}