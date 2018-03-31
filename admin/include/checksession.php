<?php 
session_start();
if(empty($_SESSION['id'])){
	echo "尚未登陆,请先登陆";
	header('refresh:2;url=/admin/login.html');
	die();
}







 ?>