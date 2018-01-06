<?php

/**
 * @Author: sks
 * @Date:   2017-11-04 21:00:45
 * @Last Modified by:   sks
 * @Last Modified time: 2017-11-04 21:09:47
 */
header("content-type:text/html;charset=ut8");
$id = $_POST['id'];
// 连接数据库
include_once '../include/mysql.php';
// 构建SQL语句
$sql = "delete from ali_post where post_id=$id";
$res = mysql_query($sql);
if($res){
	echo 1;
}else{
	echo 2;
}