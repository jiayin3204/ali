<?php

/**
 * @Author: sks
 * @Date:   2017-11-06 21:20:32
 * @Last Modified by:   sks
 * @Last Modified time: 2017-11-06 21:41:58
 */
// 接收数据
$str = $_POST['str'];
// 连接数据库
include_once '../include/mysql.php';
// 编写SQL语句
// where cmt_id in 1,2,3   这种写法是执行cmt_id为1,2,3的这三条   这三条中cmt_state是批准的
$sql = "update ali_comment set cmt_state='批准' where cmt_id in ($str)";
$res = mysql_query($sql);
// 查找影响的行数
// 其中数据库中查找的数据如果有cmt_state事骗婚的话就不是被影响的行数
// 会自动筛选哪些是被影响的
$num = mysql_affected_rows($link);
if($num>0){
	echo 1;
}else{
	echo 2;
}