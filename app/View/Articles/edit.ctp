<h1>編集用画面</h1>
<?php 
	echo $this->Form->create('Article',array('action'=>'edit'));
	echo $this->Form->text('title');
	echo $this->Form->hidden('article_id',array('value'=> $article_id));
	echo $this->Form->input( 'category_id', array( 
    'type' => 'select', 
    'options' => $category_id,
    ));
    echo $this->Form->input( 'sub_category_id', array( 
    'type' => 'select', 
    'options' => $sub_category_id,
    ));
    echo $this->Form->input( 'genre_id', array(
    'type' => 'select', 
    'options' => $genre_id,
    ));
    echo $this->Form->hidden('user_id',array('value'=>$this->Session->read('login_user_id')));
	echo $this->Form->textarea('content');
	echo $this->Form->end('投稿');
?>