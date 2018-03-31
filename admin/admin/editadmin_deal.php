<?php 
//编辑管理员信息
$id = $_POST['id'];
$email = $_POST['email'];
$nickname= $_POST['nickname'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$state = $_POST['state'];

//2 链接mysql服务器
include_once '../include/mysql.php';
//3 拼写修改sql语句
$sql = "update ali_admin set admin_email='$email',admin_nickname='$nickname',admin_age=$age,admin_gender='$gender',admin_state = $state where admin_id=$id ";
// print_r($sql);
// die();
//4 执行sql语句
$res = mysql_query($sql);
//5判断是否编辑成功
if($res){
	echo 1;
}else{
	echo 2;
}












 ?>