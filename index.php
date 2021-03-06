
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>阿里百秀-发现生活，发现美!</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.css">
</head>
<body>
  <div class="wrapper">
  <?php include_once 'admin/include/checksession.php'; ?>
<?php include_once 'left.php' ;?>
<?php 
//-----图片轮播------
include_once 'admin/include/mysql.php';
//2 拼写读取轮播的sql语句
$sql = "select * from ali_pic";
$res = mysql_query($sql);
 ?>
    <div class="content">
      <div class="swipe">
        <ul class="swipe-wrapper">
        <?php while($row=mysql_fetch_assoc($res)){ ?>
          <li>
            <a href="#">
              <img src="/admin/uploads/<?php echo $row['pic_url']; ?>">
              <span><?php echo $row['pic_text']; ?></span>
            </a>
          </li>
         <?php } ?>
        </ul>
        <p class="cursor"><span class="active"></span><span></span><span></span><span></span></p>
        <a href="javascript:;" class="arrow prev"><i class="fa fa-chevron-left"></i></a>
        <a href="javascript:;" class="arrow next"><i class="fa fa-chevron-right"></i></a>
      </div>
      <div class="panel focus">
      <!-- 焦点关注 部分 -->
 <?php 
 $sql1 = "select * from ali_article where article_foucs=1 ORDER BY  article_addtime desc" ;
 $res1 = mysql_query($sql1);
  ?>     
        <h3>焦点关注</h3>
        <ul>
        <?php $i=0; ?>
        <?php while($row1=mysql_fetch_assoc($res1)){ ?>
          <li class="<?php if($i==0){echo 'large';} ?>">
          <!-- 添加每一篇文章标题上的超链接 -->
            <a href="detail.php?id=<?php echo $row1['article_id']; ?>">
              <img src="/admin/uploads/<?php echo $row1['article_pic']; ?>" alt="">
              <span><?php echo $row1['article_title']; ?></span>
            </a>
          </li>
          <?php $i++; ?>
          <?php } ?>
        </ul>
      </div>
      <div class="panel top">
        <h3>一周热门排行</h3>
        <ol>
          <li>
            <i>1</i>
            <a href="javascript:;">你敢骑吗？全球第一辆全功能3D打印摩托车亮相</a>
            <a href="javascript:;" class="like">赞(964)</a>
            <span>阅读 (18206)</span>
          </li>
          <li>
            <i>2</i>
            <a href="javascript:;">又现酒窝夹笔盖新技能 城里人是不让人活了！</a>
            <a href="javascript:;" class="like">赞(964)</a>
            <span class="">阅读 (18206)</span>
          </li>
          <li>
            <i>3</i>
            <a href="javascript:;">实在太邪恶！照亮妹纸绝对领域与私处</a>
            <a href="javascript:;" class="like">赞(964)</a>
            <span>阅读 (18206)</span>
          </li>
          <li>
            <i>4</i>
            <a href="javascript:;">没有任何防护措施的摄影师在水下拍到了这些画面</a>
            <a href="javascript:;" class="like">赞(964)</a>
            <span>阅读 (18206)</span>
          </li>
          <li>
            <i>5</i>
            <a href="javascript:;">废灯泡的14种玩法 妹子见了都会心动</a>
            <a href="javascript:;" class="like">赞(964)</a>
            <span>阅读 (18206)</span>
          </li>
        </ol>
      </div>
      <div class="panel hots">
        <h3>热门推荐</h3>
        <ul>
          <li>
            <a href="javascript:;">
              <img src="uploads/hots_2.jpg" alt="">
              <span>星球大战:原力觉醒视频演示 电影票68</span>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <img src="uploads/hots_3.jpg" alt="">
              <span>你敢骑吗？全球第一辆全功能3D打印摩托车亮相</span>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <img src="uploads/hots_4.jpg" alt="">
              <span>又现酒窝夹笔盖新技能 城里人是不让人活了！</span>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <img src="uploads/hots_5.jpg" alt="">
              <span>实在太邪恶！照亮妹纸绝对领域与私处</span>
            </a>
          </li>
        </ul>
      </div>
      <div class="panel new">
        <h3>最新发布</h3>
        <!-- 最新发布 -->
<?php 
//链接mysql服务器
//2 编写sql语句  查询ali_admin(admin_nickname)  ali_cate(cate_name)  
//ali_article(article_title  article_addtime  article_content ) 三张表
$sql2 = "select * from ali_article art 
join ali_admin a on art.article_adminid=a.admin_id
join ali_cate c on art.article_cateid = c.cate_id
order by  article_addtime desc
LIMIT 0,3";

//3执行sql语句
$res2 = mysql_query($sql2);
 ?>
        <?php while($row2 = mysql_fetch_assoc($res2)){ ?>
        <div class="entry">
          <div class="head">
            <span class="sort"><?php echo $row2['cate_name']; ?></span>
            <a href="javascript:;"><?php echo $row2['article_title']; ?></a>
          </div>
          <div class="main">
            <p class="info"><?php echo $row2['admin_nickname']; ?> 发表于 <?php echo  date('Y-m-d', $row2['article_addtime']); ?></p>
            <p class="brief"><?php echo $row2['article_content']; ?></p>
            <p class="extra">
              <span class="reading">阅读(<?php echo $row2['article_click']; ?>)</span>
              <span class="comment">评论(0)</span>
              <a href="javascript:;" class="like">
                <i class="fa fa-thumbs-up"></i>
                <span>赞(<?php echo $row2['article_good']; ?>)</span>
              </a>
              <a href="javascript:;" class="tags">
                分类：<span><?php echo $row2['article_desc']; ?></span>
              </a>
            </p>
            <a href="javascript:;" class="thumb">
              <img src="/admin/uploads/<?php echo $row2['article_pic']; ?>" alt="">
            </a>
            <?php } ?>
          </div>
        </div>
        
      </div>
    </div>
    <div class="footer">
      <p>© 2016 XIU主题演示 本站主题由 themebetter 提供</p>
    </div>
  </div>
  <script src="assets/vendors/jquery/jquery.js"></script>
  <script src="assets/vendors/swipe/swipe.js"></script>
  <script>
    //
    var swiper = Swipe(document.querySelector('.swipe'), {
      auto: 3000,
      transitionEnd: function (index) {
        // index++;

        $('.cursor span').eq(index).addClass('active').siblings('.active').removeClass('active');
      }
    });

    // 上/下一张
    $('.swipe .arrow').on('click', function () {
      var _this = $(this);

      if(_this.is('.prev')) {
        swiper.prev();
      } else if(_this.is('.next')) {
        swiper.next();
      }
    })
  </script>
</body>
</html>
