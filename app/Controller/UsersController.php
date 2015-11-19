<?php

App::uses('AppController', 'Controller');


class UsersController extends AppController {
	public $name = 'Users';

	public function index()
	{
		$this->redirect(login);
	}

	public function login()
	{
		
	}

}
