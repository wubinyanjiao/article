<?php 
header("Content-type:text/html;charset=utf-8");
include('../../../model/sql_connect.php');

if($_POST){
	$category=$_POST;
	
	if(empty($category['title'])){
		echo "<script>alert('分类名不能为空')</script>";
		echo "<script>window.history.back()</script>";
	}
	// $category=array_filter($category);
	$category['create_at']=time();

	$category_keys=array_keys($category);

	$str_keys='';
	$str_vals='';
	$str_keys= implode(',',$category_keys);
	foreach($category as $key => $value){
		$str_vals .="'". $value."',";
	}
	$str_vals=rtrim($str_vals,',');
	
	$sql="INSERT INTO category({$str_keys}) value ({$str_vals})";

	
	$res=mysqli_query($link,$sql);
	if($res){
		echo"<script>window.location.href='../../views/category/index.php'</script>";
	}else{
		echo"<script>alert('添加用户失败')</script>";
		echo "<script>window.history.back()</script>";
	}
}

?>