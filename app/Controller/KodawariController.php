<?php 
App::uses('AppController','Controller');
App::uses('Sanitiz','Utility');
class KodawariController extends AppController{
	public function index(){
		$helpers = array('Form');
		$this->modelClass = null;
	}
}

 ?>
