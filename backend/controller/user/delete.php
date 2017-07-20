<?php
include("../../../model/sql_connect.php");
$id=$_GET['id'];

$delSql="DELETE from user where id={$id}";
$res=mysqli_query($link,$delSql);
if($res){
	echo "<script>window.location.href='../../views/user/index.php'</script>";
}
?>