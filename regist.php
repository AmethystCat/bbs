<?php  
	/*注册*/
	session_start();
	error_reporting(0);

	if (!$_POST) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>注册</title>
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/signin.css" rel="stylesheet">
	<script src="js/common.js"></script>
</head>
<body>
	<div class="container">
      <form class="form-signin" role="form" action="regist.php" method="post">
        <h2 class="form-signin-heading">请填写相关信息</h2>
        <input type="text" class="form-control" name="username" placeholder="用户名" required autofocus>
        <input type="email" class="form-control" name="email" placeholder="邮箱地址" required>
        <input type="password" class="form-control" name="password" placeholder="密码" required>
        <label for="photo">设置头像</label>
	<select id="photo" name="photo" class="form-control" onchange="c_img();">
		  <?php  
		  	echo "<option value=\"\">不使用图像</option>";
		  	for ($i=0; $i < 13; $i++) { 
		  		echo "<option value=\"".$i."\">图像".$i."</option>";
		  	}
		  ?>
	</select>
	<img class="photo" src="img/1.gif" id="img1">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Regist</button>
      </form>
      <span class="center-block error-mess"><?php echo $error_mess ?></span>
    </div> <!-- /container -->
</body>
</html>
<?php  
	}else{
		include "conn.php";

		//过滤掉变量两端的空格
		$user = trim($_POST['username']);
		$pass = trim($_POST['password']);
		$email = trim($_POST['email']);
		$photo = trim($_POST['photo']);
		$date = trim(date("Y-m-d"));

		$sql = "SELECT id FROM $bbs_user WHERE name='$user' OR email='$email'"; //查询数据库中是否存在该用户
		$result = mysql_query($sql,$my_conn);
		if (mysql_num_rows($result)>0) {
			# code...
			echo "该邮箱已被使用或者用户名已被注册，请重新注册\n";
			echo "<meta http-equiv=\"refresh\" content=\"2; url=regist.php\">\n";
			echo "两秒后返回注册页面";
			exit();		
		}else{
			$sql2 = "INSERT INTO $bbs_user(name,pass,nickname,email,photo,reg_date,power) VALUES ('$user','$pass','','$email','$photo','$date',0)";
			mysql_query("SET NAMES UTF8");
			$result2 = mysql_query($sql2,$my_conn); 
			$tem = mysql_fetch_array($result2);
			if ($result2) {
				# code...
				$_SESSION['user'] = $user;
				$_SESSION['uid'] = $tem;
				echo "注册用户成功，两秒后返回首页，若页面未跳转请点击<a href=\"index.php\">这里</a>返回\n";
				echo "<meta http-equiv=\"refresh\" content=\"2; url=index.php\">\n";

			}else{
				echo "注册新用户时出现错误，请重新注册\n";
				echo "<meta http-equiv=\"refresh\" content=\"1; url=regist.php\">\n";
			}
		}
	}
?>