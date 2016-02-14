<h2>記事一覧</h2>
<table cellpadding="0" cellspacing="0">
  <tr>
      <th><?php echo $this->Paginator->sort('article_id');?></th>
  </tr>
  <?php foreach ($articles as $article): ?>
  <tr>
    <td><?php echo $this->Html->link($article['Article']['title'],'/articles/view/ '.$article['Article']['article_id']); ?>&nbsp;</td>

  </tr>
  <?php endforeach; ?>
</table>
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