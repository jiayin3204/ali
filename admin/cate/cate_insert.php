<?php

/**
 * @Author: sks
 * @Date:   2017-10-31 17:24:50
 * @Last Modified by:   sks
 * @Last Modified time: 2017-10-31 18:48:38
 */
header("content-type:text/html;charset=utf-8");
include_once '../include/mysql.php';
// 接收数据
$name = $_POST['name'];
$slug = $_POST['slug'];
$icon = $_POST['icon'];
$state = $_POST['state'];
$show = $_POST['show'];
// 构建添加的SQL语句
$sql = "insert into ali_cate values
(null,'$name','$slug','$icon',$state,$show)";
$res = mysql_query($sql);
if($res){
	echo '添加成功';
	header('Refresh:2;url=categories.php');
}else{
	echo '添加失败';
	header('Refresh:2;url=cate_deal.php');
}