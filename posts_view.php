<?php 
  session_start();
  error_reporting(0);
if ($_GET['posts']) {
  include "conn.php";
  $post_id = $_GET['posts'];
  // $sql = "SELECT * FROM $bbs_post WHERE id='$post_id' ";
  $sql = "SELECT a.*,b.name,b.photo FROM `bbs_post` as a join bbs_user as b on a.poster_id = b.id WHERE a.id = $post_id";
  mysql_query("SET NAMES UTF8");
  $result = mysql_query($sql,$my_conn); //查询数据库

  $temp = 0;//记录楼层
  while ($row=mysql_fetch_array($result)) {
    $temp++;
    // var_dump($row);
?>

<!--设置栅格的列数为10列，列偏移为1-->
<div class="col-xs-12 col-sm-10 col-sm-offset-1">
  <div class="row">
    <div class="col-xs-12 col-lg-12 mt10">
      <div class="section-summary">
        <div class="section-main">
          <!--主题标题，独占一行-->
          <h3 class="bb1"><?php echo $row['title'] ?></h3>
          <!--主题正文-->
          <div class="section-main section-main-content">
            <dl>
              <!--用户信息（头像，名称）-->
              <dt>
                <!--头像-->
                <img class="section-head-portrait" src=<?php if(!$row['photo']){echo "img/bbg.png" ;} else { echo "img/".$row['photo'].".gif";} ?> alt="头像">
                <!--用户名，并提示为楼主-->
                <span><?php echo $row['name']; ?></span>
              </dt>
              <!--帖子的内容(正文，发布时间，几楼)-->
              <dd>
                <!--主题的内容-->
                <p class="section-post-content">
                  <?php echo $row['content']; ?>
                <!--主题发布时间-->
                <div class="section-post-time">
                  <span class="section-floor"><?php echo $temp; ?>楼</span>
                  <span class="section-date"><?php echo $row['p_time']; ?></span>
                </div>
              </dd>
            </dl>
          </div>
        </div>
        <!--以下为留言回复------------------------------------------------------------>
        <h3 style="text-align: center;">以下为留言回复</h3>
        <?php 
          if ($row['r_num']>0) {
            # code...
            $sql2 = "SELECT a.*,b.name,b.photo FROM $bbs_post as a join $bbs_user as b on (a.poster_id = b.id) WHERE re_id='$row[id]'";
            mysql_query("SET NAMES UTF8");
            $result2 = mysql_query($sql2,$my_conn);
            while ($row2=mysql_fetch_array($result2)) {
              ++$temp;
              // var_dump($row2);
        ?>
        
        <div class="section-response">
          <div class="section-main section-main-content pt5">
            <dl>
              <!--用户信息（头像，名称）-->
              <dt>
                <!--头像-->
                <img class="section-head-portrait" src=<?php if(!$row2['photo']){echo "img/bbg.png" ;} else { echo "img/".$row2['photo'].".gif";} ?> alt="头像">
                <!--用户名，并提示为楼主-->
                <span><?php echo $row2['name'] ?></span>
              </dt>
              <!--帖子的内容(正文，发布时间，几楼)-->
              <dd>
                <!--主题的内容-->
                <p class="section-post-content">
                  <?php  
                    echo $row2['content'];
                  ?>
                </p>
                <!--主题发布时间-->
                <div class="section-post-time">
                  <span class="section-floor"><?php echo $temp; ?>楼</span>
                  <span class="section-date"><?php echo $row2['p_time'];  ?></span>  
                </div>
              </dd>
            </dl>
          </div>
        </div>
        <?php 
          }
        }
        ?>
        <!--以下为发表回复区域-->
        <div class="section-write-response mt40">
          <form role="form" id="response_form" action="posts_response.php" method="post">
              <div class="form-group">
              <input type="hidden" name="p_id" value= <?php echo $post_id; ?>>
              <input type="hidden" name="r_num" value= <?php echo $row['r_num']; ?>>
                <label for="p_content">帖子回复区:</label>
                <textarea class="form-control" name="p_content" id="p_content" placeholder="请输入帖子内容" rows="10" required>
              &lt;strong&gt;请输入内容......&lt;/strong&gt;
                </textarea>
              </div>
              <button type="submit" id="posts_view_submit" class="btn btn-default">提交</button>
          </form>
        </div>
      </div>
    </div><!--/.col-xs-12.col-lg-4-->
  </div><!--/row-->
</div><!--/.col-xs-12.col-sm-10-->

<?php 
    }
  }
?>