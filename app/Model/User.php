<?php


App::uses('Model', 'Model');


class User extends AppModel {
	public $useTable = 'users';
	public $name = 'User';
	//public $primaryKey　= 'user_id';
	//使用するテーブルの設定
	//ない場合、クラス名からテーブル名指定、例：User->usersテーブル
	//public $useTable = false;
	public $validate = array(
			'name' => array(
							'rule' => array( 'custom', '/[a-zA-Z0-9_\-]+/' ),
							'allowEmpty' => false,
							'required' => true,
							'message' => '半角英数か_-以外の文字は使えません',
							'last' => false
				),
			'e-mail' => array(
					'validate1' => array(
							'rule' => 'email',
							'required' => true,
							'allowEmpty' => false,
							'message' => 'メールアドレスの形式で必ず入力してください。',
							'last' => false
						)
				),
			'password' => array(
					'rule' => array('minLength',5),
					'allowEmpty' => false,
					'required' => true,
					'message' => '5文字以上で必ず入力してください。',
					'last' => false
				)
		);

	//コントロールでsave関数実行前によばれる
	public function beforeSave($options = array()){
		$this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
		return true;
	}


}
