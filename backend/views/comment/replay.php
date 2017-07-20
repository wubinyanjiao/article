<?php 
include('../../controller/user/acl.php');
include("../../../model/sql_connect.php");

if($_GET){
    $comment=$_GET;
 
    $sql="SELECT c.id,c.body,c.article_id,a.title as article_title from comment c left join article a on(c.article_id=a.id) where c.id='{$comment['id']}'";

    $res=mysqli_query($link,$sql);

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
                <form action="../../controller/comment/replay.php" method="post" id="myform" name="myform" enctype="multipart/form-data">
                    <table class="insert-tab" width="100%">
                        <tbody>
                            <tr>
                                <th>所属文章</th>
                                <td>
                                   <?php echo $result['article_title'];?>
                                </td>
                            </tr>
                            <tr>
                                <th>上一级评论</th>
                                <td><?php echo $result['body']?></td>
                                <td><input type="hidden" name='parent_id' value="<?php echo $result['id'] ?>"></td>
                                <td><input type="hidden" name='article_id' value="<?php echo $result['article_id'] ?>"></td>
                            </tr>
                             <tr>
                                <th>回复评论：</th>
                                <td><textarea name="replay_body" value="" class="common-textarea" id="body" cols="30" style="width: 98%;" rows="10"></textarea></td>
                            </tr>
                            <tr>
                                <th></th>
                                <td>
                                    <input class="btn btn-primary btn6 mr10"  value="提交" type="submit">
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