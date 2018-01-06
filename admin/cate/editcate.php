<?php

/**
 * @Author: sks
 * @Date:   2017-11-02 10:16:31
 * @Last Modified by:   sks
 * @Last Modified time: 2017-11-03 19:52:00
 */
header("content-type:text/html;charset=utf8");
include_once  '../checksession.php';
$id = $_GET['id'];
include_once '../include/mysql.php';
$sql = "select * from ali_cate where cate_id = $id";
$res = mysql_query($sql);
$cate_class = mysql_fetch_assoc($res);
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Categories &laquo; Admin</title>
  <link rel="stylesheet" href="../../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../../assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../../assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../../assets/css/admin.css">
  <script src="../../assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <script>NProgress.start()</script>
<!-- 禁止跳墙访问 -->
  <div class="main">
    <?php include_once '../include/nav.php';?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>分类目录</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="row">
        <div class="col-md-4">
          <form action="mysqlfy.php" method="post">
            <h2>修改新分类目录</h2>
            <div class="form-group">
              <label for="name">名称</label>
              <input type="hidden" name="id" value="<?=$cate_class['cate_id'];?>">
              <input id="name" class="form-control" name="name" type="text" value="<?=$cate_class['cate_name']?>">
            </div>
            <div class="form-group">
              <label for="slug">别名</label>
              <input id="slug" class="form-control" name="slug" type="text" value="<?=$cate_class['cate_slug']?>">
            </div>
            <div class="form-group">
              <label for="slug">图标</label>
              <input id="slug" class="form-control" name="icon" type="text" value="<?=$cate_class['cate_class']?>">
            </div>
            <div class="form-group">
              <label for="slug">启用</label>
              <?php if($cate_class['cate_state']==1):?>
              <input name="state" type="radio" value="1" checked>启用
              <input name="state" type="radio" value="2">禁用
         	 		<?php else:?>
          		<input name="state" type="radio" value="1">启用
              <input name="state" type="radio" value="2" checked>禁用
              <?php endif;?>
            </div>
            <div class="form-group">
              <label for="slug">显示</label>
              <?php if($cate_class['cate_show']==1):?>
              <input name="show" type="radio" value="1" checked>显示
              <input name="show" type="radio" value="2">不显示
            	<?php else:?>
            	<input name="show" type="radio" value="1">显示
              <input name="show" type="radio" value="2" checked>不显示
            	<?php endif;?>
            </div>
            <div class="form-group">
              <button class="btn btn-primary" type="submit">修改</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="aside">
    <?php include_once '../include/aside.php';?>
  </div>
  <script src="../../assets/vendors/jquery/jquery.js"></script>
  <script src="../../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
</body>
</html>