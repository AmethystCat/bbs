<?php  
	session_start();

	error_reporting(0);
	include "conn.php";
	if ($_SESSION['user']) {
		# code...
		echo "请勿重新登录";
	}else{
		//获取参数后要删除首尾两端的空格
		$user = trim($_POST['username']);
		$pass = trim($_POST['password']);
		// $user = "xx";
		// $pass = "123";
		$sql = "SELECT id FROM $bbs_user WHERE name='$user' AND pass='$pass'";
		mysql_query("SET NAMES UTF8");//设置查询编码，否则中文登录时会报错
		$result = mysql_query($sql,$my_conn);
		$tem = mysql_fetch_array($result);
		if (mysql_num_rows($result)>0) {
				# code...
			$_SESSION['user']=$user;  //数据库中存在数据，则设置session
			$_SESSION['uid'] = $tem[0]; //增加id号
			echo "录成登功，两秒后跳回主页面\n";
			echo "<meta http-equiv=\"refresh\" content=\"2;url=index.php\">\n";
		}else{
			echo "登录失败，请重新登录";
		}	
	}
?>