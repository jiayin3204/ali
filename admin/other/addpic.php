<?php

/**
 * @Author: sks
 * @Date:   2017-11-06 22:18:00
 * @Last Modified by:   sks
 * @Last Modified time: 2017-11-06 22:30:06
 */
header("content-type:text/html;charset=utf-8");
// 接收数据
$text = $_POST['text'];
$linkpic = $_POST['link'];
// 接收上传图片
$pash = "";
if($_FILES['image']['error']==0){
	$file = $_FILES['image'];
	$ext = strrchr($file['name'], '.');
	$pash = '../upload/'.time().rand(100,999).$ext;
	move_uploaded_file($file['tmp_name'], $pash);
}else{
	echo "上传图片失败";
	header('refresh:2;url=slides.php');
}
// 连接数据库
include_once '../include/mysql.php';
// 编写SQL语句
$sql = "insert into ali_pic values
(null,'$pash','$text','$linkpic','不显示')";
$res = mysql_query($sql);
if($res){
	echo "修改成功";
}else{
	echo "修改失败";
}
header('refresh:2;url=slides.php');