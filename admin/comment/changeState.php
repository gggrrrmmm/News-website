<?php 
//接收前端发送的cmt_id 和按钮文字
//print_r($_GET);
$id = $_GET['id'];
$state = $_GET['state'];

//2 链接mysql数据库
include_once '../include/mysql.php';

//3拼接修改的sql语句 修改的是状态
$sql = "update ali_comment set  cmt_state='$state'  where cmt_id=$id";

//4 执行sql语句
$res = mysql_query($sql);

//5 判断是否改变状态
if($res){
	echo 1;
}else{
	echo 2;
}








 ?>