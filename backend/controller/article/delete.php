<?php
header("Content-type:text/html;charset=utf-8");
include('../../../model/sql_connect.php');

if($_GET){
	$id=$_GET['id'];
	$sql_delete="DELETE FROM article WHERE id= {$id}";
	$res=mysqli_query($link,$sql_delete);
	
	if($res){
		echo "<script>alert('删除成功')</script>";
		echo "<script>window.location.href='../../views/article/index.php'</script>";
	}else{
		echo "<script>alert('删除失败失败')</script>";
		echo "<script>window.history,back();</script>";
	}

}
?>