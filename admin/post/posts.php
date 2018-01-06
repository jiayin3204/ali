<?php

/**
 * @Author: sks
 * @Date:   2017-11-04 14:32:05
 * @Last Modified by:   sks
 * @Last Modified time: 2017-11-06 19:55:09
 */
include_once '../include/mysql.php';
$cate = isset($_GET['cate'])?$_GET['cate']:0;
$state = isset($_GET['state'])?$_GET['state']:0;
// echo $cate;die;
// 在列表页进行筛选
$where = "";
// 判断如果分类不是0name就在SQL语句上添加where条件
if($cate != 0){
  $where .= "cate_id = $cate and ";
}
// 判断如果状态不是0那么就加上where条件
// 如说都不是0的情况下两个条件需要拼接
// 在where条件中and 1或者where 1是不会有任何影响的只是为了方便拼接语句
if($state != 0){
  $where .= "post_state = $state and ";
}
// 页号
$pageno = isset($_GET['pageno'])?$_GET['pageno']:1;
// 每页显示的条数
$pagesize = 3;
// 开始位置
$start = ($pageno-1)*$pagesize;
// 如果两种都是0,直接拼接where 1不会影响筛选
$where .= "1";
// 在数据表名后面空格添加一个变量,那么这个变量就是数据表名的别名
$sql = "select post_title,user_nickname,post_id,cate_id,cate_name,post_addtime,post_state from ali_post p 
join ali_user u on p.post_author=u.user_id 
join ali_cate c on p.post_cateid=c.cate_id
where $where limit $start,$pagesize";
$res = mysql_query($sql);
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Posts &laquo; Admin</title>
  <link rel="stylesheet" href="../../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../../assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../../assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../../assets/css/admin.css">
  <script src="../../assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <script>NProgress.start()</script>
<?php include_once '../checksession.php';?>
  <div class="main">
    <?php include_once '../include/nav.php';?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>所有文章</h1>
        <a href="post-add.html" class="btn btn-primary btn-xs">写文章</a>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="page-action">
        <!-- show when multiple checked -->
        <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
        <?php 
          $sql = "select * from ali_cate";
          $cate_res = mysql_query($sql);
        ?>
        <form class="form-inline" action="posts.php" method="get">
          <select name="cate" class="form-control input-sm">
            <option value="0" <?php $cate==0?'selected':''?>>所有分类</option>
          <?php while($row = mysql_fetch_assoc($cate_res)):?>
            <option value="<?=$row['cate_id'];?>" <?php echo $cate==$row['cate_id']?"selected":"";?>><?=$row['cate_name'];?></option>
          <?php endwhile;?>
          </select>
          <select name="state" class="form-control input-sm">
            <option value="0" <?php echo $state==0?"selected":"";?>>所有状态</option>
            <option value="2" <?php echo $state==2?"selected":"";?>>草稿</option>
            <option value="1" <?php echo $state==1?"selected":"";?>>已发布</option>
          </select>
          <input type="submit" class="btn btn-default btn-sm" value="筛选"/>
        </form>
<?php
// 计算总条数
$sql = "select count(post_id) num from ali_post p 
join ali_user u on p.post_author=u.user_id 
join ali_cate c on p.post_cateid=c.cate_id
where $where";
$count_res = mysql_query($sql);
// 返回的是一个一维数组
$count = mysql_fetch_assoc($count_res);
// print_r($count) ;
// 总条数
$count_num = $count['num'];
// 总页数
$pages = ceil($count_num/$pagesize);
// 上一页
$prev = $pageno - 1;
$next = $pageno + 1;
// 每页显示的长度
$len = 5;
// 特殊页
$special = ($len - 1)/2;
// 控制上一页和下一页不会继续相加或相减
if($next>$pages){
  $next=$pages;
}
if($prev<=1){
  $prev = 1;
}
?>
        <ul class="pagination pagination-sm pull-right">
          <li><a href="posts.php?pageno=1&cate=<?=$cate?>&state<?=$state?>">首页</a></li>
          <li><a href="posts.php?pageno=<?=$prev?>&cate=<?=$cate?>&state<?=$state?>">上一页</a></li>
<?php
// 判断如果总页数小于每页的长度那么显示总页数
  if($pages <= $len){
    for($i = 1;$i <= $pages;$i++){
      echo "<li><a href='posts.php?pageno=$i&cate=$cate&state=$state'>$i</a></li>";
    }
  }else{
    // 如果不小于总页数,判断是否小于特殊页,小于特殊页或大于特殊页都是一样的显示样式
    if($pageno <= $special){
      for($i = 1;$i <= $len;$i++){
        echo "<li><a href='posts.php?pageno=$i&cate=$cate&state=$state'>$i</a></li>";
      }
    }else if($pageno >= $pages-$special+1){
      for($i = $pages-$len+1;$i<=$pages;$i++){
        echo "<li><a href='posts.php?pageno=$i&cate=$cate&state=$state'>$i</a></li>";
      }
      // 如果在中间的页数,显示当前页的前两个和后两个
    }else{
      for($i = $pageno - $special;$i <= $pageno + $special;$i++){
        echo "<li><a href='posts.php?pageno=$i&cate=$cate&state=$state'>$i</a></li>";
      }
    }
  }
?>
          <li><a href="posts.php?pageno=<?=$next?>&cate=<?=$cate?>&state<?=$state?>">下一页</a></li>
          <li><a href="posts.php?pageno=<?=$pages?>&cate=<?=$cate?>&state<?=$state?>">尾页</a></li>
        </ul>
      </div>
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th class="text-center" width="40"><input type="checkbox"></th>
            <th>标题</th>
            <th>作者</th>
            <th>分类</th>
            <th class="text-center">发表时间</th>
            <th class="text-center">状态</th>
            <th class="text-center" width="100">操作</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = mysql_fetch_assoc($res)):?>
          <tr>
            <td class="text-center"><input type="checkbox"></td>
            <td><?=$row['post_title'];?></td>
            <td><?=$row['user_nickname'];?></td>
            <td><?=$row['cate_name'];?></td>
            <td class="text-center"><?=date('Y/m/d',$row['post_addtime']);?></td>
            <td class="text-center"><?=$row['post_state'];?></td>
            <td class="text-center">
              <a href="editpost.php?id=<?=$row['post_id'];?>" class="btn btn-default btn-xs">编辑</a>
              <a href="javascript:;" data="<?=$row['post_id'];?>" class="btn btn-danger btn-xs delect">删除</a>
            </td>
          </tr>
        <?php endwhile;?>
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
    $(".delect").click(function(){    
      var id = $(this).attr('data');
      var that = $(this);
      $.post('delect.php',{id:id},function(msg){
        if(msg==1){
          alert('删除成功');
          that.parent().parent().remove();
        }else{
          alert('删除失败');
        }
      })
    });
  </script>
</body>
</html>
