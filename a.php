<?php

/**
 * @Author: sks
 * @Date:   2017-10-31 19:29:51
 * @Last Modified by:   sks
 * @Last Modified time: 2017-10-31 19:58:34
 */
// header('Access-Control-Allow-Origin:http//www.jiayin.com');
// header('Access-Control-Allow-Method:POST,GET');
$arr = [
'name'=>'啦啦',
'age'=>12
];
// 接收jsonp数据
$fn = $_GET['fn'];
// 组装返回的数组
$str = json_encode($arr);
echo $fn."($str)";
