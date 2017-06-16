<?php  
  require_once 'nav/header.php';
  
?> 
<div class="container wrap">
<?php 
 if(empty($group)){echo "没有该题类型的数据，可以联系管理员上传题目";}
foreach ($group as $k => $v) {?>
     <h4 class="text-left smallTitle bb">题目：<?=$k?>(组题答卷)  <span class="scoreFace right score-right"></span></h4>
     <?php $i=1; foreach ($v as $k1 => $v1) {
     	$topic = explode('----', $k1);	
     	$ans = explode('++', $topic[1]);
     ?>
	     <div class="list-group test_section">
	       <a class="list-group-item active">
	         	<?=$i++.'、'.$topic[0]?>
	       </a>
	    <?php foreach ($v1 as  $v2) {   
	    	foreach ($v2 as $vv2) { 
	    ?>   
	       <div class="por">
		       <label for="q<?=$ans[0].$vv2['id'];?>" 
		       class="list-group-item checkQuestion qid_<?=$ans[0].'_'.$vv2['id'].' a'.$vv2['a_ans']?>" 
		       data-id="qid_<?=$ans[0]?>" 
		       data-answer="<?=$vv2['a_ans']?>">
		      		<?=html_entity_decode($vv2['a_option'])?>
		       </label>
		       <input type="radio" id="q<?=$ans[0].$vv2['id'];?>" class="checkbtn" name="qid_<?=$vv2['qid'];?>">
	       </div>
		<?php } } ?>	
	     </div>	
	<?php } ?>     	
	<form action="?c=home&f=reditScore" method="post" class="submitHide">
		<input type="hidden" name="score" value="" class="textHide">
		<input type="hidden" name="type" value="<?=$k?>">
		<button type="submit"  class="btn btn-info btnSubmit"  aria-expanded="true" name="btnSubmit">提交答案</button>	
	</form>
<?php } ?>	
</div>

<?php  
  require_once 'nav/footer.php';
?> 
