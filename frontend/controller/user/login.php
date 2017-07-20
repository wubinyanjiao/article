<?php
header("Content-type:text/html;charset=utf-8");
session_start();

include('../../../model/sql_connect.php');
if($_POST){
	$user=$_POST;
	$user['pwd']=md5($user['pwd']);
	$sql="SELECT * FROM user WHERE email='{$user['email']}' AND pwd='{$user['pwd']}' ";
	
	$res=mysqli_query($link,$sql);
	$result=mysqli_fetch_assoc($res);
	if($result){
		$_SESSION['master']=$result;
		$_SESSION['is_login']=1;
		echo "<script>window.location.href='../../views/article/index.php'</script>";
	}else{
		echo "<script>alert('用户登陆失败，请重新登陆')</script>";
		echo "<script>window.location.href='../../views/user/login.php'</script>";
	}
}
?>