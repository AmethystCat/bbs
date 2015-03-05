<?php  
	error_reporting(0);	
?>
<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
	<h2 class="catagory br5">帖子分类</h2>
      <div class="list-group">
        <!-- <a href="index.php?type_id=0" class="list-group-item">全部</a>
        <a href="index.php?type_id=1" class="list-group-item active">生活</a>
        <a href="index.php?type_id=2" class="list-group-item">娱乐</a>
        <a href="index.php?type_id=3" class="list-group-item">其他</a> -->


        <a href="index.php?type_id=0" id="0" class="list-group-item <?php if ($_GET['type_id']==0){echo "active";}?>">全部</a>
        <a href="index.php?type_id=1" id="1" class="list-group-item <?php if ($_GET['type_id']==1){echo "active";}?>">生活</a>
        <a href="index.php?type_id=2" id="2" class="list-group-item <?php if ($_GET['type_id']==2){echo "active";}?>">娱乐</a>
        <a href="index.php?type_id=3" id="3" class="list-group-item <?php if ($_GET['type_id']==3){echo "active";}?>">其他</a>
     </div>
</div>