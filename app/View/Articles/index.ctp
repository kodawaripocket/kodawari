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
			echo $this->Html->link($article['Article']['title'],'/articles/view/'.$article['Article']['article_id']);
	?>
	<ul>
		<li>
			<?php
			$tmp_content = $article['Article']['content'];
			$content = mb_substr($tmp_content, 0, 30, 'utf-8'); //全角文字で先頭から１８文字取得
    		if(mb_strlen($tmp_content, 'utf-8') > '30')//１８文字より多い場合は「...」を追加
        	$content .= '・・・・';
			echo $content;
			?>
		</li>
	</ul>
	<?php echo "いいね！数". $article['Article']['good_sum']; ?>
	<?php echo "　わるいね！数". $article['Article']['bad_sum']; ?>
  </li>
<?php endforeach; ?>
</ul>
<div>
  <?php
    echo $this->Paginator->first('<< ');
    echo $this->Paginator->prev('< ');
     echo $this->Paginator->numbers(
        array('separator' => ' ','modulus'=>5));
    echo $this->Paginator->next(' >');
    echo $this->Paginator->last(' >>');
  ?>
</div>
<h4><?php
echo $this->Html->link('記事を投稿する','/articles/form/');
?></h4>
<h4><?php
echo $this->Html->link('戻る','/articles/index/');
?></h4>
