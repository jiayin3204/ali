<?php

/**
 * @Author: sks
 * @Date:   2017-11-03 16:26:06
 * @Last Modified by:   sks
 * @Last Modified time: 2017-11-03 21:47:01
 */
header("content-type:text/html;charset=utf-8");
// 接收数据

$email = $_POST['email'];
$password = $_POST['password'];
$code = $_POST['code'];
// 连接数据库
include_once 'include/mysql.php';
// 获取系统产生的验证码
session_start();
$code_sys = $_SESSION['code'];
// 将系统的验证码和传入的验证码进行判断
if(strtoupper($code)!=strtoupper($code_sys)){
	echo "验证码不正确";
	header("refresh:2;url=login.html");
	die;
}
// 编写SQL语句
$sql = "select * from ali_user where user_email = '$email'";
$res = mysql_query($sql);
$userInfo = mysql_fetch_assoc($res);
// print_r($userInfo);die;
// 验证用户名是否正确
if(empty($userInfo)){
	echo "用户名不正确";
	header('refresh:2;url=login.html');
	die;
}else{
	// 验证密码是否正确
	if($userInfo['user_pwd']==md5($password)){
		// 将数据保存到SESSION中
		$_SESSION['id'] = $userInfo['user_id'];
		$_SESSION['email'] = $userInfo['user_email'];
		$_SESSION['nickname'] = $userInfo['user_nickname'];
		// print_r($_SESSION) ;die;
		echo "登陆成功";
		header('refresh:2;url=index.php');
	}else{
		echo "密码错误";
		header("refresh:2;url=login.html");
		die;
	}
}
