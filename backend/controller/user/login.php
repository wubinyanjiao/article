<?php
header("Content-type:text/html;charset=utf-8");
session_start();
include("../../../model/sql_connect.php");
if($_POST){

	$user=$_POST;

		if(empty($user['username'])||empty($user['pwd'])){
		echo "<script>alert('登录名和密码不能为空')</script>";
		echo "<script>window.history.back()</script>";
	}else{
		$user['pwd']=md5($user['pwd']);
		$sql="SELECT * FROM user WHERE username='{$user['username']}' AND pwd = '{$user['pwd']}'";
	
		$res=mysqli_query($link,$sql);
		$master=mysqli_fetch_assoc($res);


		if($master){
			$_SESSION['master']=$master;
			$_SESSION['is_login']=1;
			
			echo "<script>window.location.href='../../views/user/index.php'</script>";
		}else{
			
			echo "<script>alert('登陆失败,请联系管理员开通权限')</script>";
			echo "<script>window.location.href='../../views/user/login.php'</script>";

		}
	}
}
?>