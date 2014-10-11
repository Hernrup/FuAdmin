<?php

class User extends FU_Controller {

	public function index()
	{
		// $this->load->view('user/index.twig');
		$this->twig->displayRoute(array("myTestVar" => "testVal"));
	}
}

