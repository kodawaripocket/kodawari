<?php


App::uses('Model', 'Model');


class Good_user extends AppModel {
	public $useTable = 'good_users';
	//これをかかないとプライマリーキーが"id"とみなされる。なぜかdeleteAllやupdateAllが指定カラムで実行できない
	public $primaryKey = 'good_user_id';
	public $name = 'good_user';


}
