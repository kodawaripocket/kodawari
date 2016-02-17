<h2>記事一覧</h2>
<ul>
  <?php
    echo "検索結果を表示します";
    var_dump($articles);
	foreach ($articles as $article): ?>
  <li>
	<?php
			echo $this->Html->link($article['Article']['title'],'/articles/view/'.$article['Article']['article_id']);
	?>
  </li>
<?php endforeach; ?>
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
