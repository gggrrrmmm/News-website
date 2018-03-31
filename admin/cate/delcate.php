<?php 
header('Content-type:text/html;charset=utf-8');
//1接收要修改的栏目的cate_id
$id = $_GET['id'];
//接收要修改好的状态
$state = $_GET['state'];

$sql = "update ali_cate set cate_state=$state where cate_id=$id ";
//链接数据库
include_once '../include/mysql.php';

$res = mysql_query($sql);
if($res){
	echo "修改成功";
	header('refresh:2;url=categories.php');
}else{
	echo "修改失败";
	header('refresh:2;url=categories.php');
}





 ?>