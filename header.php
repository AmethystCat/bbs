<?php  
  /*头部*/
  error_reporting(0);//去掉php的警告提示信息
?>
  <!--导航dom结构-->
  <nav class="navbar navbar-fixed-top navbar-inverse" role="navigation">
    <div class="container">
    <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Hi,BBS</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php?action=home">最新</a></li>
            <li><a href="index.php?action=posting">发帖</a></li>
            <li><a href="index.php?action=mine">我的帖子</a></li>
          </ul>
        <?php  
            if ($_SESSION['user']) {//如果用户已登录，则隐藏注册按钮，显示欢迎信息
            # code...
            echo "<p class=\"navbar-text navbar-right\">欢迎您， <a href=\"#\" class=\"navbar-link\">".$_SESSION['user']."</a>&nbsp;&nbsp;<a href=\"index.php?status=loginout\" class=\"navbar-link\">退出</a></p>";
            echo "<input type=\"hidden\" value=\"".$_SESSION['uid']."\">";
          }else{  //否则显示登录和注册按钮
            echo "<a href='regist.php' class=\"btn btn-success navbar-btn pull-right\" id=\"nav_regist\">注册</a>"
                ."<a href='login.php' class=\"btn btn-success navbar-btn pull-right mr10\" id=\"nav_login\">登录</a>";
          }
        ?>
        </div>
      </div>
    </nav>