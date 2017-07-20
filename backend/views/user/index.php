<?php 
date_default_timezone_set("PRC");
include("../../../model/sql_connect.php");
include('../../controller/user/acl.php');
/*
分页逻辑
获取变量：总条数，每页显示数量（count），
每页显示条数：limit＝10；
总条数＝根据查询获取的count；
共有多少页：pagecount=ceil(count/limit);
当前显示第几页：$page=$_GET['page']; 
每页从第几行到：$sqlmitpage=($page-1)*$limit;

总体思路：根据用户传递的页数，和设定每页显示的条数，来从数据库中去数据；
$sqlindex=select * from user limit(1,10);//

*/

?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>用户列表</title>
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
            <div class="crumb-list"><i class="icon-font"></i><a href="./index.php">首页</a><span class="crumb-step">&gt;</span><span class="./index.php">用户管理</span></div>
        </div>
        <div class="search-wrap">
            <div class="search-content">
                <form action="" method="post">
                    <table class="search-tab">
                        <tr>
                            <th width="120">选择用户级别:</th>
                            <td>
                                <select name="grade" id="grade">
                                    <option value="">全部</option>
                                    <option value="1">普通用户</option>
                                    <option value="2">管理员</option>
                                </select>
                            </td>
                            <th width="70">关键字:</th>
                            <td><input class="common-text" placeholder="关键字" name="username" value="" id="username" type="text"></td>
                            <td><input class="btn btn-primary btn2" name="" value="查询" type="submit"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <div class="result-wrap">
            <form name="myform" id="myform" method="post">
                <div class="result-title">
                    <div class="result-list">
                        <a href="create.php"><i class="icon-font"></i>新增用户</a>
                    
                    </div>
                </div>
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr>
                            <th class="tc" width="5%"><input class="allChoose" name="" type="checkbox"></th>
                            <th>ID</th>
                            <th>用户名</th>
                            <th>邮箱</th>
                            
                            <th>手机号</th>
                            <th>用户权限</th>
                            <th>状态</th>
                            <th>头像</th>
                            <th>创建时间</th>
                            <?php 
                            if(isset($_SESSION['master']['grade'])&&$_SESSION['master']['grade']==2){
                            ?>
                            <th>操作</th>
                            <?php }?>
                        </tr>
                        <?php
                        // var_dump($_POST);exit;
                        /*搜索框*/
                        if($_POST){
                            $_SESSION['search']=$_POST;
                            
                            $limtsql="where username like '%{$_SESSION['search']['username']}%' and grade like '%{$_SESSION['search']['grade']}%'";
                        }
                        else{
                            $limtsql='';
                        }
                        $sql="select count(id)  count from user ".$limtsql;
                        
                        $result=mysqli_query($link,$sql);
                        $count=mysqli_fetch_assoc($result);
                        $count=$count['count'];
                        $limit=4;
                        //获取总页数
                        $page_count=ceil($count/$limit);
                        //获取当前是第几页；
                        if(isset($_GET['page'])){
                            $page=$_GET['page'];
                        }else{
                            $page=1;
                        }
                        if($page<1 || $page>$page_count){
                            $page =1;
                        }
                        
                        //获取每页从第几条读取；
                        $limit_page=($page-1)*$limit.','.$limit;
                        

                        $sql="SELECT id,username,email,phone,status,pic,grade,create_at FROM user ".$limtsql ."limit {$limit_page}";

                       
                        $res=mysqli_query($link,$sql);
                        // echo'<pre>';var_dump(mysqli_fetch_row($res));exit;
                        while(list($id,$username,$email,$phone,$status,$pic,$grade,$create_at)=mysqli_fetch_row($res)){ ?>
                        <tr>
                            <td class="tc"><input name="id[]" value="58" type="checkbox"></td>
                            <td><?php echo $id;?></td>
                            <td title="username"><a target="_blank" href="./view.php?id=<?php echo $id;?>" title="username"><?php echo $username;?></a> …
                            </td>
                            <td><?php echo $email;?></td>
                            <td><?php echo $phone;?></td>
                            <td><?php
                            if($grade==1){
                                echo "会员";
                            }elseif ($grade==2) {
                                echo"管理员";
                            }else{
                                echo "未定义";
                            }

                            ?></td>
                            <td>
                                <img src="../../../web/upload/<?php echo $pic;?>" width="50px" height="50px">
                            </td>
                            
                            <td><?php echo $status?"开启":"禁用";?></td>
                            <td><?php echo date('Y-m-d H:i:s',$create_at);?></td>
                            <?php 
                            if(isset($_SESSION['master']['grade'])&&$_SESSION['master']['grade']==2){
                            ?>
                            <td>
                                <a class="link-update" href="./update.php?id=<?php echo $id;?>">修改</a>
                                <a class="link-del" href="../../controller/user/delete.php?id=<?php echo $id;?>">删除</a>
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
                        
                        $end='';
                        if($page>3){
                            $start=$page-3;
                        }else{
                            $start=1;
                        }
                        if(($page+3)<=$page_count){
                            $end=$page+3;
                        }else{
                            $end=$page_count;
                        }
                        // var_dump($end);
                        //显示前3页
                        for($i=$start;$i<$page;$i++){
                            echo "<a href='?page={$i}'>{$i}</a>";
                        }
                        echo "<a style='color:red'>{$page}</a>";

                        for($i=$page+1;$i<$end+1; $i++){
                            echo "<a href='?page={$i}'>{$i}</a>";
                        }
                        if($page!=$page_count){
                            echo "<a href='?page={$page_count}'>尾页</a>";
                        }
                        
                     ?>
                     </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>