<?php 
//print_r($_FILES);
//设置随机名字
$name = time().'jpg';
move_uploaded_file($_FILES['pic']['tmp_name'], $name);
echo $name;







 ?>