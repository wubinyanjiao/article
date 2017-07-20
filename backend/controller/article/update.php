<?php
header("Content-type:text/html;charset=utf-8");
include('../../../common/helpers.php');
include('../../../model/sql_connect.php');

if($_POST){
	$article=$_POST;
	if($_FILES['cover_img']['tmp_name']){
		$article['cover_img']=upload($_FILES['cover_img']);
		$oldPic=$article['oldpic'];
	}
	unset($article['oldpic']);
	$id = $article['id'];
	unset($article['id']);

	$str_update='';
	foreach($article as $key =>$value){
		$str_update.=$key."='".$value."',";
	}
	$str_update=rtrim($str_update,',');
	
	$upsql="UPDATE article SET {$str_update} WHERE id={$id}";
	
	$res=mysqli_query($link,$upsql);
	
	if($res){
		echo "<script>alert('修改成功')</script>";
		echo "<script>window.location.href='../../views/article/index.php'</script>";
	}else{
		echo "<script>alert('更新失败')</script>";
		echo "<script>window.history,back();</script>";
	}
}
?>