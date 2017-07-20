
<?php 
include('../../controller/user/acl.php');
include('../../../model/sql_connect.php');
$cate_sql="SELECT  id,title from category where status =1";


$res=mysqli_query($link,$cate_sql);

if($_GET){
	$id=$_GET['id'];
	$article_sql="SELECT * from article where id={$id}";
	$arres=mysqli_query($link,$article_sql);
	$result=mysqli_fetch_assoc($arres);
}

?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>后台管理</title>
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
            <div class="crumb-list"><i class="icon-font"></i><a href="./index.php">首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="/jscss/admin/design/">作品管理</a><span class="crumb-step">&gt;</span><span>新增作品</span></div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
                <form action="../../controller/article/update.php" method="post" id="myform" name="myform" enctype="multipart/form-data">
                    <table class="insert-tab" width="100%">
                        <tbody><tr>
                            <th width="120"><i class="require-red">*</i>分类：</th>
                            <td>
                                <select name="category_id" id="catid" class="required">
                                    <!-- <option value="">请选择</option>
 -->                                    <?php while(list($id,$title)=mysqli_fetch_row($res)){?>
                                    <option value="<?php echo $id;?>"><?php echo $title;?></option>
                                    <?php }?>
                                </select>
                            </td>
                        </tr>
                            <tr>
                                <th><i class="require-red">*</i>标题：</th>
                                <td>
                                    <input class="common-text required" id="title" name="title" size="50" value="<?php echo $result['title']?>" type="text">
                                </td>
                            </tr>
                            <tr>
                                <th><i class="require-red">*</i>排序</th>
                                <td>
                                    <input class="common-text required" id="sort" name="sort" size="50" value="<?php echo $result['sort']?>" type="text">
                                    <input type="hidden" name="id" value="<?php echo $result['id']?>">
                                    <input type="hidden" name="oldpic" value="<?php echo $result['cover_img']?>">
                                </td>
                            </tr>
                            
                            <tr>
                                <th><i class="require-red">*</i>封面图：</th>
                                <td><input name="cover_img" id="" type="file"><!--<input type="submit" onclick="submitForm('/jscss/admin/design/upload')" value="上传图片"/>-->
                                <img width="50px" height="50px" src="../../../web/upload/<?php echo $result['cover_img']?>">
                                </td>
                            </tr>
                            <tr>
                                <th>内容：</th>
                                <td><textarea name="body" value="" class="common-textarea" id="body" cols="30" style="width: 98%;" rows="10"><?php echo $result['body']?></textarea></td>
                            </tr>
                            <tr>
                                <th>发布</th>
                                <td>
                                <select name="status" id="catid" class="required">
                                    <option value="1">发布</option>
                                    <option value="0">草稿</option>
                                </select>
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