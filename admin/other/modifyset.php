<?php

/**
 * @Author: sks
 * @Date:   2017-11-07 11:19:29
 * @Last Modified by:   sks
 * @Last Modified time: 2017-11-07 11:58:16
 */
// 接收数据
$site_logo = $_POST['site_logo'];
$site_name = $_POST['site_name'];
$site_desc = $_POST['site_desc'];
$site_key = $_POST['site_key'];
$site_start = $_POST['site_start'];
$site_sh = $_POST['site_sh'];
// 连接数据库
include_once '../include/mysql.php';
// 接收图片数据
if($_FILES['site_logo']['error']==0){
	
}
// 写入文件
// 以写入的方式打开文件
$str = "<?php  
return array(
	'site_logo' => 'timg.jpg',
	'site_name' => '阿里百秀',
	'site_desc' => '我的第一个项目',
	'site_key' => 'php,js',
	'cmt_start'=> 1,
	'cmt_sh' => 1
);";
$fd = fopen('set.conf.php','w');
fwrite($fd, $str);