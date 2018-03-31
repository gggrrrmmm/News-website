<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Posts &laquo; Admin</title>
  <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/assets/css/admin.css">
  <script src="/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <script>NProgress.start()</script>
  <?php include_once '../include/checksession.php' ;?>
<?php 
//将数据库中的文章正常显示在页面上
//1 链接mysql服务器
include_once '../include/mysql.php';

//一 正文数据列表
//1 先定义两个变量
//当前页号 修改$pageno的赋值方式   接收传参
//是否被设置，如果有设置，执行$_POST['p'],如果没有设置，执行当前页为1
$pageno = isset($_GET['p'])?$_GET['p']:1;

//每页显示的数量
$pagesize = 5;
//计算查询的起始点
$start = ($pageno-1)*$pagesize;



//编写sql语句(多表查询 ali_admin,ali_cate,ali_article)
$sql = "select  article_id,article_title,admin_nickname,cate_name,article_addtime,article_state 
 from ali_article art join ali_admin a on art.article_adminid=a.admin_id
 join ali_cate c on art.article_cateid=c.cate_id
 limit $start,$pagesize ";

 //3执行sql语句
$res = mysql_query($sql);

//将数据表中的信息循环显示在网页上                                     
 ?>
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
        <h1>所有文章</h1>
        <a href="post-add.html" class="btn btn-primary btn-xs">写文章</a>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="page-action">
        <!-- show when multiple checked -->
        <a class="btn btn-danger dels btn-sm" href="javascript:;">批量删除</a>
        <form class="form-inline">
          <select name="" class="form-control input-sm">
            <option value="">所有分类</option>
            <option value="">未分类</option>
          </select>
          <select name="" class="form-control input-sm">
            <option value="">所有状态</option>
            <option value="">草稿</option>
            <option value="">已发布</option>
          </select>
          <button class="btn btn-default btn-sm">筛选</button>
        </form>
<?php 
// 动态制作导航条长度
// 获取总的条数 编写sql语句
$sql_count = "select  count(*) num 
 from ali_article art join ali_admin a on art.article_adminid=a.admin_id
 join ali_cate c on art.article_cateid=c.cate_id";

//执行sql语句
 $res_count = mysql_query($sql_count);
 $arr_count = mysql_fetch_assoc($res_count);


 //获取总的长度(向上取整)   总的条数除以在页面上显示的数量
 //动态的给页数  目的是为了循环
 $page_length = ceil($arr_count['num']/$pagesize);
 echo $page_length;


 ?>
        <ul class="pagination pagination-sm pull-right">
       
          <li><a href="posts.php?p=1">首页</a></li>

          <?php 
        //判断给出边界 如果当前页大于1  跳到上一页 应该是-1
        if($pageno>1){
          $prev = $pageno-1;
         echo "<li><a href='posts.php?p=$prev'>上一页</a></li>";
        }else{
          echo "<li><a href='javascript:;'>上一页</a></li>";
        }
         ?> 
           <!-- 动态的输出导航条 -->
          <?php for($i = 1;$i <= $page_length;$i++){ ?>
          <li><a href="posts.php?p=<?php echo $i; ?>"><?php echo $i; ?></a></li>
          <?php } ?>

        <?php 
        //如果当前页 小于总的页面 当前页跳转到下一页  当前页加一
        if($pageno < $page_length){
          $prev=$pageno+1;
          echo "<li><a href='posts.php?p=$prev'>下一页</a></li>";
        }else{
           echo "<li><a href='javascript:;'>下一页</a></li>";
        }

         ?>
          
          <li><a href="posts.php?p=<?php echo $page_length; ?>">末页</a></li>
        </ul>
      </div>
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th class="text-center" width="40"><input type="checkbox"></th>
            <th>标题</th>
            <th>作者</th>
            <th>分类</th>
            <th class="text-center">发表时间</th>
            <th class="text-center">状态</th>
            <th class="text-center" width="100">操作</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = mysql_fetch_assoc($res)){ ?>
          <tr>
            <td class="text-center"><input type="checkbox" value="<?php echo $row['article_id'];?>"></td>
            <td><?php echo $row['article_title']; ?></td>
            <td><?php echo $row['admin_nickname']; ?></td>
            <td><?php echo $row['cate_name']; ?></td>
            <td class="text-center">
            <?php echo date('Y-m-d H:i:s',$row['article_addtime']); ?></td>
            <td class="text-center">
            <?php echo $row['article_state']==1? '发布':'草稿' ;?></td>
            <td class="text-center">
              <a href="javascript:;" class="btn btn-default btn-xs">编辑</a>
              <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>

  <div class="aside">
    <?php include_once '../include/aside.php'; ?>
  </div>
  <script src="/assets/vendors/jquery/jquery.js"></script>
  <script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>

  <script>
    //批量删除
    //1 获取批量删除按钮对象，绑定点击事件
    $('.dels').click(function(){
      //获取已选中的checkbox中的value值
      //$(':checkbox')找到当前页面中所有的checkbox
      //$(':checkbox:checked') 找到当前已勾选的checkbox
      //check_list是一个类似于数组
      var check_list = $(':checkbox:checked');//找到当前已勾选的checkbox
      var ids = '';
      //循环选出其中已经勾选的checkbox
      check_list.each(function(index,elem){
        //index 索引 （点击删除时的下标）
        //elem 是每次循环取出的对象，这里是一个dom对象
        //elem.value 获取的value属性中的article_id 
        //alert(index+' ' +elem.value);
        ids += elem.value + ',';
      })
      //截取掉最后一个逗号
      ids = ids.slice(0,-1);
      //跳转到批量删除文章的php页面
      location.href = 'delposts.php?ids='+ids;

    })

  </script>
</body>
</html>
