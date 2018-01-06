<?php

/**
 * @Author: sks
 * @Date:   2017-11-04 14:32:05
 * @Last Modified by:   sks
 * @Last Modified time: 2017-11-04 15:52:08
 */
header("content-type:text/html;charset=utf-8");
include_once '../checksession.php';
// 接收数据
// 接收上一个页面提交上来的数据
$title = $_POST['title'];
$content = $_POST['content'];
$slug = $_POST['slug'];
$category = $_POST['category'];
// 当前时间
$created = $_POST['created'];
$created = strtotime($created);
$status = $_POST['status'];
// 手动添加的数据
// 作者
$uid = $_SESSION['id'];
$desc = substr($content,0,100);
// 修改时间
$updtime = $created;
$click = rand(300,500);
$good = rand(100,300);
$bad = rand(0,10);
// 文件路径
// 判断是否有错
$file = $_FILES['feature'];
$pash = "";
if($file['error']==0){
	// 保存到本地路径, 设施文件名称
	$ext = strrchr($file['name'],'.');
	$pash = '../upload/'.time().rand(100,999).$ext;
	move_uploaded_file($file['tmp_name'], $pash);
}
// 连接数据库
include_once '../include/mysql.php';
// 编写SQL语句
$sql = "insert into ali_post values
(null,'$title','$slug','$desc','$content','$uid',$category,'$pash','$created',$updtime,$click,$good,$bad,$status)";
// echo $sql;die;
$res = mysql_query($sql);
if($res){
	echo "添加文章成功";
	header('refresh:2;url=posts.php');
}else{
	echo "添加文章失败";
	header('refresh:2;url=addpost.php');
}