<?php  
  require_once 'nav/header.php';
?> 
<div class="container wrap">
   <h4 class="text-left smallTitle bb">选卷答题</h4>
   <div class="row placeholders icon">

<?php foreach ($paper as $k => $v) {
  $k1 = explode('----', $k);
?>
       <div class="col-xs-3 col-sm-3 placeholder">
         <a href="?c=home&f=groupTest&pid=<?=$k1[1]?>">
           <div class="paper-text boxShadow">
           <h4><?=$k1[0]?></h4>
        <?php foreach ($v as $v1) { ?>
           <ul>
               <li><?=$v1?></li>
           </ul>
        <?php } ?>   
           </div>
         </a>
       </div>
<?php  } ?>
    
		
        <div class="col-xs-3 col-sm-3 placeholder">
          <a href="?f=group">
            <div class="paper-text add_icon">+</div>
          </a>
        </div>
    </div>
</div>
<?php  
  require_once 'nav/footer.php';
?>
