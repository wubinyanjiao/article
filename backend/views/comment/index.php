<?php 
date_default_timezone_set('PRC');
include('../../controller/user/acl.php');
include("../../../model/sql_connect.php");
$sql="SELECT id,title FROM category WHERE status=1";
$res=mysqli_query($link,$sql);
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
            <div class="crumb-list"><i class="icon-font"></i><a href="#">首页</a><span class="crumb-step">&gt;</span><span class="crumb-name">作品管理</span></div>
        </div>
        <div class="search-wrap">
            <div class="search-content">
                <form action="" method="post">
                    <table class="search-tab">
                        <tr>
                            <th width="120">选择分类:</th>
                            <td>
                                <select name="category_id" id="">
                                    <option value="">全部</option>
                                    <?php
                                        while(list($id,$title)=mysqli_fetch_row($res)){
                                    ?>
                                    <option value="<?php echo $id;?>"><?php echo $title ;?></option>
                                    <?php }?>
                                </select>
                            </td>
                            <th width="70">关键字:</th>
                            <td><input class="common-text" placeholder="关键字" name="title" value="<?php echo isset($_REQUEST['title'])?$_REQUEST['title']:''?>" id="" type="text"></td>
                            <td><input class="btn btn-primary btn2"  value="查询" type="submit"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <div class="result-wrap">
            <form name="myform" id="myform" method="post">
                <div class="result-title">
                    <div class="result-list">
                        <a href="./create.php"><i class="icon-font"></i>新增作品</a>
                    </div>
                </div>
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr>
                            <th class="tc" width="5%"><input class="allChoose" name="" type="checkbox"></th>
                            
                            <th>ID</th>
                            <th>审核状态</th>
                            <th>文章</th>
                            <th>发布人</th>
                            <th>评论内容</th>
                            <th>发布时间</th>
                            <?php 
                            if(isset($_SESSION['master']['grade'])&&$_SESSION['master']['grade']==2){
                            ?>
                            <th>操作</th>
                            <?php }?>
                        </tr>
                        <?php
                            $limtsql='';
                            $search=$_REQUEST;
                            if(isset($search['category_id'])&&isset($search['title'])){
                                if(empty($search['category_id'])){
                                    $limtsql=" WHERE a.title like '%{$search['title']}%' or a.body like '%{$search['title']}%' ";
                                }else{
                                     $limtsql=" WHERE a.category_id = {$search['category_id']} and (a.title like '%{$search['title']}%' or a.body like '%{$search['title']}%')";
                                }
                            }

                            $sqlcount="select count(id) count from comment a";
                            
                            $res_count=mysqli_query($link,$sqlcount);
                            $count=mysqli_fetch_assoc($res_count);
                            //总共条数
                            $totalcount=$count['count'];
                            //每页显示数量
                            $pagelimit=5;
                            
                            //总共显示多少页
                            $pagecount=ceil($totalcount/$pagelimit);
                            $page=1;
                            if($_GET){
                                $page=$_GET['page'];
                                if($page<0 || $page>$pagecount){
                                    $page=1;
                                }
                            }
                            //设置每页从第几条开始
                            $page_start=($page-1)*$pagelimit;

                            $str_limit=$page_start.','.$pagelimit;
                            

                            
                            
                            $sql="SELECT c.id,c.body,c.user_id,c.article_id,c.create_at,c.status,a.title as 'aritice_title' from comment c left join article a on c.article_id=a.id  limit {$str_limit}";
                            
                            $res=mysqli_query($link,$sql);
                            while(list($id,$body,$user_id,$article_id,$create_at,$status,$title)=mysqli_fetch_row($res)){
                        ?>
                        <tr>
                            <td class="tc"><input name="id[]" value="58" type="checkbox"></td>
                           
                            <td><?php echo $id?></td>
                            <td><?php echo $status?'开启':'关闭'?></td>
                            <td title=""><a target="_blank" href="#" title=""><?php echo $title; ?></a>
                            </td>
                             <td><?php echo $user_id?></td>
                            
                            
                            <td><?php echo $body;?></td>
                            <td><?php echo date('Y-m-d H:m:s',$create_at)?></td>
                      <?php 
                            if(isset($_SESSION['master']['grade'])&&$_SESSION['master']['grade']==2){
                            ?>
                            <td>
                                <a class="link-update" name="category_id" href="./update.php?id=<?php echo $id?>">修改</a>
                                <a class="link-del" name="id"  href="../../controller/comment/delete.php?id=<?php echo $id;?>">删除</a>
                                 <a class="link-del" name="id"  href="./replay.php?id=<?php echo $id;?>&article_id=<?php echo $article_id;?>">回复</a>
                            </td>
                            <?php }?>
                        </tr>
                        <?php }?>
                    </table>
                    <div class="list-page"> 
                    <?php
                        if(isset($search['title'])&&isset($search['title'])){
                            $vars="&title={$search['title']}&category_id={$search['category_id']}";
                        }else{
                            $vars='';
                        }
                        
                        // var_dump($vars);
                        //显示当前活动页前2页
                        if(($page-$pagelimit)>0){
                            $start=$page-$pagelimit;
                        }else{
                            $start=1;
                        }
                        if($page+$pagelimit<$pagecount){
                            $end=$page+4;
                        }else{
                            $end=$pagecount+1;
                        }
                        
                        if($start!=1){
                            echo "<a href='?page=1{$vars}'>首页</a>";
                        }
                        
                        for($i=$start;$i<$page;$i++){
                            echo "<a href='?page={$i}{$vars}'>{$i}</a>";
                        }
                       
                        echo "<a href='?page=1{$vars}' style='color:red' >{$page}</a>";
                        for($i=$page+1;$i<$end;$i++){
                            echo "<a href='?page={$i}{$vars}'>{$i}</a>";
                        }
                        if($end==($pagecount-1)){
                            echo "<a href='?page={$pagecount}{$vars}'>尾页</a>";
                        }

                        
                    ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--/main-->
</div>
</body>
</html>