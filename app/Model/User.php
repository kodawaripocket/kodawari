<?php


App::uses('Model', 'Model');


class User extends AppModel {
	public $useTable = 'users';
	//public $primaryKey　= 'user_id';
	//使用するテーブルの設定
	//ない場合、クラス名からテーブル名指定、例：User->usersテーブル
	//public $useTable = false;

	//コントロールでsave関数実行前によばれる
	public function beforeSave($options = array()){
		$this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
		return true;
	}


}
