<?php

/**
 * @Author: sks
 * @Date:   2017-11-02 19:48:52
 * @Last Modified by:   sks
 * @Last Modified time: 2017-11-04 22:01:14
 */
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
      <h2>添加新用户</h2>
      <div class="form-group">
        <label for="email">邮箱</label>
              <input id="email" class="form-control" name="email" type="email" placeholder="邮箱">
            </div>
            <div class="form-group">
              <label for="slug">别名</label>
              <input id="slug" class="form-control" name="slug" type="text" placeholder="slug">
            </div>
            <div class="form-group">
              <label for="nickname">昵称</label>
              <input id="nickname" class="form-control" name="nickname" type="text" placeholder="昵称">
            </div>
            <div class="form-group">
              <label for="password">密码</label>
              <input id="password" class="form-control" name="password" type="text" placeholder="密码">
            </div>
            <div class="form-group">
              <input type="button" class="btn btn-primary sub" value="添加"/>
      </div>
    </form>
  </div>
  <script type="text/javascript">
    $(".sub").click(function(){
      // 将jQuery对象转换成DOM对象
      // var fm = $('#formObj')[0];
      var fm = document.getElementById('formObj');
      // 用FormTata对象接收所有数据  实例化FormData对象
      var fd = new FormData(fm);
      // 发送ajax请求
      $.ajax({
        url:'adduser_deal.php',
        // 想后台传数据的方式
        type:'post',
        // 以FormData的方式收集数据
        data: fd,
        contentType:false,
        processData:false,
        // 后台返回数据的类型
        dataType:'text',
        success:function(msg){
          if(msg == 1){
            alert('添加用户成功');
          }else{
            alert('添加用户失败');
          }
          var index = parent.layer.getFrameIndex(window.name);
          parent.layer.close(index);
        }
      });
    });
  </script>
</body>
</html>
