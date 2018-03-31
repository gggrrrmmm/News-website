<?php 
header('content-type:text/html;charset=utf-8');
//print_r($_POST);
//1 后台接收上传文件
//先判断是否上传文件成功
if($_FILES['image']['error']!=0){
	echo "上传的格式不正确,请重新上传";
	//header('refresh:2;url=slides.php');
}else{
	
	//找到最后一个.的位置
	$pos = strrpos($_FILES['image']['name'], '.');
	//截取最后一个.以及点之后的字符串
	$ext = substr($_FILES['image']['name'], $pos);
	//判断上传的文件是图片格式 
	$arr = array('.jpg','.gif','.png');
	if(in_array($ext,$arr)){
		echo "上传格式正确";
		//header('refresh:2;url=slide.php');
	}
}
//存在  更改随机名
$new_name = '../uploads/'.time().rand(10000,99999).$ext;
//更改文件路径
move_uploaded_file($_FILES['image']['tmp_name'], $new_name);

//2 接收表单数据
$text= $_POST['text'];//文本
$link=$_POST['link']; //链接

//3 链接数据库
include_once '../include/mysql.php';

//4 编写添加sql语句 并执行
$sql = "insert into ali_pic values(null,'$new_name','$text','$link')";

$res = mysql_query($sql);

//5 根据结果判断
if($res){
	echo "添加图片轮播成功";
}else{
	echo "添加图片轮播失败";
}
header('refresh:2;url=slides.php');

 ?>