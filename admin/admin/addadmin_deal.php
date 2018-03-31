<?php 
//添加新管理员 接收表单添加数据
//测试一下
//print_r($_POST);
//php后台接收表单数据  ，链接mysql服务器  将数据写在ali_admin表中  返回结果给前台
$email    = $_POST['email'];
$nickname = $_POST['nickname'];
$password = md5($_POST['password']);
$age      = $_POST['age'];
$gender	  = $_POST['gender'];
$state    = $_POST['state'];

//补充添加管理员的时间戳
$time = time();


//2链接mysql服务器
include_once '../include/mysql.php';
//3 拼写添加 sql语句          
$sql = "insert into ali_admin values(null,'$email','$nickname','$password',$age,'$gender',$time,$state) ";
//4执行sql
$res = mysql_query($sql);

//5 判断添加结果
if($res){
	echo 1;
	//添加成功输出1；
}else{
	echo 2;
	//添加失败输出2；
}

 ?>