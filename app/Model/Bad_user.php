<?php


App::uses('Model', 'Model');


class Bad_user extends AppModel {
	public $useTable = 'bad_users';
	//これをかかないとプライマリーキーが"id"とみなされる。なぜかdeleteAllやupdateAllが指定カラムで実行できない
	public $primaryKey = 'bad_user_id';
	public $name = 'bad_user';


}
