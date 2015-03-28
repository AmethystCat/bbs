<?php  
	/*注册*/
	session_start();
	error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>注册</title>
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/signin.css" rel="stylesheet">
	<script src="lib/jquery-1.11.1.min.js"></script>
	<script src="lib/bootstrap.min.js"></script>
	<script src="js/common-lr.js"></script>
</head>
<body>
	<div class="container">
      <form class="form-signin" id="regist_form" role="form" action="login_or_regist.php" method="post">
        <h2 class="form-signin-heading">请填写相关信息</h2>
        <input type="text" class="form-control" name="username" placeholder="用户名" required autofocus>
        <input type="email" class="form-control" name="email" placeholder="邮箱地址" required>
        <input type="password" class="form-control" name="password" placeholder="密码" required>
        <label for="photo">设置头像</label>
		<select id="photo" name="photo" class="form-control" onchange="Util.c_img();">
			  <?php  
			  	echo "<option value=\"0\">默认头像</option>";
			  	for ($i=1; $i < 14; $i++) { 
			  		echo "<option value=\"".$i."\">图像".$i."</option>";
			  	}
			  ?>
		</select>
		<img class="photo" src="img/0.jpg" id="img1">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Regist</button>
      </form>
      <span class="center-block error-mess"><?php echo $error_mess ?></span>
    </div> <!-- /container -->
	<!--弹出窗加载-->
    <?php include "dialog.php" ?>
</body>
</html>