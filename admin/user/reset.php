<?php

/**
 * @Author: sks
 * @Date:   2017-11-03 20:59:50
 * @Last Modified by:   sks
 * @Last Modified time: 2017-11-03 21:59:28
 */
session_start();
header("content-type:text/html;charset=utf-8");
// echo $_SESSION['id'];die;
// 接收数据
$oldpwd = $_POST['oldpwd'];
$newpwd = $_POST['newpwd'];
$newpwds = $_POST['newpwds'];
// 连接数据库
include_once '../include/mysql.php';
// 编写SQL语句  根据当前登录的id查询用户信息
$sql = "select * from ali_user where user_id = ".$_SESSION['id'];
// echo $sql;die;
$res = mysql_query($sql);
// 返回的是一条数据,所以是一维数组
$userInfo = mysql_fetch_assoc($res);
// 判断旧密码是否能匹配
$oldpassword = md5($oldpwd);
if($userInfo['user_pwd'] != $oldpassword){
	echo "密码错误";
	// 密码错误跳转到修改页面
	header('refresh:2;url=password-reset.php');
	die;
}else{
	// 判断两个新密码是否一样
	if($newpwds != $newpwd){
		echo "修改失败";
		header('refresh:2;url=password-reset.php');
		die;
	}else{
		$pwd = md5($newpwd);
		// 成功则构建SQL语句 修改密码
		$sql = "update ali_user set user_pwd='$pwd' where user_id =".$_SESSION['id'];
		// echo $sql;die;
		$res = mysql_query($sql);
		if($res){
			echo "修改成功";
			header('refresh:2;url=profile.php');
			die;
		}else{
			echo "修改失败";
			header('refresh:2;url=password-reset.php');
		}
	}
}
