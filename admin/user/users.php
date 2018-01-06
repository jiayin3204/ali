<?php

/**
 * @Author: sks
 * @Date:   2017-11-02 18:45:47
 * @Last Modified by:   sks
 * @Last Modified time: 2017-11-08 08:51:05
 */
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Users &laquo; Admin</title>
  <link rel="stylesheet" href="../../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../../assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../../assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../../assets/css/admin.css">
  <script src="../../assets/vendors/nprogress/nprogress.js"></script>
  <script src="../../assets/vendors/jquery/jquery.js"></script>
  <script src="../../assets/layer/layer.js"></script>
</head>
<body>
  <?php include_once '../checksession.php';?>
  <script>NProgress.start()</script>
  <?php 
    include_once '../include/mysql.php';
    // 设置的页数
    // 判断如果有数据传入就是该数据否则就显示第一页   页号
    $pageNob = isset($_GET['pageNob'])?$_GET['pageNob']:1;
    $start = ($pageNob-1)*3;
    $pagesize = 3;
    $sql = "select * from ali_user limit $start,$pagesize";
    $res = mysql_query($sql);
  ?>
  <div class="main">
    <?php include_once '../include/nav.php';?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>用户</h1>
        <input type="button" value="添加新用户" id="btn">
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="row">
        <div class="col-md-8">
          <div class="page-action">
            <!-- show when multiple checked -->
            <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
          </div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
               <tr>
                <th class="text-center" width="40"><input type="checkbox"></th>
                <th class="text-center" width="80">头像</th>
                <th>邮箱</th>
                <th>别名</th>
                <th>昵称</th>
                <th>状态</th>
                <th class="text-center" width="100">操作</th>
              </tr>
            </thead>
            <tbody>
              <?php while($row = mysql_fetch_assoc($res)):?>
              <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td class="text-center"><img class="avatar" src="../../assets/img/default.png"></td>
                <td><?=$row['user_email'];?></td>
                <td><?=$row['user_slug'];?></td>
                <td><?=$row['user_nickname'];?></td>
              <?php if($row['user_state']==0):?>
                <td>显示</td>
              <?php else:?>
                <td>不显示</td>
              <?php endif;?>
                <td class="text-center">
                  <a href="javescript:;" data="<?=$row['user_id'];?>" class="btn btn-default btn-xs edit">编辑</a>
                  <a href="javascript:;" data="<?=$row['user_id'];?>" class="btn btn-danger btn-xs delete">删除</a>
                </td>
              </tr>
              <?php endwhile;?>
            </tbody>
          </table>
          <?php
           // 计算总记录数
            $sql = "select count(*) num from ali_user";
            $res = mysql_query($sql);
            $row = mysql_fetch_assoc($res);
            // 取得总记录数
            $num = $row['num'];
            // 计算总页数
            $pages = ceil($num/$pagesize);
            // 获取下一页页号
            $next = $pageNob + 1;
            // 上一页
            $prev = $pageNob - 1;
            // 设置每页显示导航条的长度
            $len = 5;
            // 每次显示前后长度
            $special = ($len-1)/2;
            if($next>$pages){
              $next=$pages;
            }
            if($prev<=1){
              $prev = 1;
            }
          ?>
          <ul class="pagination pagination-sm pull-right">
              <li><a href="users.php?pageNob=1">首页</a></li>
              <li><a href="users.php?pageNob=<?=$prev;?>">上一页</a></li>
              <?php 
                if($pageNob <= $special){
                  for($i = 1;$i <= $len;$i++){
                    echo "<li><a href='users.php?pageNob=$i'>$i</a></li>";
                  }
                }else if($pageNob >= $pages - $special){
                  for($i = $pages - $len + 1;$i <= $pages;$i++){
                    echo "<li><a href='users.php?pageNob=$i'>$i</a></li>";
                  }
                }else{
                  for($i = $pageNob - $special;$i <= $pageNob + $special;$i++){
                    echo "<li><a href='users.php?pageNob=$i'>$i</a></li>";
                  }
                }
              ?>
              <li><a href="users.php?pageNob=<?=$next;?>">下一页</a></li>
              <li><a href="users.php?pageNob=<?=$pages;?>">尾页</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="aside">
    <?php include_once '../include/aside.php';?>
  </div>
  <script src="../../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
  <script type="text/javascript">
  	$('#btn').click(function(){
  		layer.ready(function(){ 
  			layer.open({
    		type: 2,
    		title: '添加新用户',
    		maxmin: true,
    		area: ['800px', '500px'],
    		content: 'adduser.php',
  			});
			});
  	});	
  	$(".delete").click(function(){
  		var id = $(this).attr('data');
  		var that = $(this);
  		// 发送ajax请求
  		$.post('delete.php',{id:id},function(msg){
  			if(msg==1){
  				that.parent().parent().remove();
  				alert('删除用户成功');
  			}else{
  				alert('删除用户失败');
  			}
  		});
  	});
    $(".edit").click(function(){
      var id = $(this).attr('data');
      layer.ready(function(){ 
        layer.open({
        type: 2,
        title: '修改用户',
        maxmin: true,
        area: ['800px', '500px'],
        content: 'edituser.php?id='+id,
        });
      });

    });
  </script>
</body>
</html>
