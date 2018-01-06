<?php

/**
 * @Author: sks
 * @Date:   2017-11-03 19:34:29
 * @Last Modified by:   sks
 * @Last Modified time: 2017-11-03 20:24:02
 */
// 跳墙访问

// 检测是否有SESSION数据
session_start();
if(empty($_SESSION['id'])){
    //判断session中是否有id，如果没有则说明是跳墙访问
    echo "请您先登录，再访问当前页面";
    header('Refresh:2;url=../login.html');
    die;
}