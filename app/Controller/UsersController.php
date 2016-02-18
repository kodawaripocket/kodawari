<?php

App::uses('AppController', 'Controller');

class UsersController extends AppController {
	public $uses = array('User', 'Area');
	public $name = 'Users';
	//コンポーネントの設定
	public $components = array(
		'Session',
		'Auth'          => array(
			'authenticate' => array(
				'Form'        => array(
					'userModel'  => 'User',
					'fields'     => array('username'     => 'e-mail', 'password'     => 'password'),
				)
			),
			//ログイン後の移動先
			'loginRedirect' => array('controller' => 'users', 'action' => '../Articles/index'),
			//ログアウト後の移動先
			'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
		)
	);

	//必ず一番初めに実行されるアクション
	//ログイン検査
	public function beforeFilter() {
		//親のAppControllerにbeforeFilterがあった場合
		//parent::beforeFilter();

		//未ログインユーザーが見られるアクション
		$this->Auth->allow('register', 'logout', 'login');
	}

	//ログイン後の表示
	public function main() {
		$data = $this->User->find('all');
		debug($data);
		$this->render('main');
	}

	public function login() {

		if ($this->Auth->loggedIn()) {
			$this->redirect('main');
		}

		if ($this->request->is('Post')) {
			if ($this->Auth->login()) {
				return $this->redirect($this->Auth->redirectUrl());
			} else {
				$this->Session->setFlash('ログイン失敗');
			}
		}
	}

	public function logout() {
		$this->Auth->logout();
		$this->Session->destroy();
		$this->Auth->allow('register', 'login');
		$this->Session->setFlash('ログアウトしました');
		$this->redirect($this->Auth->logout());
	}

	public function register() {
		//ログイン状態であるなら登録画面に移動できないようにする。
		if ($this->Auth->loggedIn()) {
			$id = 1000;
			$this->redirect(array('controller' => 'articles', 'action' => 'index'), $id);
		}
		//デフォルトcssの解除
		$this->autoLayout = false;

		$this->set('areaSelect', $this->Area->find('list', array('fields' => array('area_id', 'area'))));
		//送信後の処理
		if ($this->request->is('Post')) {
			$data = array('User' => array(
					'name'             => $this->request->data['User']['name'],
					'e-mail'           => $this->request->data['User']['e-mail'],
					'password'         => $this->request->data['User']['password'],
					'sex'              => $this->request->data['User']['sex'],
					'old'              => $this->request->data['User']['old'],
					'area'             => $this->request->data['User']['area'],
				));
			$fields = array('name', 'e-mail', 'password', 'sex', 'old', 'area');
			$id     = $this->User->save($data, true, $fields);
			if ($id == true) {
				$this->Session->setFlash('新規ユーザーを追加しました');
				$this->redirect('login');
				return;
			} else {
				//$this->Session->setFlash('登録できませんでした。やり直して下さい');
				//$this->redirect('register');
				$this->render('register');
				return;
			}
		}
	}

}
