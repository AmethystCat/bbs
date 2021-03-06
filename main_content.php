<?php  
  session_start();
?>

<div class="col-xs-12 col-sm-9">
    <!--加载公告部分-->
    <?php include "main_content_announcement.php" ?>
    <!--end-->
    <div class="row">
    </div>
    <?php  
      include "conn.php";
      mysql_query("SET NAMES UTF8");//必须设置查询编码，否则查出的中文会乱码，utf8!=utf-8
      if ($_GET["action"] == "mine") {//如果点击我的帖子选项则查询并加载相应的内容
        
        if ($_SESSION['uid']) {//判断用户已经登录
          $uid = $_SESSION['uid'];
          $sql = "SELECT * FROM $bbs_user,$bbs_post WHERE $bbs_user.id = $bbs_post.poster_id AND $bbs_user.id = $uid AND type_id != 0 ORDER BY p_time DESC";
          $result = mysql_query($sql,$my_conn);
        }else{
          echo "请您先登录再查看";
          echo "<meta http-equiv=\"refresh\" content=\"2;url=index.php\">\n";
        }
      }else{
        $type_id = $_GET['type_id'];    
        if ($type_id) {//若用户点击右边文章的分类，则根据不同的type_id来生成sql语句
            $sql = "SELECT * FROM $bbs_post WHERE type_id = $type_id ORDER BY id DESC";
        }else{//默认为加载全部帖子，不包含评论回复（即数据库的中type_id!=0的帖子）
            $sql = "SELECT * FROM $bbs_post WHERE type_id != 0 ORDER BY id DESC";
        }    
        $result = mysql_query($sql,$my_conn);//将查询结果集保存在$result中
      }
      $newest = true;// 最新文章标识，因为是按倒序来进行查询，所以第一条结果即为最新
      while ($row=mysql_fetch_array($result)) {
    ?>
      <div class="row">
        <div class="col-xs-12 col-lg-12 mt10">
          <div class="section-summary">
            <h2>
              <a href="index.php?posts=<?php echo $row['id'] ?>"> <?php echo $row['title'] ?> </a>
              <small>
              <?php 
                if ($newest) {
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