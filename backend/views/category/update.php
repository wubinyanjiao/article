<?php 
include('../../controller/user/acl.php');
include("../../../model/sql_connect.php");

if($_GET){
    $category=$_GET;
    $sql="select * from category where id='{$category['id']}'";
    $sql2="select id,title from category where status=1";
    $res=mysqli_query($link,$sql);
    $res2=mysqli_query($link,$sql2);
    $result=mysqli_fetch_assoc($res);
    
}
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>修改分类</title>
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
            <div class="crumb-list"><i class="icon-font"></i><a href="./index.php">首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="./index.php">分类管理</a><span class="crumb-step">&gt;</span><span>修改分类</span></div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
                <form action="../../controller/category/update.php" method="post" id="myform" name="myform" enctype="multipart/form-data">
                    <table class="insert-tab" width="100%">
                        <tbody><tr>
                            <th width="120"><i class="require-red">*</i>上级分类：</th>
                            <td>
                                <select name="parent_id" id="parent_id" class="required">
                                    <option value="">请选择</option>
                                    <?php while(list($id,$title)=mysqli_fetch_row($res2)){?>
                                    <option value="19"><?php echo $title;?></option>
                                    <?php }?>
                                    
                                </select>
                            </td>
                        </tr>
                            <tr>
                                <th><i class="require-red" value="">*</i>分类题目</th>
                                <td>
                                    <input class="common-text required" id="title" name="title" size="50" value="<?php echo $result['title'];?>" type="text">
                                </td>
                            </tr>
                            <tr>
                                <th>状态：</th>
                                 <td>
                                <select name="status" id="parent_id" class="required">
                                    <option value="">请选择</option>
                                    <option value="1">开启</option>
                                    <option value="0">关闭</option>
                                </select>
                            </td>
                            </tr>
                            <tr>
                                <th>排序：</th>
                                <td><input class="common-text" name="sort" size="50" value="<?php echo $result['sort']?>" type="text"></td>
                                <td><input type="hidden" name='id' value="<?php echo $result['id'] ?>"></td>
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