<?php 
include('../../controller/user/acl.php');
// include('../../../model/sql_connct.php');
date_default_timezone_set("PRC");
include("../../../model/sql_connect.php");

?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>分类管理</title>
    <link rel="stylesheet" type="text/css" href="../../../web/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="../../../web/css/main.css"/>
    <script type="text/javascript" src="../../web/js/libs/modernizr.min.js"></script>
</head>
<body>
<div class="topbar-wrap white">
    <?php include('.././common/base.php');?>
</div>
<div class="container clearfix">
    <?php include('.././common/sidebar.php');?>
    <!--/sidebar-->
    <div class="main-wrap">

        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="#">首页</a><span class="crumb-step">&gt;</span><span class="crumb-name">分类管理</span></div>
        </div>
        <div class="search-wrap">
            <div class="search-content">
                <form action="" method="post">
                    <table class="search-tab">
                        <tr>
                            <th width="120">上级分类:</th>
                            <?php
                                $sql="select id,title,parent_id from category";
                                $res=mysqli_query($link,$sql);

                            ?>
                            <td>
                                <select name="id" >
                                    <option name='id' value="0">选择上级分类</option>
                                    <?php while(list($id,$title,$parent_id)=mysqli_fetch_row($res)){?>
                                    <option name='id' value="<?php echo $id;?>"><?php echo $title;?></option>
                                    <?php }?>
                                </select>
                            </td>
                            <th name='title' width="70">名称:</th>
                            <td><input class="common-text" placeholder="关键字" name="title" value="" id="" type="text"></td>
                            <td><input class="btn btn-primary btn2" value="查询" type="submit"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>

        <div class="result-wrap">
            <form name="myform" id="myform" method="post">
                <div class="result-title">
                    <div class="result-list">
                        <a href="./create.php"><i class="icon-font"></i>新增分类</a>
                    </div>
                </div>
                
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr>
                            <th class="tc" width="5%"><input class="allChoose" name="" type="checkbox"></th>
                            <th>排序</th>
                            <th>ID</th>
                            <th>分类名</th>
                           <!--  <th>上级分类</th> -->
                            <th>状态</th>
                            <th>创建时间</th>
                            <?php 
                            if(isset($_SESSION['master']['grade'])&&$_SESSION['master']['grade']==2){
                            ?>
                            <th>操作</th>
                            <?php }?>
                        </tr>
                        <?php
                            if($_POST){
                                $category=$_POST;
                                $_SESSION['category_search']=$category;
                                $sqlcount="SELECT count(id) count from category where parent_id = {$_SESSION['category_search']['id']} AND title like '%{$_SESSION['category_search']['title']}%' ";
                               
                            }else{
                                $sqlcount="select count(id) count from category";
                            }

                         
                            $rescount=mysqli_query($link,$sqlcount);
                            //总共条数
                            $totalcount=mysqli_fetch_assoc(($rescount));
                            $totalcount=$totalcount['count'];
                            //每页显示调试
                            $limitpage=5;
                            //共有多少页
                            $page_counts=ceil($totalcount/$limitpage);
                            $page=1;
                            if($_GET){
                                $page=$_GET['page'];
                                if($page<1||$page>$page_counts){
                                    $page=1;
                                }
                            }

                            $pagestart=($page-1)*$limitpage;
                            $limitstr='';
                            $limitstr=$pagestart.','.$limitpage;
                            // var_dump($limitstr);
                            if($_POST){
                                $sql="SELECT id,title,parent_id,status,sort,create_at from category where parent_id = {$_SESSION['category_search']['id']} AND title like '%{$_SESSION['category_search']['title']}%' limit {$limitstr} ";
                            }else{
                                $sql="SELECT id,title,parent_id,status,sort,create_at from category limit {$limitstr} ";
                            }
                            
                             
                            $res=mysqli_query($link,$sql); 
                            while(list($id,$title,$parent_id,$status,$sort,$create_at)=mysqli_fetch_row($res)){
                        ?>
                        <tr>
                            <td class="tc"><input name="id[]" value="59" type="checkbox"></td>
                            <td>
                                <input name="ids[]" value="59" type="hidden">
                                <input class="common-input sort-input" name="ord[]" value="0" type="text">
                            </td>
                            <td><?php echo $id;?></td>
                            <td title=""><a target="_blank" href="#" title=""><?php echo $title?></a> …
                            </td>
                            <!-- <td><?php //echo $parent_id;?></td> -->
                            <td><?php echo $status?"开启":"关闭";?></td>
                     
                            <td><?php echo date('Y-m-d H:m:s',$create_at)?></td>
                   <?php 
                            if(isset($_SESSION['master']['grade'])&&$_SESSION['master']['grade']==2){
                            ?>
                            <td>
                                <a class="link-update" href="./update.php?id=<?php echo $id;?>">修改</a>
                                <a class="link-del" href="../../controller/category/delete.php?id=<?php echo $id?>">删除</a>
                            </td>
                            <?php }?>
                        </tr>
                        <?php }?>
                    </table>
                    <div class="list-page"> 
                    <?php 
                        if($page!=1){
                            echo "<a href='?page=1'>首页</a>";
                        }
                        
                        if($page>2){
                            $start=$page-2;
                        }else{
                            $start=1;
                        }
                        if($page+2<=$page_counts){
                            $end=$page+2;
                        }else{
                            $end=$page_counts;
                        }
                        
                        //显示前2条
                        for($i=$start;$i<$page;$i++){
                            echo "<a href='?page={$i}'>{$i}</a>";
                        }
                        echo "<a style='color:red'>{$page}</a>";
                        //显示后两条
                        for($i=$page+1;$i<$end+1;$i++){
                            echo "<a href='?page={$i}'>{$i}</a>";
                        }
                        
                        if($page!=$page_counts){
                            echo "<a href='?page={$page_counts}'>尾页</a>";
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