<?php  
  require_once 'nav/header.php';
?> 
<div class="container wrap">
    <h1 class="text-center smallTitle">欢迎来到在线答题系统</h1>
    <div class="row placeholders icon">

    <?php foreach ($data as $k => $v) { ?>
        <div class="col-xs-2 col-sm-2 col-md-2">
          <a href="?c=home&f=test&tid=<?=$v['type']?>">
            <div class="topic_icon" style="background-image: url(uploads/type_icon/<?=$v['type_icon']?>);"> <h4><?=$v['type']?></h4> </div>
          </a>
        </div>
    <?php } ?>
      
        <div class="col-xs-2 col-sm-2 placeholder">
          <a href="#">
            <div class="topic_icon add_icon" data-toggle="modal" data-target="#myModal">+</div>
          </a>
        </div>
    </div>
</div>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <form method="post" enctype="multipart/form-data" action="?c=home&f=type">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          &times;
        </button>
        <h4 class="modal-title" id="myModalLabel">添加类型</h4>
      </div>
      <div class="modal-body">
        <input type="file" name="file" required class="input form-control">
        <input type="text" name="typeName" class="input form-control" placeholder="请输入题目类型">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭 </button> 
        <button type="submit" class="btn btn-primary">
          提交更改
        </button>
      </div>
      </form>
    </div>
  </div><!-- /.modal -->
</div>
<?php  
   require_once 'nav/footer.php';
?> 
