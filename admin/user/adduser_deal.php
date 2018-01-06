<?php

/**
 * @Author: sks
 * @Date:   2017-11-02 20:08:35
 * @Last Modified by:   sks
 * @Last Modified time: 2017-11-04 22:00:35
 */
// 接收数据
$email = $_POST['email'];
$slug = $_POST['slug'];
$nickname = $_POST['nickname'];
$password = md5($_POST['password']);
// 连接数据库
include_once '../include/mysql.php';
// 构建SQL语句
$sql = "insert into ali_user values(null, '$email', '$slug', 
'$nickname', '$password', '', 2)";
$res = mysql_query($sql);
// 判断结果
if($res){
	echo 1;
}else{
	echo 2;
}