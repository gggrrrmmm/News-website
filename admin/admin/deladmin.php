<?php 
//删除管理员操作

//测试结果
//echo $_GET['id'];
//接收前台传递的admin_id值
$admin_id = $_GET['id'];
//2 链接mysql服务器
include_once '../include/mysql.php';
//3拼接删除sql语句 (出错一次)删除语句
$sql = "delete  from  ali_admin where admin_id=$admin_id";
//4 执行sql语句
$res = mysql_query($sql);
//5判断删除结果
if($res){
	echo 1;
	//删除成功
}else{
	echo 2;
	//删除失败
}


 ?>