<?php 
header("Content-type:text/html;charset=utf-8");
session_start();
// var_dump($_SESSION);
include('../../../model/sql_connect.php');
if($_SESSION['is_login']!=1){

	echo "<script>alert('请先登录')</script>";
	echo "<script>window.history.back()</script>";
}else{
	if($_POST){
		if(empty($_POST['body'])){
			echo "<script>alert('好歹说几句')</script>";
			echo "<script>window.history.back()</script>";
		}
		$comments=$_POST;
		$comments['user_id']=$_SESSION['master']['id'];
		$comments['create_at']=time();
		
		$comments=array_filter($comments);
		$com_keys=array_keys($comments);
		
		$str_keys=implode(",",$com_keys);
		$str_vals="'".implode("','",$comments)."'";
		
		$sql="INSERT into comment({$str_keys}) values({$str_vals})";
		$res=mysqli_query($link,$sql);
		if($res){
			echo "<script>window.history.back()</script>";
		}else{
			echo "<script>alert('评论失败')</script>";
			echo "<script>window.history.back()</script>";
		}
	}
}
?>
