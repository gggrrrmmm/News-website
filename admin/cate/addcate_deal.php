<?php 
header('content-type:text/html;charset=utf-8');
//1接收表单提交的数据
$name  =$_POST['name'];
$slug  =$_POST['slug'];
$state =$_POST['state'];
$show  =$_POST['show'];

//2 补充创建时间 --
$time = date('Y-m-d H:i:s',time());

//3 拼接sql
$sql = "insert into ali_cate values(null,'$name','$slug','$time',$state,$show)";

//链接数据库
include_once '../include/mysql.php';


//执行
$res = mysql_query($sql);
if($res){
	echo  "添加成功";
	header('refresh:2;url=categories.php');
}else{
	echo  "添加失败";
	header('refresh:2;url=addcate.php');

}

 ?>