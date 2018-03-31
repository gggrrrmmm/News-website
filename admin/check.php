<?php 
//print_r($_GET);
//1 用户输入的验证码
$yanzheng=$_GET['yanzheng'];

//2读取session 获取系统验证码
session_start();
$code=$_SESSION['code'];

//3检测用户输入的验证吗和系统产生的验证码是否一致  并且都转为小写 再进行对比
if(strtolower($yanzheng)!= strtolower($code)){
	//不一致输出1
	echo 1;
	die();
}

//2 检测用户输入的用户名
//先获取用户输入的用户名
$email = $_GET['email'];

//链接数据库 
// include_once 'include/mysql.php';
$conn = mysql_connect('localhost','root','123');
mysql_select_db('alishow');
mysql_query('set names utf8');
//查询数据库中的用户名(跟用户输入的用户名比对，如果用户输入的用户名，系统中没有，则为空，说明错误)
$sql = "select * from ali_admin where admin_email = '$email' ";
//执行sql语句
$res = mysql_query($sql);
//获取的是结果集（资源）
$admin_info = mysql_fetch_assoc($res);
if(empty($admin_info)){
	//如果系统中的数据为空，则说明 错误 
	echo 2;
	die();
}

//3 判断用户输入的密码和数据库中的密码是否一样
//接收用户输入的密码
$pwd = md5($_GET['password']);
if($admin_info['admin_pwd']!=$pwd){
	echo 3;
	die();
}else{
	echo 4;
	//将admin_id,admin_email,admin_nickname存入session中
	$_SESSION['id'] = $admin_info['admin_id'];
	$_SESSION['email']=$admin_info['admin_email'];
	$_SESSION['nickname']=$admin_info['admin_nickname'];
}








 ?>