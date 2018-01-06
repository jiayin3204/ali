<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>阿里百秀-发现生活，发现美!</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.css">
</head>
<body>
  <div class="wrapper">
    <?php 
    include_once 'left.php';
    // 接收数据
    $id = isset($_GET['id'])?$_GET['id']:1;
    $sql = "select cate_name,post_title,user_nickname,post_addtime,post_desc,post_click,
      post_good,post_file,num
    from ali_post p
    left join ali_cate c on p.post_cateid=c.cate_id 
    left join ali_user u on p.post_author = u.user_id
    left join (select cmt_postid,count(*) num from ali_comment group by cmt_postid) t on
    p.post_id = t.cmt_postid where post_cateid = $id limit 0,3";
    $res = mysql_query($sql);
    $sql = "select cate_name from ali_cate where cate_id = $id";
    $cate_res = mysql_query($sql);
    $cate_info = mysql_fetch_assoc($cate_res);
    ?>
    <div class="content">
      <div class="panel new">
        <h3><?=$cate_info['cate_name'];?></h3>
<?php while($row = mysql_fetch_assoc($res)):?>
        <div class="entry">
          <div class="head">
            <span class="sort"><?=$row['cate_name'];?></span>
            <a href="javascript:;"><?=$row['post_title'];?></a>
          </div>
          <div class="main">
            <p class="info"><?=$row['user_nickname'];?> 发表于 <?=date('Y-m-d',$row['post_addtime']);?></p>
            <p class="brief"><?=$row['post_desc'];?></p>
            <p class="extra">
              <span class="reading">阅读(<?=$row['post_click'];?>)</span>
              <span class="comment">评论(<?=$row['num'];?>)</span>
              <a href="javascript:;" class="like">
                <i class="fa fa-thumbs-up"></i>
                <span>赞(<?=$row['post_good'];?>)</span>
              </a>
              <a href="javascript:;" class="tags">
                分类：<span>星球大战</span>
              </a>
            </p>
            <a href="javascript:;" class="thumb">
              <img src="/admin/uploads/<?=$row['post_file'];?>" alt="">
            </a>
          </div>
        </div>
<?php endwhile;?>
      </div>
    </div>
    <div class="footer">
      <p>© 2016 XIU主题演示 本站主题由 themebetter 提供</p>
    </div>
  </div>
</body>
</html>
