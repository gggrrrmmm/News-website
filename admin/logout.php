<?php 
//清楚所有的session
header('content-type:text/html;charset=utf-8');
session_start();
session_destroy();
//跳转回登录页
echo "正在退出";
header('refresh:2;url=login.html');









 ?>