<?php

/**
 * @Author: sks
 * @Date:   2017-11-02 11:05:42
 * @Last Modified by:   sks
 * @Last Modified time: 2017-11-02 14:18:27
 */
header("content-type:text/html;charset=utf8");
// 接收数据
$name = $_POST['name'];
$slug = $_POST['slug'];
$icon = $_POST['icon'];
$state = $_POST['state'];
$show = $_POST['show'];
$id = $_POST['id'];
// 连接服务器
include_once '../include/mysql.php';
// 构建SQL语句
$sql = "update ali_cate set cate_name='$name',cate_slug='$slug',cate_class='$icon',cate_state=$state,cate_show=$show where cate_id = $id";
$res = mysql_query($sql);
if($res){
	echo "修改成功";
	header('refresh:2;url=categories.php');
}else{
	echo "修改失败";
	header('refresh:2;url=editcate.php?id='.$id);
}