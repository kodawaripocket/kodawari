<h2>記事作成</h2>
<script>
   function setTextarea() {
       var target = document.getElementById('ArticleContent');
        target.contentDocument.contentEditable = "on";
   }
</script>
<?php
	echo $this->Form->create('Article',array('action' => 'check'));
	echo $this->Form->text('title', array('placeholder' => 'タイトルを入力してください'));
	echo $this->Form->input( 'category_id', array(
        'label' => 'カテゴリ',
        'type' => 'select',
        'options' => $category_id,
    ));
    echo $this->Form->input( 'sub_category_id', array(
        'label' => 'サブカテゴリ',
        'type' => 'select',
        'options' => $sub_category_id,
    ));
    echo $this->Form->input( 'genre_id', array(
        'label' => 'ジャンル',
        'type' => 'select',
        'options' => $genre_id,
    ));
    echo $this->Form->hidden('user_id',array('value'=>$this->Session->read('login_user_id')));
	echo $this->Form->textarea('content', array('cols' => '60', 'rows' => '3',
        'placeholder' => 'こだわり内容を入力してください'));
	echo $this->Form->end('投稿');
 ?>
 
