<?php
date_default_timezone_set("PRC");
function upload($file,$path=null,$type=array('image/png','image/jpeg','image/jpg')){
	if(is_uploaded_file($file['tmp_name'])){
		if(!in_array($file['type'],$type)){
			return false;
		}
		if($file['size']>1024*1024*10){
			return false;
		}
		
		//拼接文件名
		$filename=date('YmdHid').rand(999,1000);
		$targ=explode('.', $file['name']);
		$ext=array_pop($targ);
		$filename=$filename.'.'.$ext;
		// var_dump($filename);exit;
		/*判断是否传入文件路径，如果带只传入文件名，则返回文件名，如果传入的文件名带有路径，则将路径和文件名一起返回*/
		if(is_null($path)){
			$path=$_SERVER['DOCUMENT_ROOT'].'/basic3/article/web/upload/';
			// var_dump($path);exit;
			$returnFile=$filename;
		}else{
			$path=rtrim($path,'/').'/';
			$returnFile=$path.$filename;
		}
		// var_dump($path);exit;
		$filePath=$path.$filename;
		if(move_uploaded_file($file['tmp_name'], $filePath)){
			return $returnFile;
		}else{
			return false;
		}
	}
}


































/*
思路：
1，判断上传文件类型是否符合；
2，判断上传文件大小是否超出范围；
3，拼接文件名；
4，拼接文件路径，
   a,如果没有传入路径，path＝绝对路径下的文件夹;只放回文件名
   b,如果传入路径，path=闯入路径，拼接文件名；放回路径加文件名；

*/



function uploads($file,$path=null,$type=array('image/img','image/png','image/jpeg')){
var_dump($file);

	
	if(is_uploaded_file($file['tmp_name'])){
		//判断上传文件类型
		if(!in_array($file['type'],$type)){
			echo "文件类型不对";
			return false;
		}
		//判断上传问价大小
		if($file['size']>1024*1024*10){
			return false;
		}
		//拼接文件名
		$filename=time().rand(1000,9999);
		$arr=explode('.',$file['name']);
		$exr=array_pop($arr);
		$filename=$filename.'.'.$exr;
		// var_dump($filename);
		if(is_null($path)){
			$path=$_SERVER['DOCUMENT_ROOT'].'/basic3/article/web/upload/';
			$returnFile=$filename;
		}else{
			$path=rtrim($path,'/').'/';
			$returnFile=$path.$filename;
		}
		$return_path=$path.$filename;

		if(move_uploaded_file($file['tmp_name'],$return_path)){
			return $returnFile;
		}else{
			return false;
		}

	}


}









?>