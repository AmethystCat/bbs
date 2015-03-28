<?php  
	session_start();

	error_reporting(0);
	require "conn.php";
	// $DB = new DBA;
	//var_dump($DB);
	// include "conn.php";
	/*判断是登录还是注册*/
	if ($_GET['action'] == 'login') {
		//登录验证
		echo login_validate($DB);		
	}else if ($_GET['action'] == 'regist') {
		//注册验证
		echo regist_validate();
	}




	function login_validate()
	{
		include "conn.php";
		if ($_SESSION['user']) {
			return "请勿重新登录";
		}else{
			//获取参数后要删除首尾两端的空格
			$user = trim($_POST['username']);
			$pass = trim($_POST['password']);
			// $user = "xx";
			// $pass = "123";
			$sql = "SELECT * FROM bbs_user WHERE name = '" .$user. "' AND pass = '" .$pass. "'";
			// echo $sql;
			// $sql1="select * from bbs_user";
			// mysql_query("SET NAMES UTF8");//设置查询编码，否则中文登录时会报错
			$result =mysql_query($sql);
			// var_dump($result);
			$tem = mysql_fetch_array($result);
			// var_dump($tem);
			if (mysql_num_rows($result)>0) {
					# code...
				$_SESSION['user'] = $user;  //数据库中存在数据，则设置session
				$_SESSION['uid'] = $tem[0]; //增加id号
				$msgs = [
					"msg"=>"录成登功，两秒后跳回主页面"
				];
				return json_encode($msgs);
				// echo "<meta http-equiv=\"refresh\" content=\"2;url=index.php\">\n";
			}else{
				return "用户名或密码错误，请重新登录";
			}	
		}
	}

	

	function regist_validate()
	{
		include "conn.php";
		//过滤掉变量两端的空格
		$user = trim($_POST['username']);
		$pass = trim($_POST['password']);
		$email = trim($_POST['email']);
		$photo = trim($_POST['photo']);
		$date = trim(date("Y-m-d"));

		$sql = "SELECT id FROM $bbs_user WHERE $bbs_user.name='$user' OR $bbs_user.email='$email'"; //查询数据库中是否存在该用户
		$result = mysql_query($sql);
		if (mysql_num_rows($result)>0) {
			# code...
			return "该邮箱已被使用或者用户名已被注册，请重新注册\n";
			// echo "<meta http-equiv=\"refresh\" content=\"2; url=regist.php\">\n";
			// echo "两秒后返回注册页面";
			// exit();		
		}else{
			$sql2 = "INSERT INTO $bbs_user(name,pass,nickname,email,photo,reg_date,power) VALUES ('$user','$pass','','$email','$photo','$date',0)";
			mysql_query($sql2,$my_conn); 
			//[HC 2015-3-1] sql语句中条件里的字符串变量要加上引号
			$sql3 = "SELECT * FROM $bbs_user WHERE $bbs_user.name = '$user' AND $bbs_user.email = '$email'";
			$result2 = mysql_query($sql3);
			$tem = mysql_fetch_array($result2);
			// var_dump($tem);
			if ($result2) {
				# code...
				$_SESSION['user'] = $user;
				$_SESSION['uid'] = $tem[0];
				// echo $_SESSION['uid'];
				$msg = ["msg"=>"注册用户成功，两秒后返回首页，若页面未跳转请点击<a href=\"index.php\">这里</a>返回\n"];
				return json_encode($msg);
				// echo "<meta http-equiv=\"refresh\" content=\"2; url=index.php\">\n";

			}else{
				return "注册新用户时出现错误，请重新注册\n";
				// echo "<meta http-equiv=\"refresh\" content=\"1; url=regist.php\">\n";
			}
		}
	}

?>