<?php 
header("Content-type:text/html;charset=utf-8");
include("../../../common/helpers.php");
include("../../../model/sql_connect.php");

if($_POST){
	$user=$_POST;
	if($user['pwd']|| $user['repwd']){
		if($user['pwd']==$user['repwd']){
			$user['pwd']=md5($user['pwd']);
		}else{
			echo "<script>alert('密码与确认密码不一致');</script>";
			echo "<script>window.history.back()</script>";
		}
	}
	unset($user['repwd']);
	
}

$user=array_filter($user);
// var_dump(upload($_FILES['pic']));exit;
if($_FILES['pic']['name']){
		$user['pic']=upload($_FILES['pic']);
		$oldpic=$user['oldpic'];
		
}


unset($user['oldpic']);
$id=$user['id'];
unset($user['id']);
$str='';
foreach($user as $key=>$value){
	$str.=$key."='".$value."',";
}
$str=rtrim($str,',');

$updatesql="UPDATE user SET $str WHERE id=$id";
$res=mysqli_query($link,$updatesql);
if($res){
	echo "<script>window.location.href='../../views/user/index.php';</script>";
}else{
	echo "<script>alert('修改失败')</script>";
}


?>