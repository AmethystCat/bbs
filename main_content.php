<?php  
  session_start();

  // if($_GET["action"] == "mine"){
  //     echo "asdsadasdasdsadsa";
  // }
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
      mysql_query("SET NAMES UTF8");//必须设置查询编码，否则查出的中文会乱码，utf8!=utf-8
      if ($_GET["action"] == "mine") {
        //如果点击我的帖子选项则查询并加载相应的内容
        if ($_SESSION['uid']) {
          $uid = $_SESSION['uid'];
          $sql = "SELECT * FROM $bbs_user,$bbs_post WHERE $bbs_user.id = $bbs_post.poster_id AND $bbs_user.id = $uid ORDER BY p_time DESC";
          $result = mysql_query($sql,$my_conn);
        }else{
          echo "请您先登录再查看";
          echo "<meta http-equiv=\"refresh\" content=\"2;url=index.php\">\n";
          // echo "<script>window.location = localhost/bbs/index.php;</script>";
        }
        
      }else{
        $type_id = $_GET['type_id'];    
        // echo $type_id;  
        if ($type_id) {
          $sql = "SELECT * FROM $bbs_post WHERE type_id = $type_id ORDER BY p_time DESC";
          // echo $sql;
        }else{
          $sql = "SELECT * FROM $bbs_post ORDER BY p_time DESC";
        }
        
        $result = mysql_query($sql,$my_conn);
      }
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
                  $newest = false;
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