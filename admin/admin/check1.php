<?php 
//1 接收前台传递的验证码
$yanzheng = $_GET['yanzheng'];
//2 判断输入的验证码跟在网页上显示的是否一样

//接收session  获取验证码
session_start();

$code= $_SESSION['code']
if(strtolower($code)!=strtolower($yanzheng)){
	echo 1;
}










 ?>