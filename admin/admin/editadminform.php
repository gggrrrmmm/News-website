  <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/assets/css/admin.css">
  <script src="/assets/vendors/nprogress/nprogress.js"></script>
   <script type="text/javascript" src="/assets/jquery.1.11.js"></script>
  <div class="col-md-4">
<?php 
//测试是否正确
//echo $_GET['id'];
//1 接收admin_id
$admin_id = $_GET['id'];
//2 链接mysql服务器
include_once '../include/mysql.php';
//3 拼接sql语句
$sql = "select * from ali_admin where admin_id=$admin_id";

//4执行sql 
$res = mysql_query($sql);
//将资源转为一维数组(填充到表单中)
$admin_info = mysql_fetch_assoc($res);


 ?>

          <form id='mainForm'>
            <h2>编辑管理员</h2>
            <input type="hidden" name="id" value="<?php echo $admin_info['admin_id'];?>">
            <div class="form-group">
              <label for="email">邮箱</label>
              <input id="email" class="form-control" name="email" type="email" value="<?php echo $admin_info['admin_email'];?>">
            </div>
            <div class="form-group">
              <label for="nickname">昵称</label>
              <input id="nickname" class="form-control" name="nickname" type="text" value="<?php echo $admin_info['admin_nickname'];?>">
             
            </div>
            <div class="form-group">
              <label for="age">年龄</label>
              <input id="age" class="form-control" name="age" type="text" value="<?php echo $admin_info['admin_age'];?>">
            </div>
            <div class="form-group">
              <label for="gender">性别</label>
             <?php  if($admin_info['admin_gender']=='男'){ ?>
              <input id="gender"  name="gender" type="radio" value="男" checked>男
              <input id="gender"  name="gender" type="radio" value="女">女
              <?php }else{ ?>
              <input id="gender"  name="gender" type="radio" value="男" checked>男
              <input id="gender"  name="gender" type="radio" value="女">女
              <?php } ?>
            </div>
            <div class="form-group">
              <label for="state">状态</label>
              <?php if($admin_info['admin_state']==1) {?>
              <input id="state"  name="state" type="radio" value="1" checked >激活
              <input id="state"  name="state" type="radio" value="2">未激活
              <?php }else{ ?>
              <input id="state"  name="state" type="radio" value="1" checked >激活
              <input id="state"  name="state" type="radio" value="2">未激活
              <?php } ?>
            </div>
            <div class="form-group">
              <button class="btn btn-primary" type="submit">修改</button>
            </div>
          </form>
        </div>

        <script>
      

// 编辑管理员
//先获取表单数据，发送ajax请求,并将表单数据一起发送到后台
//① 获取表单数据 绑定点击事件
$('.btn-primary').click(function(){
  //②获取表单数据
  var fm = document.getElementById('mainForm');
  //实例化formdata对象
  var fd = new FormData(fm);
  //3 发送ajax请求
  $.ajax({
    url:'editadmin_deal.php',
    type:'post',
    data:fd,
    dataType:'text',
    contentType:false, //头设置信息 （使用FormData对象时设置该值为false）
    processData:false, //处理数据方式
    success: function(msg){
      //alert(msg);
      //根据后台返回的数据 制作提示框
      if(msg==1){
        parent.layer.alert('修改管理员信息成功');
        //删除页面 并自动刷新
        var index = parent.layer.getFrameIndex(window.name);
        parent.layer.close(index);
        //并自动刷新
        parent.location.reload();
      }else{
        parent.layer.alert('修改管理员信息失败');
      }
    }

  });
})



        </script>