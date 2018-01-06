<?php

/**
 * @Author: sks
 * @Date:   2017-11-02 10:11:15
 * @Last Modified by:   sks
 * @Last Modified time: 2017-11-02 10:14:58
 */
header("content-type:text/html;charset=utf-8");
include_once "../include/mysql.php";
$id = $_GET['id'];
// 编写SQL语句
$sql = "delete from ali_cate where cate_id=$id";
$res = mysql_query($sql);
// 判断结果集,为true则删除成功
if($res){
	echo "删除成功";
	header("Refresh:2;url=categories.php");
}else{
	echo "删除失败";
	header("Refresh:2;url=categories.php");
}