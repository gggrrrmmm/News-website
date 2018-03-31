<?php 
//1 接收前端传递的表单数据
$old_pwd = $_POST['old_pwd'];//接收旧密码
$new_pwd = $_POST['new_pwd'];//接收新密码
$reset_pwd = $_POST['reset_pwd'];//接收重置新密码

//2  判断用户输入的两个新的密码是否一致
if($new_pwd!=$reset_pwd){
	echo 1;
	die();
}

// 判断用用户输入的旧密码和数据库中的旧密码是否一致
//链接mysql服务器

include_once 'include/mysql.php';
//获取存在session里的id
session_start();
$id = $_SESSION['id'];


//拼写sql语句
$sql = "select * from ali_admin where admin_id = $id ";


//执行sql语句
$res = mysql_query($sql);
$row = mysql_fetch_assoc($res); //$row中只有一个admin_pwd一个单元
//判断数据中的密码和用户输入的密码是否一致
if(md5($old_pwd)!=$row['admin_pwd']){
	echo 2;
	die();
	//密码不一致
}else{
	//密码一致 可以继续重置密码
	$new_pwd = md5($new_pwd);
	//拼接修改的sql语句
	$sql1 = "update ali_admin set admin_pwd = '$new_pwd' where admin_id=$id"; //出错的地方：新密码没有加单引号
	$res = mysql_query($sql1);//执行sql语句
	if($res){
		echo 3;//修改成功
		die();
	}else{
		echo 4;//修改失败
		die();
	}

}
  









 ?>