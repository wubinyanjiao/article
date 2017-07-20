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
            <div class="crumb-list"><i class="icon-font"></i><a href="./index.php">首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="./index.php">用户管理</a><span class="crumb-step">&gt;</span><span>新增用户</span></div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
                <form action="../../controller/user/update.php" method="post" id="myform" name="myform" enctype="multipart/form-data">
                    <table class="insert-tab" width="100%">
                        <tbody><tr>
                            <th width="120"><i class="require-red">*</i>权限：</th>
                            <td>
                                <select name="grade" id="catid" class="required">
                                    <option value="">请选择</option>
                                    <option value="1">会员</option>
                                    <option value="2">管理员</option>
                                    
                                </select>
                            </td>
                        </tr>
                            <tr>
                                <th><i class="require-red">*</i>用户名：</th>
                                <td>
                                    <input class="common-text required" id="username" name="username" size="50" value="<?php echo $selresult['username']; ?>" type="text">
                                </td>
                            </tr>
                        
                            <tr>
                                <th><i class="require-red">*</i>密码:</th>
                                <td>
                                    <input class="common-text required" id="repwd" name="pwd" size="50" value="" type="text">
                                </td>
                            </tr>
                            <tr>
                                <th><i class="require-red">*</i>确认密码</th>
                                 <td>
                                    <input class="common-text required" id="email" name="repwd" size="50" value="" type="text">
                                </td>
                            </tr>
                            <tr>
                                <th><i class="require-red">*</i>手机号</th>
                                 <td>
                                    <input class="common-text required" id="phone" name="phone" size="50" value="<?php echo $selresult['phone'];?>" type="text">
                                </td>
                            </tr>
                            <tr>
                                <th><i class="require-red">*</i>邮箱</th>
                                 <td>
                                    <input class="common-text required" id="email" name="email" size="50" value="<?php echo $selresult['email'];?>" type="text">
                                </td>
                            </tr>
                            <tr>
                                <th>状态：</th>
                                <td>
                                    <input class="common-text" name="status" <?php echo $selresult['status']==1?"checked":" " ?> type="radio"  value="1">开启
                                    <input class="common-text" name="status" type="radio"  <?php echo $selresult['status']==2 ?"checked":" " ?>  value="1">关闭
                                </td>
                                
                            </tr>
                            <tr>
                                <th><i class="require-red">*</i>头像：</th>
                                <td><input name="pic" id="" type="file" value="<>"> 
                                    <img src="../../../web/upload/<?php echo $selresult['pic'];?>" width="50px" height="50px">
                                    <input type="hidden" name="oldpic" value="<?php echo $selresult['pic'];?>">
                                    <input type="hidden" name="id" value="<?php echo $selresult['id'];?>">
                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <td>
                                    <input class="btn btn-primary btn6 mr10" value="提交" type="submit">
                                    <input class="btn btn6" onclick="history.go(-1)" value="返回" type="button">
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