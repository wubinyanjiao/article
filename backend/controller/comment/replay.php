<?php 
header("Content-type:text/html;charset=utf-8");
include('../../../model/sql_connect.php');
session_start();

if($_POST){
	$replay=$_POST;
	$replay['user_id']=$_SESSION['master']['id'];
	$replay['create_at']=time();
	$replay=array_filter($replay);
	$relplay_keys=array_keys($replay);
	$relplay_keys=implode(",",$relplay_keys);
	$relplay_vals="'".implode("','",$replay)."'";
	$sql="INSERT into reply({$relplay_keys}) values ({$relplay_vals}) ";
	$res=mysqli_query($link,$sql);
	if($res){
		echo "<script>window.location.href='../../views/comment/index.php'</script>";
	}else{
		echo"<script>alert('回复失败')</script>";
		echo "<script>window.history.back()</script>";
	}
}
?>