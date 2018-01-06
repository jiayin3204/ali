<?php
/**
 * @Author: sks
 * @Date:   2017-10-31 17:25:08
 * @Last Modified by:   sks
 * @Last Modified time: 2017-11-06 21:57:26
 */
 ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Comments &laquo; Admin</title>
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
include_once '../include/mysql.php';
$sql = "select cmt_id,member_nickname,cmt_content,post_title,cmt_time,cmt_state from ali_comment c
  join ali_member m on c.cmt_memid = m.member_id
  join ali_post p on c.cmt_postid = p.post_id";
$res = mysql_query($sql);
?>
  <div class="main">
    <?php include_once '../include/nav.php'; ?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>所有评论</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="page-action">
        <!-- show when multiple checked -->
        <div class="btn-batch" style="display: block">
          <button class="btn btn-info btnAllow btn-sm">批量批准</button>
          <button class="btn btn-warning btn-sm">批量拒绝</button>
          <button class="btn btn-danger btn-sm">批量删除</button>
        </div>
        <ul class="pagination pagination-sm pull-right">
          <li><a href="#">上一页</a></li>
          <li><a href="#">1</a></li>
          <li><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#">下一页</a></li>
        </ul>
      </div>
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th class="text-center" width="40"><input type="checkbox"></th>
            <th>作者</th>
            <th>评论</th>
            <th>评论在</th>
            <th>提交于</th>
            <th>状态</th>
            <th class="text-center" width="100">操作</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = mysql_fetch_assoc($res)): ?>
          <tr class="danger">
            <td class="text-center"><input type="checkbox" value="<?=$row['cmt_id'];?>"></td>
            <td><?=$row['member_nickname'];?></td>
            <td><?=$row['cmt_content'];?></td>
            <td>《<?=$row['post_title'];?>》</td>
            <td><?=date('Y/m/d',$row['cmt_time']);?></td>
            <td class="state"><?=$row['cmt_state'];?></td>
            <td class="text-center">
              <?php if($row['cmt_state']=='驳回'): ?>
              <a href="javascript:;" data="<?=$row['cmt_id'];?>" class="btn btnObj btn-info btn-xs">批准</a>
            <?php else: ?>
              <a href="javascript:;" data="<?=$row['cmt_id'];?>" class="btn btnObj btn-warning btn-xs">驳回</a>
            <?php endif; ?>
              <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
            </td>
          </tr>
        <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="aside">
    <?php include_once '../include/aside.php';?>
  </div>
  <script src="../../assets/vendors/jquery/jquery.js"></script>
  <script src="../../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
  <script type="text/javascript">
    $('.btnObj').click(function(){
      // 获取当前按钮的值
      var state = $(this).html();
      var id = $(this).attr('data');
      // 保留当前按钮
      var that = $(this);
      // 发送ajax请求
      var data = {state:state,id:id};
      $.post('mydiftycmt.php',data,function(msg){
        if(msg==1){
// $(this)在这里不是上面this 所以不能直接用上面的$(this)
// 找到这个按钮的父元素td再找父元素tr再找tr下面的class为state的标签  修改内容
// 不可以直接用prev因为可能后期会更改位置
          that.parent().parent().find('.state').html(state);
          // 修改按钮的文字
          if(state=='驳回'){
            // 如果是驳回就改成批准移除驳回的样式  增加批准的样式
            that.html('批准');
            that.removeClass('btn-warning');
            that.addClass('btn-info');
          }else{
            that.html('驳回');
            that.removeClass('btn-info');
            that.addClass('btn-warning');
          }
        }else{
          alert('修改成功');
        }
      });
    });
    $('.btnAllow').click(function(){
      // 获取复选框中所有的选中的按钮
      // 所有的复选框
      // console.log($(':checkbox'));
      // 所有的复选框中的选中的复选框
      // console.log($(':checkbox:checked'));
      // 获取选中的复选框的value值
      var check_link = $(":checkbox:checked");
      var str = "";
      // 遍历所有选中的复选框
      check_link.each(function(index,el){
        // el是DOM对象   元素
        str += el.value + ",";
      });
      // console.log(str);//1,3,
      // 在str的后面多一个,号    截取字符串
      // 将截取的字符串传到后台
      str = str.substr(0,str.length-1);
      // console.log(str);//1,3,2
      $.post('allowcmt.php',{str:str},function(msg){
        if(msg==1){
          alert('修改成功');
          // 改变按钮和状态的样式
          // 循环遍历每个选中复选框
          check_link.each(function(){
            // $(this)是指当前的复选框  将内容改为批准
            $(this).parent().parent().find('.state').html('批准');
            $(this).parent().parent().find('.btnObj').html('驳回').removeClass('btn-info').addClass('btn-warning');
          });
        }else{
          alert('修改失败');
        }
      });
    });
  </script>
</body>
</html>
