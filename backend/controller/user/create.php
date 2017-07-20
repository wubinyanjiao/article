<?php
header("Content-type:text/html;charset=utf-8");
include("../../../common/helpers.php");
include("../../../model/sql_connect.php");
if($_POST){
	$user=$_POST;
	
	if($user['pwd']==$user['repwd']){
		$user['pwd']=md5($user['pwd']);
		unset($user['repwd']);
	}
	if($_FILES){
		$user['pic']=upload($_FILES['pic']);
	 }
	 $user['create_at']=time();
	 $user=array_filter($user);
	 $values="'".implode("','",$user)."'";
	/* var_dump($user);
	 var_dump($values);*/
	 $fieds=array_keys($user);
	 $keys=implode(',',$fieds);
	 /*var_dump($fieds);
	 var_dump($keys);exit;*/
	 $sql="SELECT * FROM user WHERE username='{$user['username']}'or email='{$user['email']}' or phone='{$user['phone']}'";
	$result=mysqli_query($link,$sql);
	$num=mysqli_fetch_assoc($result);
	if($num>0){
		echo"<script>alert('该邮箱或用户名已经被使用，请更改后重新登录');window.location.href='../../views/user/create.php'</script>";
	}else{
		$sql2="insert into user(".$keys.") value(".$values.")";
		 
	 	$res=mysqli_query($link,$sql2);
	 	
	 	if($res){
	 		echo "<script>alert(‘注册成功’);</script>";
	 		echo"<script>window.location.href='../../views/user/index.php';</script>";
	 		
	 	}else{
	 		echo "false";
	 		echo"<script>window.location.href='../../views/user/create.php';</script>";
	 	}
	}
	 
	
	 
}

?>