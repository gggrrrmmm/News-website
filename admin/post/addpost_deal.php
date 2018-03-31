<?php 
//引入session
include_once '../include/checksession.php';
//1 处理上传文件
//判断是否有文件上传
$new_name=''; //不上传文件时，也不会保存
if($_FILES['feature']['error']==0){
	//文件上传成功，改名，随机后缀 移动路径
	//截取文件的后缀名(先找打最后一个.的位置)
	$pos = strrpos($_FILES['feature']['name'],'.' );
	//截取
	$ext = substr($_FILES['feature']['name'],$pos);

	//修改文件名
	$new_name = '../uploads/'.time().rand(10000,99999).$ext;
	//修改默认路径
	move_uploaded_file($_FILES['feature']['tmp_name'],$new_name);

}

//2 接收表单的数据
$title = $_POST['title']; //文章标题
$content = $_POST['content']; //内容文本框
$cate = $_POST['category'];//所属分类
$status = $_POST['status'];//状态

/*echo $title;
echo $content;
echo $cate;
echo $status;
*/


//3 补充其他要添加进去的数据
$time = time();//时间戳
$click = rand(300,500); //点击
$good = rand(100,300);  //赞数
$bad = rand(0,50);  //点踩数

//获取文章内容的前200个字符为文章摘要
$desc = substr($content,0,200); //在$content中截取内容，从下标为0开始截取，截取到200
//获取保存在session中的id
$adminid = $_SESSION['id'];

//4 链接mysql服务器，编写(添加)sql语句
include_once '../include/mysql.php';
//编写添加文章的sql语句
$sql = "insert into ali_article values(null,'$title','$desc','$content',$adminid,
'$cate',$time,
'$status','$click','$good','$bad','$new_name')";

//执行sql语句
$res = mysql_query($sql);
//判断
if($res){
	echo "添加文章成功";
	//跳转到posts.php
	header('refresh:2;url=posts.php');
}else{
	echo "添加文章失败";
	header('refresh:2;url=addpost.php');
}



 ?>