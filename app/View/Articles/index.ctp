  <?php
	echo $this->Form->create('Article', array('action' => 'result', 'type' => 'post'));
	echo $this->Form->input('search_word', array('label' => '気になるこだわり情報を検索',
		'placeholder' => 'ここから検索'));
	echo $this->Form->end('検索');

?>
<h2>記事一覧</h2>
<ul>
<?php foreach ($articles as $article): ?>
  <li>
	<?php
			echo $this->Html->link($article['Article']['title'],'/articles/view/'.$article['Article']['article_id']),"<br>";
	?>
			<?php
			$tmp_content = $article['Article']['content'];
			$content = mb_substr($tmp_content, 0, 30, 'utf-8'); //全角文字で先頭から１８文字取得
    		if(mb_strlen($tmp_content, 'utf-8') > '30')//１８文字より多い場合は「...」を追加
        	$content .= '...';
			echo "<p>",$content, $this->Html->link("続きを読む",'/articles/view/'.$article['Article']['article_id']),"</p>";
			?>
	<?php echo "いいね！ ". $article['Article']['good_sum']; ?>
	<?php echo "　わるいね！ ". $article['Article']['bad_sum']; ?>
  </li>
<?php endforeach; ?>
</ul>
<div class="nav_list">
  <?php
    echo $this->Paginator->prev('前');
     echo $this->Paginator->numbers(
        array('separator' => ' ','modulus'=>5));
    echo $this->Paginator->next('次');
  ?>
</div>
<h4><?php
echo $this->Html->link('記事を投稿する','/articles/form/');
?></h4>
<h4><?php
echo $this->Html->link('戻る','/articles/index/');
?></h4>
