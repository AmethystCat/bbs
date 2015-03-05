<?php
  // 【2014-12-29】数据库连接脚本  
	/**
	* 
	*/
	/*class DBA 
	{
		public $host = "localhost";
		public $user = "user";
		public $pass = "123456";
		public $dbname = "bbs";  //论坛数据库
		public $p_num = "10"; //，每页显示的条数（可以不要引号吗）
		

		function __construct($host = "localhost",$user = "user",$pass = "123456",$dbname = "bbs")
		{
			$my_conn= mysql_connect($this->host, $this->user, $this->pass);			//连接服务器
			
			
			if(!$my_conn){
				die("mysql 连接失败。");
			}

			$db_select = mysql_select_db($this->dbname); 		//连接可用的数据库
			if (!$db_select) {
				die("无法连接至 ".$dbname." 数据库，".mysql_error());
			}

			mysql_query("SET NAMES UTF8");//设置查询编码，否则中文登录时会报错
		
		}

		public function query($sql)
		{
			return mysql_query($sql);
		}



	}*/

	
	$host = "localhost";
	$user = "user";
	$pass = "123456";
	$dbname = "bbs";  //论坛数据库
	$p_num = "10"; //，每页显示的条数（可以不要引号吗）
	// $admin_name = "admin";//管理员用户名
	// $admin_pass = "admin";//管理员密码
	$bbs_user="bbs_user";									//用户表名称
	$bbs_type="bbs_type";									//论坛版块表名称
	$bbs_post="bbs_post";									//论坛贴子表名称
	$my_conn = mysql_connect($host, $user, $pass);			//连接服务器
	if(!$my_conn){
		die("mysql 连接失败。");
	}
	$db_select = mysql_select_db($dbname,$my_conn); 		//连接可用的数据库
	if (!$db_select) {
		die("无法连接至 ".$dbname." 数据库，".mysql_error());
	}
	mysql_query("SET NAMES UTF8");//设置查询编码，否则中文登录时会报错
/*
$db=NEW DBA;
$sql="select * from bbs_user";
$RES=$db->query($sql);

while($row=mysql_fetch_assoc($RES))
{
   print_r($row);
}
*/
?>