<?php
include('../../../model/sql_connect.php');
if($_GET){
	$id=$_GET['id'];
	$sql="delete from comment where id={$id}";
	$res=mysqli_query($link,$sql);
	if($res){
		echo "<script>window.history.back()</script>";
	}else{
		echo "<script>window.history.back()</script>";
	}
}

?>