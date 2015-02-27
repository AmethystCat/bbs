<?php  
  session_start();
  //test
  // $_SESSION['user']="aa";
  error_reporting(0);
  if ($_GET['status'] && $_GET['status'] == "loginout") {
    # code...
    unset($_SESSION['user']);
    unset($_SESSION['uid']);
  }
?>
<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>我的bbs</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/common.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <!--加载header-->
    <?php include "header.php"; ?>
    <!--header end-->
    <div class="container mt60">
      <div class="row row-offcanvas row-offcanvas-right">
        <?php 
          if ($_GET['action'] == "posting") {
          // 如果为发帖操作，则加载发帖模块
            include "post.php";

          }else if ($_GET['posts']) {
            // 如果为查看帖子详细信息，则加载posts_view.php
            include "posts_view.php";

          }else{
            //如果登录用户为超级管理员，则主内容模块要另外加载
            if ($_SESSION['user'] == 'admin') {
              include "main_content_admin.php";
            }else{
              include "main_content.php";  
            }
            include "right.php";         
          }
        ?>
      </div><!--/row-->
    <?php include "footer.php"; ?>
    </div><!--/.container-->
    <input type="hidden" id="userflag" value="<?php echo $_SESSION['uid'] ?>">
    <script src="js/jquery-1.11.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/common.js"></script>
  </body>
</html>