<?php 
header('content-type:text/html;charset=utf-8');
//1接收表单提交的数据
$id   = $_POST['id'];
$name = $_POST['name'];
$slug = $_POST['slug'];
$state= $_POST['state'];
$show = $_POST['show'];

//2拼接修改的sql语句
$sql = "update ali_cate set cate_name='$name',cate_slug='$slug',cate_state=$state,cate_show=$show where cate_id=$id  ";

//3 因日mysql.php  链接mysql服务器
include_once '../include/mysql.php';

//4执行sql语句
$res = mysql_query($sql);

//5判断结果  
if($res){
	echo "修改栏目成功";
	//跳转到列表信息页面
	header('refresh:2;url=categories.php');
}else{
	echo "修改栏目失败";
	//跳转到编辑页面
	header('refresh:2;url=editcate.php?id='.$id);
}







 ?>