<?php
	echo $this->Session->flash('Auth');
	echo $this->Form->Create('User',array('url' => 'register'));
	echo $this->Form->input('User.name',array('label'=>'ユーザ名'));
	echo $this->Form->input('User.e-mail',array('label' => 'メールアドレス'));
	echo $this->Form->input('User.password', array('label' => 'パスワード'));
	echo $this->Form->end('登録');
	echo '<a href="Users/login">ログイン</a>'
?>
