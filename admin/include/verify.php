<?php

/**
 * @Author: sks
 * @Date:   2017-11-03 14:59:47
 * @Last Modified by:   sks
 * @Last Modified time: 2017-11-04 08:54:05
 */
header("content-type:image/png");
// 随机产生4个字符
$str = '2345678abcdefjhskmnABCDEFGSJHUIOKMNXBV';
$code = "";
for($i = 0;$i<4;$i++){
	$code.=$str[rand(0,strlen($str-1))];
}
// 将验证码保存到SESSION中
session_start();
$_SESSION['code'] = $code;
// 绘制画布
$img = imagecreatetruecolor(90, 30);
// 绘制画笔
$green = imagecolorallocate($img, 100, 255, 100);
// 填充画布颜色
imagefill($img, 0, 0, $green);
// 绘制字符串的专用函数
for($i = 0;$i<4;$i++){
	imagettftext(
		$img, 
		rand(15,25), 
		rand(-30,30), 
		10 + ($i * 20), 
		25, 
		imagecolorallocate($img, rand(0,255), rand(0,200), rand(0,255)), 
		'tahoma.ttf', 
		$code[$i]
	);
}
// 显示图片
imagepng($img);
// 销毁图片
imagedestroy($img);








// $code = "";
// for($i=0;$i < 4;$i++){
// 	$code .= $str[rand(0,strlen($str - 1))];
// }
// // 将验证码保存到SESSION中
// session_start();
// $_SESSION['code'] = $code;
// // 绘制画布
// $img = imagecreatetruecolor(90,30);
// // 绘制画笔
// $blue = imagecolorallocate($img, 100, 200, 40);
// // 填充画布颜色
// imagefill($img, 0, 0, $blue);
// // 绘制字符串的专用函数
// for($i = 0;$i <4;$i++){
// 	imagettftext(
// 		$img, 
// 		rand(15,25),//字体大小
// 	 	rand(-30,30),  //随机角度
// 	  	10+($i*20),	//每个字符的横坐标
// 	  	25,			//纵坐标
// 	    imagecolorallocate($img, rand(0,255), rand(0,100), rand(0,255)),
// 	    'tahoma.ttf',
// 	    $code[$i]
// 	);
// }
// // 显示图片
// imagepng($img);
// imagedestroy($img);
