<?php  
	error_reporting(0);
	session_start();
	include "conn.php";
	// mysql_query("SET NAMES UTF8");

	if ($_SESSION['user']) {
		$poster_id = trim($_SESSION['uid']);
	}else{
		echo "请登录后再回复，亲";
		echo "<meta http-equiv=\"refresh\" content=\"2;url=index.php?posts=".$_POST['p_id']."\">\n";
		exit();
	}
	// $re_id = trim($_POST['posts']);
	$r_num = $_POST['r_num']+1;
	// echo $r_num;
	$content = trim($_POST['p_content']);
	$re_id = trim($_POST['p_id']);//p_id为主贴的id
	$sql1 = "UPDATE $bbs_post SET $bbs_post.r_num = $r_num, $bbs_post.r_time = '" .date("Y-m-d"). "' WHERE  $bbs_post.id = $re_id";
	// var_dump($_POST);
	// exit();
	$sql2 = "INSERT INTO $bbs_post(type_id,re_id,poster_id,title,content,r_num,p_time,r_time) VALUES ('0','$re_id','$poster_id','','$content','',CURDATE(),'')";
	mysql_query($sql1,$my_conn);
	mysql_query($sql2,$my_conn);

	$msg = ["msg"=>"回复成功，两秒后返回帖子页面"];
	echo json_encode($msg);
	// echo "<meta http-equiv=\"refresh\" content=\"2;url=index.php?posts=".$_POST['p_id']."\">\n";
?>