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
    <?php include "header.php"; ?>
    <div class="container mt60">
      <div class="row row-offcanvas row-offcanvas-right">
        <?php 
          if ($_GET['action'] === "posting") {
            # 如果为发帖操作，则加载发帖模块
        ?>
        <div class="col-xs-12 col-sm-8 col-sm-offset-2">
          <div class="row">
            <div class="col-xs-6 col-lg-12 mt10">
              <div class="section-summary mb170">
                <form role="form" action="">
                  <div class="form-group">
                    <label for="p_title">标题:</label>
                    <input type="text" class="form-control" id="p_titie" placeholder="请输入帖子标题" required>
                  </div>
                  <div class="form-group">
                    <label for="p_content">内容:</label>
                    <textarea class="form-control" id="p_content" placeholder="请输入帖子内容" rows="10" required></textarea>
                  </div>
                  <div class="form-group">
                    <label for="p_category">类别:</label>
                    <select id="p_category" class="form-control">
                      <option value="1">生活</option>
                      <option value="2">娱乐</option>
                      <option value="3">其他</option>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-default">Submit</button>
                </form>
              </div>
            </div><!--/.col-xs-6.col-lg-4-->
          </div><!--/row-->
        </div>
        <?php  
          }else if ($_GET['posts']) {
            # code...
            include "posts_view.php";
          }else{
            include "main_content.php";  
            include "right.php";        
            // include "posts_view.php";   
          }
        ?>
      </div><!--/row-->
    <?php include "footer.php"; ?>
    </div><!--/.container-->
    <script src="js/jquery-1.11.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>