<h2>記事一覧</h2>
<ul>
	<?php foreach ($articles as $article) : ?>
		<li>
				<?php
					echo $this->Html->link($article['Article']['title'], '/articles/view/'.$article['Article']['article_id']);	
				?>
				<?php if($article['Article']['user_id']== $login_user_id= $this->Session->read("login_user_id")): ?>
				<?php echo $this->Html->link("編集",array('action'=>'edit',$article['Article']['article_id']));?>
			<?php endif; ?>
		</li>
	<?php endforeach; ?>
</ul>
<h4><?php
echo $this->Html->link('記事を投稿する','/articles/form/');
?></h4>