<?php 
 header('Content-type:image/png');
//随机产生验证码：
//将可用的字符保存在一个字符中
$str = '23456789abcdefghABCDEFGHIJK';
//定义一个$code用来保存产生好的验证码
$code = '';
//循环，每次从$str中取出一个字符
for($i = 0;$i<4;$i++){
	$code.= $str[rand(0,strlen($str)-1)];
}
//绘制图片
//1 创建画布
$img = imagecreatetruecolor(110, 34);
// 2 创建画笔
$green = imagecolorallocate($img, 0, 255, 0);
// 3 绘制验证码
for($i = 0 ;$i< 4; $i++){
 imagettftext(
 	$img,//画布资源
    rand(20,25), //字体大小，像素级别的
    rand(-15,15),//倾斜角度
    10 + $i*23, 
    30, 
    //随机产生一根画笔
    imagecolorallocate($img, rand(0,255), rand(0,100), rand(0,255)) ,
    'msyhl.ttc', //文字文件的路径
    $code[$i]
    );
}
// 显示/保存验证码
imagejpeg($img);
//销毁
imagedestroy($img);




 ?>