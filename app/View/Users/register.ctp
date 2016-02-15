<?php
	echo $this->Session->flash('Auth');
	echo $this->Form->Create('User',array('url' => 'register'));
	

	echo "<p>ユーザ名</p>";
	echo $this->Form->input('User.name',array('label'=>false,'required'=>false));


	$sexOptions=array('0'=>'男','1'=>'女');
	echo "<p>性別</p>";
	echo $this->Form->input('User.sex' ,array(
		'type'=>'radio',
		'options' => $sexOptions,
		'value'=>'0',
        'legend' => false
		));


	echo "<p>現在地</p>";
	echo $this->Form->input('User.area', array( 
	'type' => 'select', 
	'options' => $areaSelect,
	'label'=>false
	));


	$ageOptions=array('0'=>'10代','1'=>'20代','2'=>'30代','3'=>'40代','4'=>'50代','5'=>'60代','6'=>'70代','7'=>'80代以上');
	echo "<p>年齢</p>";
	echo $this->Form->input('User.old', array( 
	'type' => 'select', 
	'options' => $ageOptions,
	'label'=>false
	));


	echo "<p>メールアドレス</p>";
	echo $this->Form->input('User.e-mail',array('label' => false,'required' => false));


	echo "<p>パスワード</p>";
	echo $this->Form->input('User.password', array('label' => false,'required' => false));


	echo $this->Form->end('登録');
	echo '<a href="login">ログイン</a>';
?>
