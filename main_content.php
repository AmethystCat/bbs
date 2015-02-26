<?php  
  session_start();
?>

<div class="col-xs-12 col-sm-9">
    <p class="pull-right visible-xs">
      <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
    </p>
    <div class="jumbotron mt10">
      <h1>Hello, anyone</h1>
      <p> 公告：欢迎大家光临我的个人BBS，在这里你可以做任何想做的事，说任何想说的话，但是得秉承我大中华的道德风尚，论坛新开，希望大家多多捧场</p>
    </div>
    <div class="row">
    </div>
    <?php  
      /*首页载入时，默认查询生活类的帖子类表*/
      include "conn.php";
      $type_id = 1;
      $sql = "SELECT * FROM $bbs_post WHERE type_id='1' ORDER BY p_time DESC";
      mysql_query("SET NAMES UTF8");//必须设置查询编码，否则查出的中文会乱码，utf8!=utf-8
      $result = mysql_query($sql,$my_conn);
      $newest = true;// 最新文章标识
      while ($row=mysql_fetch_array($result)) {
        # code...
    ?>
      <div class="row">
        <div class="col-xs-6 col-lg-12 mt10">
          <div class="section-summary">
            <h2>
              <a href="index.php?posts=<?php echo $row['id'] ?>"> <?php echo $row['title'] ?> </a>
              <small>
              <?php 
                if ($newest) {
                  # code...
                  echo "(最新)";
                }
              ?>
             </small>
             <span class="pull-right h_time"><?php echo $row['p_time'] ?></span>
            </h2>
            <p><?php echo $row[content] ?></p>
            <p><a class="btn btn-default" href="index.php?posts=<?php echo $row['id'] ?>" role="button">更多 &raquo;</a></p>
          </div><!--row-->
        </div><!--col-xs-6 col-lg-12 mt10-->
    </div>
    <?php } ?>
</div>