<?php
header("Content-type:text/html;charset=utf-8");
include('../../../model/sql_connect.php');
if($_POST){

	$comment=$_POST;
	$id=$comment['id'];
	unset($comment['id']);
	
 	
 	$arr_keys=array_keys($comment);

 	$update_str='';
 	foreach($comment as $key=>$value){
 		$update_str.=$key."='".$value."',";
 	}
 	$update_str=rtrim($update_str, ',');
 	// var_dump($update_str);
	$sql="update comment set {$update_str} where id={$id}";

	$res=mysqli_query($link,$sql);
	if($res){
		echo "<script>window.location.href='../../views/comment/index.php'</script>";
	}else{
		echo"<script>alert('更新失败')</script>";
		echo "<script>window.history.back()</script>";
	}

}

?>