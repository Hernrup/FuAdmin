<?php
class CLIController extends FU_Controller{

    function __construct()
    {
        parent::__construct();

        if(!$this->input->is_cli_request())
        {
            throw new Exception("Access is only allowed though CLI",403);
        }
    }
}