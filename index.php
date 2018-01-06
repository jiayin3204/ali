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
    <?php include_once 'left.php';?>
    <div class="content">
      <div class="swipe">
<?php 
include_once 'admin/include/mysql.php';
$sql = "select * from ali_pic";
$res = mysql_query($sql);
?>
        <ul class="swipe-wrapper">
          <?php while($row = mysql_fetch_assoc($res)):?>
          <li>
            <a href="<?=$row['pic_link'];?>">
              <img src="/admin/uploads/<?=$row['pic_path'];?>">
              <span><?=$row['pic_title'];?></span>
            </a>
          </li>
        <?php endwhile;?>
        </ul>
        <p class="cursor"><span class="active"></span><span></span><span></span><span></span></p>
        <a href="javascript:;" class="arrow prev"><i class="fa fa-chevron-left"></i></a>
        <a href="javascript:;" class="arrow next"><i class="fa fa-chevron-right"></i></a>
      </div>
      <div class="panel focus">
        <h3>焦点关注</h3>
<?php 
// 在POST表中增加一个字段,记录是否焦点,
// 查找条件  post_fo是1并且图片路径不能为空  并且按照添加时间降序排列
// 按照降序排列  可以得到最新的焦点
$sql = "select * from ali_post where post_fo=1 and post_file!='' order by post_addtime
desc limit 0,5";
$post_res = mysql_query($sql);
$num = 0;
?>
        <ul>
      <?php while($row = mysql_fetch_assoc($post_res)):?>
        <?php if($num==0):?>
          <li class="large">
        <?php else:?>
          <li>
        <?php endif;?>
            <a href="detail.php?id=<?=$row['post_id'];?>">
              <img src="/admin/uploads/<?=$row['post_file'];?>" alt="">
              <span><?=$row['post_title'];?></span>
            </a>
          </li>
      <?php $num++; endwhile;?>
        </ul>      
      </div>
      <div class="panel top">
        <h3>一周热门排行</h3>
        <ol>
          <li>
            <i>1</i>
            <a href="javascript:;">你敢骑吗？全球第一辆全功能3D打印摩托车亮相</a>
            <a href="javascript:;" class="like">赞(964)</a>
            <span>阅读 (18206)</span>
          </li>
          <li>
            <i>2</i>
            <a href="javascript:;">又现酒窝夹笔盖新技能 城里人是不让人活了！</a>
            <a href="javascript:;" class="like">赞(964)</a>
            <span class="">阅读 (18206)</span>
          </li>
          <li>
            <i>3</i>
            <a href="javascript:;">实在太邪恶！照亮妹纸绝对领域与私处</a>
            <a href="javascript:;" class="like">赞(964)</a>
            <span>阅读 (18206)</span>
          </li>
          <li>
            <i>4</i>
            <a href="javascript:;">没有任何防护措施的摄影师在水下拍到了这些画面</a>
            <a href="javascript:;" class="like">赞(964)</a>
            <span>阅读 (18206)</span>
          </li>
          <li>
            <i>5</i>
            <a href="javascript:;">废灯泡的14种玩法 妹子见了都会心动</a>
            <a href="javascript:;" class="like">赞(964)</a>
            <span>阅读 (18206)</span>
          </li>
        </ol>
      </div>
      <div class="panel hots">
        <h3>热门推荐</h3>
    <?php 
    $sql = "select * from ali_post order by post_click desc limit 0,4";
    $click_res = mysql_query($sql);
    ?>
        <ul>
        <?php while($row = mysql_fetch_assoc($click_res)):?>
          <li>
            <a href="javascript:;">
              <img src="<?=$row['post_file'];?>" alt="">
              <span><?=$row['post_title'];?></span>
            </a>
          </li>
        <?php endwhile;?>
        </ul>
      </div>
      <div class="panel new">
        <h3>最新发布</h3>
  <?php 
    $sql = "select cate_name,post_title,user_nickname,post_addtime,post_desc,post_click,
      post_good,post_file,num
    from ali_post p
    left join ali_cate c on p.post_cateid=c.cate_id 
    left join ali_user u on p.post_author = u.user_id
    left join (select cmt_postid,count(*) num from ali_comment group by cmt_postid) t on
    p.post_id = t.cmt_postid limit 0,3";
    $time_res = mysql_query($sql);
  ?>
  <?php while($row = mysql_fetch_assoc($time_res)):?>
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
  <script src="assets/vendors/jquery/jquery.js"></script>
  <script src="assets/vendors/swipe/swipe.js"></script>
  <script>
    //
    var swiper = Swipe(document.querySelector('.swipe'), {
      auto: 3000,
      transitionEnd: function (index) {
        // index++;

        $('.cursor span').eq(index).addClass('active').siblings('.active').removeClass('active');
      }
    });

    // 上/下一张
    $('.swipe .arrow').on('click', function () {
      var _this = $(this);

      if(_this.is('.prev')) {
        swiper.prev();
      } else if(_this.is('.next')) {
        swiper.next();
      }
    })
  </script>
</body>
</html>
