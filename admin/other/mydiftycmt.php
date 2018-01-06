<?php

/**
 * @Author: sks
 * @Date:   2017-11-06 16:47:26
 * @Last Modified by:   sks
 * @Last Modified time: 2017-11-06 18:38:47
 */
// 接收数据
$state = $_POST['state'];
$id = $_POST['id'];
// 连接数据库
include_once '../include/mysql.php';
// 编写修改的SQL语句
$sql = "update ali_comment set cmt_state = '$state' where cmt_id = $id";
$res = mysql_query($sql);
if($res){
	echo 1;
}else{
	echo 2;
}