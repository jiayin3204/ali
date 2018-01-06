<?php

/**
 * @Author: sks
 * @Date:   2017-11-03 20:09:45
 * @Last Modified by:   sks
 * @Last Modified time: 2017-11-03 20:29:12
 */
// 清除SESSION数据退出登录
header("content-type:text/html;charset=utf-8");
// 开启SESSION数据
session_start();
// 清除SESSION数据
session_destroy();
echo "退出成功";
// 跳转到登录页面
header('refresh:2;url=login.html');
