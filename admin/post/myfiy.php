<?php

/**
 * @Author: sks
 * @Date:   2017-11-06 14:27:10
 * @Last Modified by:   sks
 * @Last Modified time: 2017-11-06 20:41:36
 */
// 编辑页面的后台
header("content-type:text/html;charset=utf-8");
 // 接收数据
 $id = $_POST['id'];
 $title = $_POST['title'];
 $content = $_POST['content'];
 $slug = $_POST['slug'];
 // 所属分类
 $category = $_POST['category'];
 $time = time();
 $state = $_POST['status'];
 // 手动补全数据
 //摘要
 $desc = substr($content,0,100);
 // 连接数据库
 include_once '../include/mysql.php';
 $sql = "select post_file from ali_post where post_id = $id";

 $res = mysql_query($sql);
 $arr = mysql_fetch_assoc($res);
 $oldpash = $arr['post_file'];
// 保存图片信息
// 如果error是0说明没有错误,上传成功
if($_FILES['feature']['error']==0){
	$file = $_FILES['feature'];
	$ext = strrchr($file['name'], '.');
	$pash = '../upload/'.time().rand(100,999).$ext;
	move_uploaded_file($file['tmp_name'], $pash);
}else{
	$pash = $oldpash;
}
// 编写SQL语句
$sql = "update ali_post set post_title='$title',post_content='$content',post_desc='$desc',post_slug = '$slug',post_state='$state',post_cateid='$category',post_updtime='$time',post_file='$pash' where post_id = $id";
$res = mysql_query($sql);
if($res){
	echo '修改成功';
	header('refresh:2;url=posts.php');
}else{
	echo '修改失败';
	header('refresh:2;url=editpost.php');
}