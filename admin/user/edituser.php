<?php

/**
 * @Author: sks
 * @Date:   2017-11-03 10:58:46
 * @Last Modified by:   sks
 * @Last Modified time: 2017-11-03 19:56:47
 */
$id = $_GET['id'];
include_once '../include/mysql.php';
$sql = "select * from ali_user where user_id = $id";
$res = mysql_query($sql);
$rowInfo = mysql_fetch_assoc($res);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
  <link rel="stylesheet" href="../../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../../assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../../assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../../assets/css/admin.css">
  <script src="../../assets/vendors/nprogress/nprogress.js"></script>
  <script type="text/javascript" src="../../assets/vendors/jquery/jquery.min.js"></script>
</head>
<body>
  <?php include_once '../checksession.php';?>
  <div class="col-md-4">
    <form id="formObj">
      <h2>修改用户</h2>
      <div class="form-group">
        <label for="email">邮箱</label>
        	<input type="hidden" id="id" value="<?=$id?>">
              <input id="email" class="form-control" name="email" type="email" value="<?=$rowInfo['user_email'];?>">
            </div>
            <div class="form-group">
              <label for="slug">别名</label>
              <input id="slug" class="form-control" name="slug" type="text" value="<?=$rowInfo['user_slug'];?>">
            </div>
            <div class="form-group">
              <label for="nickname">昵称</label>
              <input id="nickname" class="form-control" name="nickname" type="text" value="<?=$rowInfo['user_nickname'];?>">
            </div>
            <div class="form-group">
              <label for="password">密码</label>
              <input id="password" class="form-control" name="password" type="text" value="<?=$rowInfo['user_pwd'];?>">
            </div>
            <div class="form-group">
              <input type="button" value="修改" class="btn btn-primary sub">
      </div>
    </form>
  </div>
  <script type="text/javascript">
  $(".sub").click(function(){
  	var id = $("#id").val();
    var email = $("#email").val();
    var nickname = $("#nickname").val();
    var slug = $("#slug").val();
    var pwd = $("#password").val();
    var data = {id:id,email:email,slug:slug,pwd:pwd,nickname:nickname};
    $.post('myfiy.php',data,function(msg){
    	if(msg==1){
    		alert('修改成功');
    	}else{
    		alert('修改失败');
    	}
      // alert(msg); 
    	var index = parent.layer.getFrameIndex(window.name);
      parent.layer.close(index);
      parent.location.reload();
    });
  });
    
  </script>
</body>
</html>
