<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Users &laquo; Admin</title>
  <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/assets/css/admin.css">
  <script src="/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <script>NProgress.start()</script>
<?php include_once '../include/checksession.php';?>

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
        <h1>管理员</h1>
        <!-- 1 添加新管理员   ① 在用户列表页添加一个按钮 -->
        <button onclick="add_admin()">添加新管理员</button>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="row">
        
        <div class="col-md-8">
          <div class="page-action">
            <!-- show when multiple checked -->
            <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
          </div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
               <tr>
                <th class="text-center" width="40"><input type="checkbox"></th>
                <th class="text-center" width="80">头像</th>
                <th>邮箱</th>
                <th>别名</th>
                <th>创建时间</th>
                <th>状态</th>
                <th class="text-center" width="100">操作</th>
              </tr>
            </thead>
        <?php 
        //查看管理员信息栏目
        //1引入mysql.php文件
       
        include_once '../include/mysql.php';
        //2拼写查询语句sql
        $sql = "select * from ali_admin";
        //3 执行sql（资源集）//循环显示在页面上
        $res = mysql_query($sql);

         ?>

            <tbody>
            <?php while($row = mysql_fetch_assoc($res)){ ?>
              <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td class="text-center"><img class="avatar" src="/assets/img/default.png"></td>
                <td><?php echo $row['admin_email']; ?></td>
                <td><?php echo $row['admin_nickname']; ?></td>
                <td><?php echo date('Y-m-d H:i:s',$row['admin_addtime']); ?></td>
                <td><?php echo $row['admin_state']==1? '激活':'未激活'; ?></td>
                <td class="text-center">
                <!--href="javascript:;页面不跳转  -->
                <!-- 编辑管理员操作   为每一行添加一个编辑按钮  绑定点击事件
                发送ajax请求 并将admin_id一起发送  data是自定义属性-->
                  <a href="javascript:;" class="btn btn-default btn-xs" data="<?php echo $row['admin_id']; ?>">编辑</a>
                  <!-- 删除管理员操作   为每一行添加一个删除按钮  绑定点击事件  发送ajax请求 并将admin_id一起发送  data是自定义属性 -->
                  <a href="javascript:;" data="<?php echo $row['admin_id']; ?>"   class="btn btn-danger btn-xs">删除</a>
                </td>
              </tr>
              <?php  } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="aside">

    <?php include_once '../include/aside.php'; ?>
  </div>
  <!-- ② -->
  <script src="/assets/vendors/jquery/jquery.js"></script>
  <script type="text/javascript" src="/assets/layer/layer.js"></script>
  <script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
  <!-- ③调用layer对像中的open方法 -->
  <script type="text/javascript">

  //添加新的管理员  ②点击该按钮能够弹出一个添加用户的表单

function add_admin(){
  //1 制作弹出层(调用layer的open方法)
  layer.ready(function(){ 
  layer.open({
    type: 2,
    title: '添加页',
    maxmin: true,//受否有最大化最小化按钮（true/false）
    area: ['800px', '550px'],
    content: 'addadminform.html'//跳转后台的地址
  });
});
}





//删除管理员操作   (新增功能：添加输入层，提示框)
//1 先获取删除按钮   给每一行删除按钮绑定点击事件
$('.btn-danger').click(function(){
  _this = $(this);
  //提示：确定删除管理员吗
  layer.confirm('确定删除管理员吗',function(){
    //2 获取当前点击的删除按钮的data属性值  也就是admin_id
  var admin_id = _this.attr('data');
  //3发送ajax请求
  //参数1：请求后台php地址
  //参数2：传递到后台的数据  ---json
  //参数3：回调函数
  $.get('deladmin.php',{"id":admin_id},function(msg){
    //alert(msg);
    //根据后端返回数据  值作弹出层
    if(msg==1){

      layer.alert('删除管理员成功');
      //页面自动刷新 删除页面上
      //通过找到当前的删除按钮，找到父元素td，在通过td对象，找到父元素tr对象，再自杀
      _this.parent().parent().remove();

    }else{
      layer.alert('删除管理员失败');
    }
  });
  })
});

// 编辑管理员操作
//1 获取编辑标签元素 给每一个编辑按钮绑点击事件
$('.btn-default').click(function(){
//2 获取点击编辑时的当前行的admin_id
var id = $(this).attr('data');
//3 制定弹出框
 layer.ready(function(){ 
  layer.open({
    type: 2,
    title: '编辑页',
    maxmin: true,//受否有最大化最小化按钮（true/false）
    area: ['800px', '500px'],
    content: 'editadminform.php?id='+id//将id通过get方式拼接传递到后台php
  });
});

})








  
  </script>
</body>
</html>
