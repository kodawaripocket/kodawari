<?php 
class Article extends AppModel{
	public $validate = array(
    'title' => array(
        array('rule' => 'notEmpty', 'message' => 'タイトルを入力してください')
    ),
    'content' => array(
        array('rule' => 'notEmpty', 'message' => '記事内容を入力してください')
    )
);
}
