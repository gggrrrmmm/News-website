<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Comments &laquo; Admin</title>
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
include_once '../include/mysql.php';

//额外设置两个标签  显示页数
//判断是否被设置 p
$pageno = isset($_GET['p'])? $_GET['p']:1;  //当前页数
$pagesize =3;  //当前页显示的数量

$start = ($pageno-1) * $pagesize;


$sql = "select * from ali_comment com  join  
 ali_article art on  com.cmt_postid=art.article_id
join ali_member mem on com.cmt_memid=mem.member_id 
limit  $start,$pagesize ";

$res = mysql_query($sql);

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
        <h1>所有评论</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
<!-- 动态常见页面 -->
<?php 
include_once '../include/mysql.php';
//编写数据总的长度 sql
$sql_count = "select count(*) num from ali_comment com  join  
 ali_article art on  com.cmt_postid=art.article_id
join ali_member mem on com.cmt_memid=mem.member_id ";

//执行sql语句
$res_count = mysql_query($sql_count);
$arr_count = mysql_fetch_assoc($res_count);
//获取页数总的长度（向上取整） 页数的总长度=ceil（数据总条数num/每页显示的数量）
$page_length = ceil($arr_count['num']/$pagesize);
echo $page_length;

?>

      <div class="page-action">
        <!-- show when multiple checked -->
        <div class="btn-batch" style="display: none">
          <button class="btn btn-info btn-sm">批量批准</button>
          <button class="btn btn-warning btn-sm">批量拒绝</button>
          <button class="btn btn-danger btn-sm">批量删除</button>
        </div>
        <ul class="pagination pagination-sm pull-right">
          <li><a href="comments.php ?p=1">首页</a></li>
          <!-- 给出边界  （判断）-->
          <?php 
            if($pageno>1){
            //如果页数大于1  当前页应该是比上一页大1
            $prev = $pageno - 1;
            echo "<li><a href='comments.php?p=$prev'>上一页</a></li>"; 
          }else{
            echo "<li><a href='javascript:;'>上一页</a></li>";
            }
           ?>
          <!-- 动态制作页数  循环-->
          <?php for($i=1;$i<=$page_length;$i++){ ?>
          <li><a href="comments.php ?p=<?php echo $i; ?>"><?php echo $i; ?></a></li>
          <?php } ?>
          <?php 
          if($pageno<$page_length){
            $prev = $pageno +1;
            echo "<li><a href='comments.php?p=$prev'>下一页</a></li>";
          }else{
            echo "<li><a href='javascript:;'>下一页</a></li>";
          }

           ?>
        
          <li><a href="comments.php ?p=<?php echo $page_length ?>">末页</a></li>
        </ul>
      </div>
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th class="text-center" width="40"><input type="checkbox"></th>
            <th>作者</th>
            <th>评论</th>
            <th>评论在</th>
            <th>提交于</th>
            <th>状态</th>
            <th class="text-center" width="100">操作</th>
          </tr>
        </thead>
        <tbody>
        <?php while($row=mysql_fetch_assoc($res)){?>
          <tr class="danger">
            <td class="text-center"><input type="checkbox"></td>
            
            <td><?php echo $row['member_nickname'];  ?></td>
            <td><?php echo $row['cmt_content']; ?></td>
            <td><?php echo $row['article_title']; ?></td>
            <td><?php echo date('Y-m-d',$row['cmt_time']); ?></td>
            <td><?php echo $row['cmt_state']; ?></td>
            <td class="text-center">
            <!--1  先正常显示批准和驳回  按钮 -->
            <!-- 如果当前显示的状态是批准， 则显示驳回 -->
            <?php if($row['cmt_state']=='批准'){ ?>
            <!-- 自定义一个data属性 来保存cmt_id -->
              <a href="javascript:;" data="<?php echo $row['cmt_id']; ?>" class="btn   state btn-warning btn-xs">驳回</a>
            <?php }else if($row['cmt_state']=='驳回'){ ?>
              <a href="javascript:;" data="<?php echo $row['cmt_id']; ?>" class="btn  state btn-info btn-xs">批准</a>
            <?php } ?>
              <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
            </td>
          </tr>
          <?php } ?>
          
        </tbody>
      </table>
    </div>
  </div>

  <div class="aside">
    <?php include_once '../include/aside.php' ;?>
  </div>

  <script src="/assets/vendors/jquery/jquery.js"></script>
  <script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
  <script>
    //2 给每一个按钮上绑定点击事件（驳回/批准）
    $('.state').click(function(){
      //alert(1);

      //3 点击‘驳回’，‘批准’，按钮时，将当前行的cmt_id和按钮文字（目标状态）,发送ajax请求
      var cmt_id = $(this).attr('data');//获取当前点击的那个cmt_id
      var state = $(this).html();//获取当前点击的（按钮）文字

        //转存对象
        _this=$(this);

      //发送ajax请求
      var data = {"id":cmt_id,"state":state,"_":Math.random()};
      $.get('changeState.php',data,function(msg){
        //alert(msg);
        //前端接收后端返回的数据 根据结果更新页面（更新当前行的状态栏，更新按钮上的文字，样式）
        if(msg==1){
          alert('更改状态成功');
          //更新文字内容
          if(state=='批准'){
            //如果状态==‘批准’，那么他的前一个应该是'批准'，自身文字改为'驳回'
            _this.parent().prev().html('批准');
            //更改自身的类名
            _this.removeClass('btn-info').addClass('btn-warning').html('驳回');
          }else{
            _this.parent().prev().html('驳回');
            //更改自身的类名
            _this.removeClass('btn-warning').addClass('btn-info').html('批准');
          }
        }

      });

    });

  </script>
</body>
</html>
