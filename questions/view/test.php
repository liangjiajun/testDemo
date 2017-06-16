<?php  
  require_once 'nav/header.php';

  
?> 
<div class="container wrap">
     <h4 class="text-left smallTitle bb">类型：<?=$_GET['tid']?>(随机抽取)  <span class="scoreFace right score-right"></span></h4>
     <?php 
       if(empty($type)){echo "没有该题类型的数据，可以联系管理员上传题目";}
     $i=1; foreach ($type as $k => $v) {  
     	$title = explode('----', $k);
     ?>
	     <div class="list-group test_section">
	       <a class="list-group-item active">
	         	<?=$i++.'、'.html_entity_decode($title[0]); ?>
	       </a>
	       <?php foreach ($v as $v1) {?>
	       <div class="por">
		       <label for="q<?=$title[1].$v1['id']?>" 
		       class="list-group-item checkQuestion qid_<?=$title[1].'_'.$v1['id'].' a'.$v1['a_ans']?>" 
		       data-id="qid_<?=$title[1]?>" 
		       data-answer="<?=$v1['a_ans']?>">
		       <?=html_entity_decode($v1['a_option'])?>
		       </label>
		       <input type="radio" id="q<?=$title[1].$v1['id']?>" class="checkbtn" name="q<?=$title[1]?>">
	       </div>
		       <?php } ?>

	     </div>		
     <?php }  ?>
	<form action="?c=home&f=reditScore" method="post" class="submitHide">
		<input type="hidden" name="score" value="" class="textHide">
		<input type="hidden" name="type" value="<?=$_GET['tid'];?>">
		<button type="submit"  class="btn btn-info btnSubmit"  aria-expanded="true" name="btnSubmit">提交答案</button>	
	</form>
</div>

<?php  
  require_once 'nav/footer.php';
?> 
