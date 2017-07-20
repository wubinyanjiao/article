<?php 
include('../../controller/user/acl.php');
include("../../../model/sql_connect.php");

if($_GET){
    $comment=$_GET;
    
    $sql="select * from comment where id='{$comment['id']}'";
    $sql2="select id,article_id,user_id,body,status from comment where status=1";
    $res=mysqli_query($link,$sql);
    $res2=mysqli_query($link,$sql2);
    $result=mysqli_fetch_assoc($res);
   
}
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>修改评论</title>
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
                <form action="../../controller/comment/update.php" method="post" id="myform" name="myform" enctype="multipart/form-data">
                    <table class="insert-tab" width="100%">
                        <tbody>
                            <tr>
                                <th><i class="require-red" value="">*</i>所属文章</th>
                                <td>
                                    <input class="common-text required" id="article_id" name="article_id" size="50" value="<?php echo $result['article_id'];?>" type="text" disabled>
                                </td>
                            </tr>
                            <tr>
                                <th>状态：</th>
                                 <td>
                                <select name="status" id="parent_id" class="required">
                                    
                                    <option value="1">开启</option>
                                    <option value="0">关闭</option>
                                </select>
                            </td>
                            </tr>
                            <tr>
                                <th>发布者</th>
                                <td><input class="common-text" name="user_id" size="50" value="<?php echo $result['user_id']?>" type="text" disabled="true"></td>
                                <td><input type="hidden" name='id' value="<?php echo $result['id'] ?>"></td>
                            </tr>
                             <tr>
                                <th>内容：</th>
                                <td><textarea name="body" value="" class="common-textarea" id="body" cols="30" style="width: 98%;" rows="10"><?php echo $result['body']?></textarea></td>
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