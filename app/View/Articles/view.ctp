
<style type="text/css">
.showy [type=checkbox] {
    display: none;
}
.showy [type=checkbox] + span {
    background-color: #f9f9f9;
    border: solid 1px #666;
    border-radius: 4px;
    cursor: pointer;
    display: inline-block;
    -ms-user-select: none;
    -moz-user-select: none;
    -o-user-select: none;
    -webkit-user-select: none;
    user-select: none;
    vertical-align: bottom;

    box-shadow:
         1px  1px 2px #fff inset,
        -1px -1px 2px #ccc inset;
    padding: 4px;
}
.showy [type=checkbox]:checked + span {
    box-shadow:
        -1px -1px 2px #fff inset,
         1px  1px 2px #999 inset;
    padding: 5px 3px 3px 5px;
}
.showy:active [type=checkbox] + span {
    box-shadow:
        -1px -1px 3px #fff inset,
         1px  1px 3px #666 inset;
    padding: 6px 2px 2px 6px;
}
</style>
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



<h2><?php echo $article['Article']['title'];?></h2>
<p><?php echo nl2br($article['Article']['content']);?></p>
<?php $id = $article['Article']['article_id'];?>
<p>
<form name="evaluation">
	<label class="showy"><input type="checkbox" onclick="iine()" name="good"><span>いいね！</span><?php echo $article['Article']['good_sum'];?></label>
	<label class="showy"><input type="checkbox" onclick="waruine()" name="bad"><span>わるいね！</span><?php echo $article['Article']['bad_sum'];?></label>
</form>
</p>
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
