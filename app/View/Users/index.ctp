<?php
echo 'ログイン成功した？';
echo $this->Session->flash('Auth');
echo '<a href="Users/logout">ログアウト</a>'
?>
