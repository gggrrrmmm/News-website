    <div class="topnav">
      <ul>
        <li><a href="javascript:;"><i class="fa fa-glass"></i>奇趣事</a></li>
        <li><a href="javascript:;"><i class="fa fa-phone"></i>潮科技</a></li>
        <li><a href="javascript:;"><i class="fa fa-fire"></i>会生活</a></li>
        <li><a href="javascript:;"><i class="fa fa-gift"></i>美奇迹</a></li>
      </ul>
    </div>
<?php 
// ---栏目读取 左侧边栏目---
//1 链接mysql
include_once 'admin/include/mysql.php';
//2 编写sql语句
$sql = "select * from ali_cate where cate_state=1 and cate_show=1";
$res = mysql_query($sql);
 ?>
    <div class="header">
      <h1 class="logo"><a href="index.html"><img src="assets/img/logo.png" alt=""></a></h1>
      <ul class="nav">
      <?php while($row=mysql_fetch_assoc($res)){ ?>
      <!-- 给a链接添加地址，可以跳转到list.php 并将当前的cate_id 和cate_name一起传递过去 -->
        <li><a href="list.php?id=<?php echo $row['cate_id']; ?>&name=<?php echo $row['cate_name']; ?>">
        <!-- cate_slug 保存的是类名 -->
        <i class="fa <?php echo $row['cate_slug']; ?>"></i>
        <?php echo $row['cate_name']; ?></a>
        </li>
      <?php } ?>
      </ul>
      <div class="search">
        <form>
          <input type="text" class="keys" placeholder="输入关键字">
          <input type="submit" class="btn" value="搜索">
        </form>
      </div>
      <div class="slink">
        <a href="javascript:;">链接01</a> | <a href="javascript:;">链接02</a>
      </div>
    </div>
    <div class="aside">
      <div class="widgets">
        <h4>搜索</h4>
        <div class="body search">
          <form>
            <input type="text" class="keys" placeholder="输入关键字">
            <input type="submit" class="btn" value="搜索">
          </form>
        </div>
      </div>
      <div class="widgets">
        <h4>随机推荐</h4>
<!--  随机推荐   -->
<?php 
//从article中随机查询5条数据，order by rand() 
//1 链接mysql服务器
include_once 'admin/include/mysql.php';
//2 拼写sql语句 并执行 
$sql1 = "select * from ali_article order by rand()
        limit 0,5";
 $res = mysql_query($sql1);
 //将内容循环显示在页面上       
 ?>
        <ul class="body random">
        <?php while($row=mysql_fetch_assoc($res)){ ?>
          <li>
            <a href="javascript:;">
              <p class="title"><?php echo $row['article_title']; ?></p>
              <p class="reading">阅读(<?php echo $row['article_good']; ?>)</p>
              <div class="pic">
                <img src="admin/uploads/<?php echo $row['article_pic']; ?>" alt="">
              </div>
            </a>
          </li>
        <?php } ?>
        </ul>
      </div>
      <div class="widgets">
        <h4>最新评论</h4>
        <ul class="body discuz">
          <li>
            <a href="javascript:;">
              <div class="avatar">
                <img src="uploads/avatar_1.jpg" alt="">
              </div>
              <div class="txt">
                <p>
                  <span>鲜活</span>9个月前(08-14)说:
                </p>
                <p>挺会玩的</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <div class="avatar">
                <img src="uploads/avatar_1.jpg" alt="">
              </div>
              <div class="txt">
                <p>
                  <span>鲜活</span>9个月前(08-14)说:
                </p>
                <p>挺会玩的</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <div class="avatar">
                <img src="uploads/avatar_2.jpg" alt="">
              </div>
              <div class="txt">
                <p>
                  <span>鲜活</span>9个月前(08-14)说:
                </p>
                <p>挺会玩的</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <div class="avatar">
                <img src="uploads/avatar_1.jpg" alt="">
              </div>
              <div class="txt">
                <p>
                  <span>鲜活</span>9个月前(08-14)说:
                </p>
                <p>挺会玩的</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <div class="avatar">
                <img src="uploads/avatar_2.jpg" alt="">
              </div>
              <div class="txt">
                <p>
                  <span>鲜活</span>9个月前(08-14)说:
                </p>
                <p>挺会玩的</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <div class="avatar">
                <img src="uploads/avatar_1.jpg" alt="">
              </div>
              <div class="txt">
                <p>
                  <span>鲜活</span>9个月前(08-14)说:
                </p>
                <p>挺会玩的</p>
              </div>
            </a>
          </li>
        </ul>
      </div>
    </div>