<?php
header("Content-type:text/html;charset=utf-8");
include('../../../common/helpers.php');
include('../../../model/sql_connect.php');

$img=upload($_FILES['cover_img']);

if($_POST){
	$article=$_POST;
	if($img){
		$article['cover_img']=$img;
	}
	$article['create_at']=time();
	$article['update_at']=time();
	if(empty($article['title'])||empty($article['body'])||empty($article['category_id'])){
		echo "<script>alert('题目或者分类或者内容不能为空')</script>";
		echo "<script>window.history.back()</script>";
	}

	$article=array_filter($article);
	$keys=array_keys($article);

	$str_keys=implode(',',$keys);
	$str_vals="'".implode("','", $article)."'";
	
	$sql="INSERT into article({$str_keys}) value ({$str_vals})";
	$res=mysqli_query($link,$sql);

	if($res){
		echo "<script>window.location.href='../../views/article/index.php'</script>";
	}else{
		echo "<script>alert('添加失败')</script>";
		echo "<script>window.history.back()</script>";
	}
}


?>