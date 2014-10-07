<?php

class User extends CI_Controller {

	public function index()
	{
		// $this->load->view('user/index.twig');
		$this->twig->displayRoute(array("myTestVar" => "testVal"));
	}
}

