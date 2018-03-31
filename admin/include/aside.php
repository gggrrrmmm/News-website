<?php 
//print_r($_SERVER);//可以获取到当前页面的路径 [SCRIPT_NAME]

//将脚本路径保存在数组中 (将 / 拆分出来)
$arr = explode('/',$_SERVER['SCRIPT_NAME']);
//$arr = ['','admin','other','setting']; //数组中存储的类似于这种
//根据数组的下标来判断  
//如果检测$arr[2]单元值  other/cate  

 ?>

<div class="profile">
      <img class="avatar" src="/uploads/avatar.jpg">
      <h3 class="name"><?php echo $_SESSION['nickname']; ?></h3>
    </div>
    <ul class="nav">
      <li class="active">
        <a href="index.html"><i class="fa fa-dashboard"></i>仪表盘</a>
      </li>
      <li>
        <a href="#menu-posts" class="collapsed" data-toggle="collapse">
          <i class="fa fa-thumb-tack"></i>文章<i class="fa fa-angle-right"></i>
        </a>
        <!-- collapse in 下拉菜单展开状态(other/cate)   collapse 是下拉菜单收起状态   -->
       
        <ul id="menu-posts" class="collapse <?php if($arr[2]=='other'||$arr[2]=='cate'){echo 'in';}?>">
        
          <li><a href="/admin/post/posts.php">所有文章</a></li>
          <li><a href="/admin/post/addpost.php">写文章</a></li>
          <li><a href="/admin/cate/categories.php">分类目录</a></li>
          <li><a href="/admin/cate/addcate.php">添加分类</a></li>
        </ul>
      </li>
      <li>
        <a href="/admin/comment/comments.php"><i class="fa fa-comments"></i>评论</a>
      </li>
      <li>
        <a href="/admin/admin/admin.php"><i class="fa fa-users"></i>用户</a>
      </li>
      <li>
        <a href="#menu-settings" class="collapsed" data-toggle="collapse">
          <i class="fa fa-cogs"></i>设置<i class="fa fa-angle-right"></i>
        </a>
        <ul id="menu-settings" class="collapse">
          <li><a href="nav-menus.html">导航菜单</a></li>
          <li><a href="/admin/other/slides.php">图片轮播</a></li>
          <li><a href="/admin/other/settings.php">网站设置</a></li>
        </ul>
      </li>
    </ul>