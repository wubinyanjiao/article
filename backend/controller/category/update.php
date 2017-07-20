<?php
header("Content-type:text/html;charset=utf-8");
include('../../../model/sql_connect.php');
if($_POST){
	$category=$_POST;
	$id=$category['id'];
	unset($category['id']);
	
 	$category=array_filter($category);
 	/* var_dump($category);
 	$arr_keys=array_keys($category);
 	var_dump($arr_keys);exit;*/
 	$update_str='';
 	foreach($category as $key=>$value){
 		$update_str.=$key."='".$value."',";
 	}
 	$update_str=rtrim($update_str, ',');
 	// var_dump($update_str);
	$sql="update category set {$update_str} where id={$id}";

	$res=mysqli_query($link,$sql);
	if($res){
		echo "<script>window.location.href='../../views/category/index.php'</script>";
	}else{
		echo"<script>alert('更新失败')</script>";
		echo "<script>window.history.back()</script>";
	}

}

?>