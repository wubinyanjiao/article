<!-- head -->
<?php
// echo '<pre>';
include('../../../model/sql_connect.php');
session_start();
 $sql_cate="SELECT id,title FROM category";

 $res_cate=mysqli_query($link,$sql_cate);
 // $result_cate=mysqli_fetch_row($res_cate);

?>
<header class="es-header">
	<div class="navbar-header">
		
		<nav class="navbar navbar-default">
				  <div class="container-fluid">
				    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				    <!-- <a class="navbar-brand"><img src="../../../web/images/logo.jpg" alt="logo"></a> -->
				      <ul class="nav navbar-nav">
				        <li class="active"><a href="../article/index.php">首页 <span class="sr-only">(current)</span></a></li>
				        <li><a href="#">课程</a></li>
				        <li class="dropdown">
				          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">文章分类 <span class="caret"></span></a>
				          <ul class="dropdown-menu">
				           <li><a href="?category_id=">全部</a></li>
				          <?php while(list($id,$title)=mysqli_fetch_row($res_cate)){?>
				            <li><a href="?category_id=<?php echo $id?>"><?php echo $title;?></a></li>
				            <?php }?>
				          </ul>
				        </li>
				      </ul>
				        <form class="navbar-form navbar-left" action="" method="post">
					        <div class="form-group">
					          <input type="" class="form-control" placeholder="关键字" name="keywords" value="<?php echo isset($_REQUEST['keywords'])?$_REQUEST['keywords']:''?>" id="" type="text">
					        </div>
					        <input type="submit" class="btn btn-default" value="搜索">
					     </form>
					      <ul class="nav navbar-nav navbar-right">
					      <?php 
					      if(isset($_SESSION['is_login'])&&$_SESSION['is_login']==1){
					      ?>
					      <li><a href="#"><?php echo $_SESSION['master']['username'];?></a></li>
					       <li><a href="../../controller/user/loginout.php">退出</a></li>
					      <?php }else{ ?>
					       <li><a href="../user/login.php">登录</a></li>
					         <li><a href="../user/login.php">注册</a></li> 
					         <?php }?>
					      
					      </ul>
				    </div>
				  </div>
				</nav>
	</div>
</header>
<div class="line" style="margin-top: 10px"></div>
