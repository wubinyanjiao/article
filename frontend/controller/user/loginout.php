<?php
header("Content-type:text/html;charset=utf-8");
session_start();
$_SESSION['master']=array();
$_SESSION['is_login']=0;
echo "<script>window.location.href='../../views/user/login.php'</script>";
?>
