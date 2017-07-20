<?php
//先销毁服务器
session_start();

// session_destroy();
$_SESSION['master']=array();
$_SESSION['is_login']=0;
echo "<script>window.location.href='../../views/user/login.php'</script>";
?>