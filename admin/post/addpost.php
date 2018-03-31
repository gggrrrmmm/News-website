<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Add new post &laquo; Admin</title>
  <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/assets/css/admin.css">
  <script src="/assets/vendors/nprogress/nprogress.js"></script>

<!-- 引入必要的css和js文件 -->
<link href="/assets/ueditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="/assets/ueditor/third-party/jquery.min.js"></script>
<script type="text/javascript" charset="utf-8" src="/assets/ueditor/umeditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/assets/ueditor/umeditor.min.js"></script>
<script type="text/javascript" src="/assets/ueditor/lang/zh-cn/zh-cn.js"></script> 

</head>
<body>
  <script>NProgress.start()</script>
<!-- ①引入session -->
  <?php  include_once '../include/checksession.php' ; ?>

  <div class="main">
    <nav class="navbar">
      <button class="btn btn-default navbar-btn fa fa-bars"></button>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="profile.html"><i class="fa fa-user"></i>个人中心</a></li>
        <li><a href="login.html"><i class="fa fa-sign-out"></i>退出</a></li>
      </ul>
    </nav>
    <div class="container-fluid">
      <div class="page-title">
        <h1>写文章</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <form class="row" action="addpost_deal.php" method="post" enctype="multipart/form-data">
        <div class="col-md-9">
          <div class="form-group">
            <label for="title">标题</label>
            <input id="title" class="form-control input-lg" name="title" type="text" placeholder="文章标题">
          </div>
          <div class="form-group">
            <label for="content">内容</label>
            <!-- ② 设置富文本承载标签 -->
            <textarea id="content"  name='content' style="width:850px;height: 300px"></textarea>
          </div>
        </div>
        <div class="col-md-3">
<?php 
// 动态产生栏目（分类）下拉菜单

//①链接mysql服务器
include_once '../include/mysql.php';
//② 编写sql语句 （查询ali_cate表 查询state=1 的栏目(启用的)）
$sql = "select * from ali_cate where cate_state=1";
//③ 执行sql
$res = mysql_query($sql);
//
 ?>         
          <div class="form-group">
            <label for="feature">特色图像</label>
            <!-- show when image chose -->
            <img class="help-block thumbnail" style="display: none">
            <input id="feature" class="form-control" name="feature" type="file">
          </div>
          <div class="form-group">
            <label for="category">所属分类</label>
            <select id="category" class="form-control" name="category">
            <!--循环显示在网页上-->
            <?php while($row=mysql_fetch_assoc($res)){ ?>
              <option value="<?php echo $row['cate_id']; ?>"><?php echo $row['cate_name']; ?></option>
            <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="status">状态</label>
            <select id="status" class="form-control" name="status">
              <option value="1">草稿</option>
              <option value="2">已发布</option>
            </select>
          </div>
          <div class="form-group">
            <button class="btn btn-primary" type="submit">保存</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="aside">
    <?php include_once '../include/aside.php'; ?>
  </div>


  <script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
  <!-- ③实例化富文本编辑器 -->
  <script>
    var um = UM.getEditor('content');
  </script>
</body>
</html>
