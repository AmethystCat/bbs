<?php  
	/*登录*/
	session_start();//开启session
	error_reporting(0); //关闭php默认的警告信息提示
	if ($_SESSION['user']) {  //如果用户已登录，并且成功在session中写入信息，则提示用户
		echo "您已经登录，不能重复登录啦";
		echo "<meta http-equiv=\"refresh\" content=\"2; url=index.php\">\n";
		echo "两秒后返回主页面";
	}else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>登录</title>
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/signin.css" rel="stylesheet">
	<script type="text/javascript" src="lib/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="lib/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/common-lr.js"></script>
</head>
<body>
	<div class="container">
      <form class="form-signin" id="login_form" role="form" action="login_or_regist.php" method="post">
        <h3 class="form-signin-heading">请输入相关信息信息登录</h3>
        <input type="text" class="form-control" name="username" placeholder="用户名" required autofocus>
        <input type="password" class="form-control" name="password" placeholder="密码" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>
    </div> <!-- /container -->
    <?php include "dialog.php" ?>
</body>
</html>
<?php } ?>