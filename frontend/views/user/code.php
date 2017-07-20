<?php
session_start();
function code($w=150,$h=60,$n=4){
	$img=imagecreatetruecolor($w,$h);
	$color=imagecolorallocate($img,rand(128,255),rand(128,255),rand(128,255));
	imagefill($img,0,0,$color);
	//添加干扰点
	for($i=0;$i<100;$i++){
		$x=rand(0,$w);
		$y=rand(0,$h);
		$color=imagecolorallocate($img,rand(0,255),rand(0,255),rand(0,255));
		imagesetpixel($img,$x,$y,$color); 
	}
	//添加干扰线
	for($i=0;$i<10;$i++){
		$starx=rand(0,$w);
		$stary=rand(0,$h);
		$endx=rand(0,$w);
		$endy=rand(0,$h);
		$color=imagecolorallocate($img,rand(0,255),rand(0,255),rand(0,255));
		imageline($img,$starx,$stary,$endx,$endy,$color);
	}
	//验证码内容
	$str="123456789abcdefghijklmnopqrstuvwxyzaABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$len=strlen($str);

	$code="";
	for($i=0;$i<$n;$i++){
		$index=rand(0,$len-1);
		$code.=$str[$index];
	}

		
	$_SESSION['security_code']=strtolower($code);

	
	$fontsize=ceil(($w-40)/$n);
	$x=rand(0,70);
	$y=ceil($h/2+$fontsize/2);
	$color=imagecolorallocate($img,rand(0,255),rand(0,255),rand(0,255));
	imagettftext($img, $fontsize, rand(0,10), $x, $y, $color, '1.ttf', $code);
	header("Content-type:image/jpeg");
	imagejpeg($img);
	imagedestroy($img);
}
code();
