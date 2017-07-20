<?php 
header("Content-type:text/html;charset=utf-8");
include('../../../model/sql_connect.php');
session_start();

if($_POST){
	$user=$_POST;
	if(strtolower($user['code'])!=$_SESSION['security_code']){
		echo"<script>alert('验证码不正确');</script>";
		echo"<script>window.history.back()'</script>";
	}else{
		unset($user['code']);
		$user['pwd']=md5($user['pwd']);
		$user['create_at']=time();
		$sql="SELECT * FROM user WHERE email='{$user['email']}' OR username='{$user['username']}'";
		
		$res=mysqli_query($link,$sql);
		$num=mysqli_fetch_assoc($res);
		// var_dump($num);
		if($num>0){
			echo"<script>alert('该邮箱或用户名已经被使用，请更改后重新注册');</script>";
			echo"<script>window.location.href='../../views/user/login.php'</script>";
		}else{
			unset($user['repwd']);
			$arr_keys=array_keys($user);
			$arr_keys=implode(',',$arr_keys);
			$arr_vals="'".implode("','",$user)."'";
			$insert_sql="INSERT INTO user ({$arr_keys}) values ($arr_vals)";
			$create_res=mysqli_query($link,$insert_sql);
			if($create_res){
				echo "<script>alert('注册用户成功')</script>";
				echo"<script>window.location.href='../../views/user/login.php'</script>";
			}
			else{
				echo "<script>alert('注册用户失败')</script>";
				echo"<script>window.location.href='../../views/user/login.php'</script>";
			}
			 
		}
		}
	
		
}

?>
