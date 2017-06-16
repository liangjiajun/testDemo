<?php  
  require_once 'nav/header.php';

$types = [];
$data = [];
$count=[];

foreach ($question as $k => $v) {
  if(!in_array($v['type'],$types)){
    $types[] = $v['type'];
    $data[$v['type']] = [];

  }
  $data[$v['type']][] = $v;
}

?> 
<div class="container wrap">
   <h4 class="text-left smallTitle bb">组卷答题  
    <?php if(!empty($_SESSION['qid'])){ ?>
      <a href="?c=home&f=clearCache" class=" label label-danger pull-right">有缓存数据存在，需要点击清空才不会影响新建试卷 <span class="text-right">(<?=count($_SESSION['qid'])?>)</span></a>  
    <?php } ?>
   </h4>
   <div class="row">
       <div class="col-sm-7 blog-main">
            <div class="panel-group" id="accordion">
          <?php foreach ($types as $k => $v) {  ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" 
                            href="#collapse<?=$v?>" class="db">
                            <?=$v?> <span class="glyphicon glyphicon-chevron-down"></span>
                            </a>
                        </h4>
                    </div>
                    <div id="collapse<?=$v?>" class="panel-collapse collapse">
                        <div class="panel-body">
                            <?php $t=1; foreach ($data[$v] as $k1 => $v1) {  ?>
                              <label>
                                  <div class="input-group">
                                       <span class="input-group-text"> <?=$t++.'、'.$v1['topic']?></span>
                                       <span class="input-group-addon">
                                         <input type="checkbox" class="checkSend" value="<?=$v1['id']?>">
                                       </span>
                                  </div>
                              </label>
                           <?php } ?>
                        </div>
                    </div>
                </div>
          <?php } ?>  

            </div>
    
       </div><!-- blog-main -->
       <div class="col-sm-4 col-sm-offset-1 ">
        	   <form method="post" action="?c=home&f=add_group">
                <div class="panel panel-default">
                  <div class="panel-heading">新试卷预览</div>
                    <div class="panel_in">
                        <span>标题</span>
                        <input type="text" name="newTitle" required class="input form-control">
                    </div>
                   <ul class="list-group checkData"></ul>
                    <p class="err"><?=isset($_SESSION['err'])?$_SESSION['err']:'';?></p>
            	   		<button type="submit"  class="btn btn-info newGroup"  aria-expanded="true">提交</button>
                </div>
        	   </form>
       </div>
    </div>
</div>

<?php  
  require_once 'nav/footer.php';
?> 