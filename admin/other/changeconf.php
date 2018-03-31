<?php 
header('content-type:text/html;charset=utf-8');
//接收表单提交的数据
$logo = '';
$name = $_POST['site_name'];
$desc = $_POST['site_description'];
$key  = $_POST['site_keywords'];
//评论状态  先判断是否设置
$cmts = isset($_POST['comment_status'])?    $_POST['comment_status']:2;
$shen = isset($_POST['comment_reviewed'])?  $_POST['comment_reviewed']:2;




//将数据保存在文件中 (定义后台的配置文件)
$str = "<?php 
 return  array(
 'logo'=>'$logo',
 'name'=>'$name',
 'desc'=>'$desc',
 'keys'=>'$key',
 'cmts'=>$cmts,
 'shen'=>$shen

	)
?>";

//将内容写入文件中
file_put_contents('site_conf.php', $str);
echo "修改成功";
//header('refresh:2;url=);










 ?>