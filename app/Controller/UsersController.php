<?php

App::uses('AppController', 'Controller');


class UsersController extends AppController {
	public $name = 'Users';
	//コンポーネントの設定
	public $components = array(
		'Session',
		'Auth' => array(
			'authenticate' => array(
				'Form' => array(
					'userModel' => 'User',
					'fields' => array('username' => 'e-mail','password' => 'password'),
				)
			),
			//ログイン後の移動先
			'loginRedirect' => array('controller' => 'users','action' => 'index'),
			//ログアウト後の移動先
			'logoutRedirect' => array('controller' => 'users','action' => 'login'),
		)
	);

	//必ず一番初めに実行されるアクション
	//ログイン検査
	public function beforeFilter(){
		//親のAppControllerにbeforeFilterがあった場合
		//parent::beforeFilter();

		//未ログインユーザーが見られるアクション
		$this->Auth->allow('register','logout','login');
	}

	//ログイン後の表示
	public function index()
	{
		$data = $this->User->find('all');
		debug($data);
		$this->render('index');
	}

	public function login()
	{
		if($this->request->is('Post')){
			debug($this->Auth->login());
			if($this->Auth->login()){
				return $this->redirect($this->Auth->redirectUrl());
			} else {
				$this->Session->setFlash('ログイン失敗');
			}
		}
	}

	public function logout(){
		$this->Auth->logout();
		$this->Session->destroy();
		$this->Session->setFlash('ログアウトしました');
		$this->redirect($this->Auth->redirectUrl());
	}

	public function register(){
		if($this->request->is('Post')){
			$data = array('User' => array(
				'name' => $this->request->data['User']['name'],
				'e-mail' => $this->request->data['User']['e-mail'],
				'password' => $this->request->data['User']['password']
				));
			$fields = array('name','e-mail','password');
			if($this->User->save($data,false,$fields)){
				$this->Session->setFlash('新規ユーザーを追加しました');
				$this->redirect('login');
			} else {
				$this->Session->setFlash('登録できませんでした。やり直して下さい');
				$this->redirect('register');
			}
		}
	}

}
