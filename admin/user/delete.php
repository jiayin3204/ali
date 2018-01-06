<?php

/**
 * @Author: sks
 * @Date:   2017-11-02 20:46:35
 * @Last Modified by:   sks
 * @Last Modified time: 2017-11-02 20:49:43
 */
// 接收数据
$id = $_POST['id'];
// 连接服务器
include_once '../include/mysql.php';
// 构建SQL语句
$sql = "delete from ali_user where user_id=$id";
$res = mysql_query($sql);
// 根据结果集返回前台结果
if($res){
	echo 1;
}else{
	echo 2;
}