<?php  
	error_reporting(0);
	echo "string";

	include "conn.php";
	mysql_query("SET NAMES UTF8");

	$did = $_GET['del'];
	echo $did;
	$sql = "DELETE FROM $bbs_post WHERE $bbs_post.id = $did OR $did = $bbs_post.re_id";

	$result = mysql_query($sql,$my_conn);
	var_dump($result);
	echo "删除成功";
?>