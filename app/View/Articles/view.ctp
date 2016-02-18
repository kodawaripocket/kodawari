<script type="text/javascript">
    //過去にこの記事のいいねを押したユーザーの処理用ごり押し
    function　good_user(){
        document.evaluation.bad.disabled = "true";
        document.evaluation.good.disabled = "";
        document.evaluation.good.checked = true;
    }
    //過去にこの記事のわるいねを押したユーザーの処理
    function　bad_user(){
        document.evaluation.good.disabled = "true";
        document.evaluation.bad.disabled = "";
        document.evaluation.bad.checked = true;
    }
    function none_user(){
        document.evaluation.bad.disabled = "";
        document.evaluation.good.disabled = "";
    }

    function iine(){
		if(!document.evaluation.bad.disabled){
			//trueで無効化 ""で有効化
			document.evaluation.bad.disabled = "true";
            window.location.href= "<?php echo $this->Html->url(array(
                                    "controller" => "articles",
                                    "action" => "update",
                                    $article['Article']['article_id'],1,1
                                ))?>";
		} else {
			document.evaluation.bad.disabled = "";
            window.location.href= "<?php echo $this->Html->url(array(
                                    "controller" => "articles",
                                    "action" => "update",
                                    $article['Article']['article_id'],1,0
                                ))?>";
		}

	}
	function waruine(){
		if(!document.evaluation.good.disabled){
			document.evaluation.good.disabled = "true";
            window.location.href= "<?php echo $this->Html->url(array(
                                    "controller" => "articles",
                                    "action" => "update",
                                    $article['Article']['article_id'],0,1
                                ))?>";
		} else {
			document.evaluation.good.disabled = "";
            window.location.href= "<?php echo $this->Html->url(array(
                                    "controller" => "articles",
                                    "action" => "update",
                                    $article['Article']['article_id'],0,0
                                ))?>";
		}
	}

</script>

<div class="article_header">
<h4><?php echo $article['Article']['title'];?></h4>
<div id="article_data">
<p><?php echo "カテゴリ:". $category[$article['Article']['category_id']];?></p>
<p><?php echo "サブカテゴリ:". $sub_category[$article['Article']['sub_category_id']];?></p>
<p><?php echo "ジャンル:". $genre[$article['Article']['genre_id']];?></p>
<p><?php echo "作成日:".$article['Article']['created'];?></p>
<p><?php echo "更新日:".$article['Article']['modified'];?></p>
</div>
</div>
<div id="article_content">
<p><?php echo nl2br($article['Article']['content']);?>
<form name="evaluation">
	<label class="showy"  id="good">
		<input type="checkbox" onclick="iine()" name="good">
		<div>
			<?php echo $this->Html->image("icon-fblike.png"); ?>
			<span><?php echo $article['Article']['good_sum'];?></span>
		</div>
		<span class="word">そうだね！</span>
	</label>
	<label class="showy"  id="bad">
        <input type="checkbox" onclick="waruine()" name="bad">
        <div>
            <?php echo $this->Html->image("icon-fbdislike.png"); ?>
            <span><?php echo $article['Article']['bad_sum'];?></span>
        </div><span class="word"> う〜ん……</span>
    </label>
</form>
</p>
</div>
<?php $id = $article['Article']['article_id'];?>
<?php
echo $this->Html->link('戻る','/articles/index/');
?>
<?php
    if(count($good)>0){
        print "<script language=javascript>good_user()</script>";
    } else if(count($bad)>0){
        print "<script language=javascript>bad_user()</script>";
    } else {
        print "<script language=javascript>none_user()</script>";
    }
?>
