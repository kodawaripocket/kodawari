<?php
	echo $this->Session->flash('Auth');
	echo $this->Form->Create('User',array('url' => 'login'));
	echo $this->Form->input('User.e-mail',array('label' => 'メールアドレス'));
	echo $this->Form->input('User.password', array('label' => 'パスワード'));
	echo $this->Form->end('入力');
	echo '<a href="register">登録</a>'
?>
