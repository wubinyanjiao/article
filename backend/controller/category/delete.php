<?php
header("Content-type:text/html;charset=utf-8");
include('../../../model/sql_connect.php');
if($_GET){
	$id=$_GET['id'];
	$sql="delete from category where id={$id}";
	$res=mysqli_query($link,$sql);
	if($res){
		echo "<script>window.history.back()</script>";
	}else{
		echo "<script>window.history.back()</script>";
	}
}

?>