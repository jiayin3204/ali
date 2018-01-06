<?php

/**
 * @Author: sks
 * @Date:   2017-10-31 15:11:21
 * @Last Modified by:   sks
 * @Last Modified time: 2017-11-07 14:23:48
 */
// session_start();
?>
<div class="profile">
      <img class="avatar" src="../../uploads/avatar.jpg">
      <h3 class="name"><?=$_SESSION['nickname']?></h3>
    </div>
    <ul class="nav">
      <li class="active">
        <a href="index.html"><i class="fa fa-dashboard"></i>仪表盘</a>
      </li>
      <li>
        <a href="#menu-posts" class="collapsed" data-toggle="collapse">
          <i class="fa fa-thumb-tack"></i>文章<i class="fa fa-angle-right"></i>
        </a>
        <ul id="menu-posts" class="collapse">
          <li><a href="/admin/post/posts.php">所有文章</a></li>
          <li><a href="/admin/post/addpost.php">写文章</a></li>
          <li><a href="/admin/cate/categories.php">分类目录</a></li>
        </ul>
      </li>
      <li>
        <a href="/admin/other/comments.php"><i class="fa fa-comments"></i>评论</a>
      </li>
      <li>
        <a href="/admin/user/users.php"><i class="fa fa-users"></i>用户</a>
      </li>
      <li>
        <a href="/admin/other/settings.php" class="collapsed" data-toggle="collapse">
          <i class="fa fa-cogs"></i>设置<i class="fa fa-angle-right"></i>
        </a>
        <ul id="menu-settings" class="collapse">
          <li><a href="nav-menus.html">导航菜单</a></li>
          <li><a href="/admin/other/slides.php">图片轮播</a></li>
          <li><a href="settings.html">网站设置</a></li>
        </ul>
      </li>
    </ul>