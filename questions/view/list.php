<?php  
  require_once 'nav/header.php';
?> 
<div class="container wrap">
   <h4 class="text-left smallTitle bb">成绩列表</h4>
<?php 
  if(empty($list)){echo "没有成绩数据，可以进行答题后显示";}
foreach ($list as $k => $v) { 
  $title = explode('----', $k);

?>

   <div class="panel-group" id="accordion">
      <div class="panel panel-default">
          <div class="panel-heading">
              <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" 
                  href="#collapse<?=$title[1]?>" class="db">
                  <?=$title[0]?>
                  <span class="glyphicon glyphicon-chevron-down"></span>
                  </a>
              </h4>
          </div>
          <div id="collapse<?=$title[1]?>" class="panel-collapse collapse in">
              <div class="panel-body">
                  <div class="row">
                  <?php foreach ($v as $k => $u) {
                      $user = explode('----', $k);
                  ?>
                    <div class="col-xs-4 col-sm-4 list-tip">
                       <div class="tableStyle">
                          <table class="table ">
                             <h4>姓名：<?=$user[0]?> <span style="background-image: url(sourcus/images/logo.png);"></span></h4>
                               <thead>
                                 <tr>
                                   <th>类型</th>
                                   <th>分数</th>
                                   <th>时间</th>
                                 </tr>
                               </thead>
                           <?php foreach ($u as $s){ ?>
                               <tbody>
                                 <tr>
                                   <td><?=$s['type']?></td>
                                   <td><?=$s['total']?>分</td>
                                   <td><?=date('Y-m-d H:i:s',$s['submit_time'])?></td>
                                 </tr>
                               </tbody>
                           <?php  }  ?>  
                          </table>
                       </div>
                    </div>
                  <?php } ?>  
                </div>
              </div>
          </div>
      </div>
   </div>
   
<?php } ?>
  
</div>

<?php  
  require_once 'nav/footer.php';
?> 