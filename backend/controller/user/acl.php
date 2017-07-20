<?php
header("Content-type:text/html;charset=utf-8");
session_start();

if($_SESSION['is_login']==0){
	echo "<script>alert('请先登录')</script>";
	echo "<script>window.location.href='../../views/user/login.php'</script>";
}


?>