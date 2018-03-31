<?php 
header('content-type:text/html;charset=utf-8');
//批量删除  
//接收前端传递的选中要删除的id
$ids = $_GET['ids'];

//2 链接mysql服务器
include_once '../include/mysql.php';

//3 编写删除sql语句 in是一组相同数据类型的数据  
$sql = "delete from ali_article where article_id in ($ids)";
$res  = mysql_query($sql);

//判断是否删除成功
if($res){
	echo "批量删除成功";
	header('refresh:2;url=posts.php');
}else{
	echo "删除失败";
	header('refresh:2;url=posts.php');
}







 ?>