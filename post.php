<?php  
	error_reporting(0);
	session_start();
	if (!$_POST) {
?>
<div class="col-xs-12 col-sm-8 col-sm-offset-2">
  <div class="row">
    <div class="col-xs-6 col-lg-12 mt10">
      <div class="section-summary mb170">
        <form role="form" action="post.php" method="post">
          <div class="form-group">
            <label for="p_title">标题:</label>
            <input type="text" class="form-control" id="p_titie" name="p_title" placeholder="请输入帖子标题" required>
          </div>
          <div class="form-group">
            <label for="p_content">内容:</label>
            <textarea class="form-control" id="p_content" name="p_content" placeholder="请输入帖子内容" rows="10" required></textarea>
          </div>
          <div class="form-group">
            <label for="p_category">类别:</label>
            <select id="p_category" class="form-control" name="p_category">
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
	//帖子发布业务逻辑
	}else if ($_POST) {
		include "conn.php";
		// echo $_SESSION['uid'];
		mysql_query("SET NAMES UTF8");
		$p_title = trim($_POST['p_title']);
		$p_content = trim($_POST['p_content']);
		$p_type = trim($_POST['p_category']);
		$poster_id = trim($_SESSION['uid']);
		// echo $poster_id;
		$p_time = trim(date("Y-m-d"));

		$sql = "INSERT INTO $bbs_post(type_id,re_id,poster_id,title,content,r_num,p_time,r_time) VALUES 
		('$p_type','','$poster_id','$p_title','$p_content','','$p_time','')";

		$result = mysql_query($sql,$my_conn);
		echo "发表成功，两秒后返回";
		echo "<meta http-equiv=\"refresh\" content=\"2; url=index.php\">\n";
	}
	
?>