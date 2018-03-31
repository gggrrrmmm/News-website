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
  <?php include_once 'left.php'; ?>
    <div class="content">
      <div class="article">
        <div class="breadcrumb">
<?php 
//1 接收index.php传递过来的id
$id = $_GET['id'];
//2 链接mysql服务器  查询数据
include_once 'admin/include/mysql.php';
//3 编写sql语句(多表查询 ali_cate  )
$sql = "select * from ali_article art  
join ali_admin a on art.article_adminid = a.admin_id
join ali_cate  c on art.article_cateid = c.cate_id
where article_id= $id";
//4 执行sql语句
$res = mysql_query($sql);
 //根据id查的里面就是一条数据 
$row = mysql_fetch_assoc($res);


//根据点击量(每次点击一次就加1)  额外添加一条(修改)sql语句
$sql = " update  ali_article  set article_click = article_click +1 where article_id = $id ";
mysql_query($sql);
 ?>      

          <dl>
            <dt>当前位置：</dt>
            <dd><a href="javascript:;"><?php echo $row['cate_name']; ?></a></dd>
            <dd><?php echo $row['article_title']; ?></dd>
          </dl>
        </div>
        <h2 class="title">
          <a href="javascript:;"><?php echo $row['article_title']; ?></a>
        </h2>
        <div class="meta">
          <span><?php echo $row['admin_nickname']; ?> 发布于 <?php echo date('Y-m-d',$row['article_addtime']); ?></span>
          <span>分类: <a href="javascript:;"><?php echo $row['article_title']; ?></a></span>
          <span>阅读: (<?php echo $row['article_click']; ?>)</span>
          <span>评论: (143)</span>
        </div>
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
    </div>
    <div class="footer">
      <p>© 2016 XIU主题演示 本站主题由 themebetter 提供</p>
    </div>
  </div>
</body>
</html>
