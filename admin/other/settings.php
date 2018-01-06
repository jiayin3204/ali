<?php 
/**
 * @Author: sks
 * @Date:   2017-11-06 21:20:32
 * @Last Modified by:   sks
 * @Last Modified time: 2017-11-07 11:57:37
 */
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Settings &laquo; Admin</title>
  <link rel="stylesheet" href="../../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../../assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../../assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../../assets/css/admin.css">
  <script src="../../assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <script>NProgress.start()</script>
<?php 
include_once '../checksession.php';
$conf = include_once 'set.conf.php';
?>
  <div class="main">
   <?php include_once '../include/nav.php'; ?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>网站设置</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <form class="form-horizontal" action="modifyset.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="site_logo" class="col-sm-2 control-label">网站图标</label>
          <div class="col-sm-6">
            <label class="form-image">
              <input id="logo" type="file" value="<?=$conf['site_logo'];?>" name="site_logo">
              <img src="<?=$conf['site_logo'];?>">
              <i class="mask fa fa-upload"></i>
            </label>
          </div>
        </div>
        <div class="form-group">
          <label for="site_name" class="col-sm-2 control-label">站点名称</label>
          <div class="col-sm-6">
            <input id="site_name" name="site_name" class="form-control" type="type" value="<?=$conf['site_name'];?>">
          </div>
        </div>
        <div class="form-group">
          <label for="site_description" class="col-sm-2 control-label">站点描述</label>
          <div class="col-sm-6">
            <textarea id="site_description" name="site_desc" class="form-control" placeholder="站点描述" cols="30" rows="6">value="<?=$conf['site_desc'];?>"</textarea>
          </div>
        </div>
        <div class="form-group">
          <label for="site_keywords" class="col-sm-2 control-label">站点关键词</label>
          <div class="col-sm-6">
            <input id="site_keywords" name="site_key" class="form-control" type="type" value="<?=$conf['site_key'];?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">评论</label>
          <div class="col-sm-6">
            <div class="checkbox">
              <?php if($conf['cmt_start']==1): ?>
              <label><input id="comment_status" name="site_start" type="checkbox" checked value="1">
              开启评论功能</label>
            <?php else: ?>
              <label><input id="comment_status" name="site_start" type="checkbox" value="1">
              开启评论功能</label>
            <?php endif; ?>
            </div>
            <div class="checkbox">
              <?php if($conf['cmt_sh']==1): ?>
              <label><input id="comment_reviewed" name="site_sh" type="checkbox" checked value="1">评论必须经人工批准</label>
            <?php else: ?>
              <label><input id="comment_reviewed" name="site_sh" type="checkbox" value="1">评论必须经人工批准</label>
            <?php endif;?>              
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-6">
            <button type="submit" class="btn btn-primary">保存设置</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="aside">
    <?php include_once '../include/aside.php'; ?>
  </div>

  <script src="../../assets/vendors/jquery/jquery.js"></script>
  <script src="../../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
</body>
</html>
