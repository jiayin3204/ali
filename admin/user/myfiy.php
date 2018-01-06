<?php

/**
 * @Author: sks
 * @Date:   2017-11-03 11:09:32
 * @Last Modified by:   sks
 * @Last Modified time: 2017-11-03 19:07:16
 */
$id =$_POST['id'];
$email =$_POST['email'];
$slug =$_POST['slug'];
$pwd =md5($_POST['pwd']);
$nickname =$_POST['nickname'];
include_once '../include/mysql.php';
$sql = "update ali_user set user_email='$email',user_slug='$slug',user_nickname='$nickname',user_pwd = '$pwd' where user_id=$id";
$res = mysql_query($sql);
if($res){
	echo 1;
}else{
	echo 2;
}