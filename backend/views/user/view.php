<?php 
include('../../controller/user/acl.php');
$id=$_GET['id'];
date_default_timezone_set("PRC");
include("../../../model/sql_connect.php");
$sql="SELECT * FROM user where id={$id} ";
$res=mysqli_query($link,$sql);
$selresult=mysqli_fetch_assoc($res);
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>更新用户</title>
    <link rel="stylesheet" type="text/css" href="../../../web/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="../../../web/css/main.css"/>
    <script type="text/javascript" src="../../../web/js/libs/modernizr.min.js"></script>
</head>
<body>
<div class="topbar-wrap white">
    <?php include('../common/base.php');?>
</div>
<div class="container clearfix">
    <?php include('../common/sidebar.php');?>
    <!--/sidebar-->
    <div class="main-wrap">

        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="./index.php">首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="./index.php">用户管理</a><span class="crumb-step">&gt;</span><span>用户信息</span></div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
                <form action="../../controller/user/update.php" method="post" id="myform" name="myform" enctype="multipart/form-data">
                    <table class="insert-tab" width="100%">
                        <tbody>
                        <tr>
                                <th>id</th>
                                <td>
                                   
                                     <?php echo $selresult['id'];?>
                                </td>
                                
                            </tr>
                        <tr>
                            <th width="120"><i class="require-red">*</i>权限：</th>
                            <td>
                                <?php 
                                    echo $selresult['grade']=1?'超级管理员':'普通用户';
                                ?>
                            </td>
                        </tr>
                            <tr>
                                <th><i class="require-red">*</i>用户名：</th>
                                <td>
                                    <?php echo $selresult['username']; ?>
                                </td>
                            </tr>
                        
                            <tr>
                                <th><i class="require-red">*</i>手机号</th>
                                 <td>
                                    <?php echo $selresult['phone'];?>
                                </td>
                            </tr>
                            <tr>
                                <th><i class="require-red">*</i>邮箱</th>
                                 <td>
                                    <?php echo $selresult['email'];?>
                                </td>
                            </tr>
                            <tr>
                                <th>状态：</th>
                                <td>
                                   
                                     <?php echo $selresult['status']=1?'开启':'关闭'?>
                                </td>
                                
                            </tr>
                            <tr>
                                <th><i class="require-red">*</i>头像：</th>
                                <td>
                                    <img src="../../../web/upload/<?php echo $selresult['pic'];?>" width="50px" height="50px">
                                </td>
                            </tr>
                        </tbody></table>
                </form>
            </div>
        </div>

    </div>
    <!--/main-->
</div>
</body>
</html>