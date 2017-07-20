<!DOCTYPE html>
<?php 
date_default_timezone_set('PRC');
include('../../../model/sql_connect.php');

if($_GET){
	$sql= "SELECT a.id,a.title,a.body,a.create_at,u.username from article a left join user u on a.author_id =u.id where a.id={$_GET['id']}";
	$res=mysqli_query($link,$sql);
	$result=mysqli_fetch_assoc($res);
	
}


?>
<html>
	<head>
		<meta charset="utf-8">
		<title>新闻资讯首页</title>
		<link rel="stylesheet" type="text/css" href="../../../web/css/style.css" />
		<link rel="stylesheet" type="text/css" href="../../../web/css/common.css" />
		<link rel="stylesheet" type="text/css" href="../../../web/css/main.css" />
		 <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
	    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
	    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
	<div class="page ">
		<?php include('../common/base.php');?>
		<div class="main" style="padding-top:20px">
			<!-- 左侧新闻列表栏 -->
			<div class="article-list">
				<header class="article" >
					<h1 class="article-head" style="font-size: 25px;position: relative;line-height: 1.2em;"><?php echo $result['title']?></h1>
					<section class="post-meta" style="color: #959595;margin: 14px 0 0;text-align: center;">
						<span class="author">
							作者：<?php echo $result['username']?>.<?php echo date('Y-m-d H:m:s',$result['create_at'])?>
						</span>

					</section>
				</header>
				<section class="post-content" style="margin: 30px 0">
					<?php echo $result['body']?>
				</section>
			</div>
			<?php include('../common/sidebar.php');?>
			<div class="article-comment" >
				<div class="com-body" style="">
					<form action="../../controller/article/comment.php" method="post">
						<table class="com-tabl" width="100%" style="">
								<tr>
									<td><textarea name="body" id="body" cols="30" style="width: 98%" rows="5"></textarea></td>
								</tr>
								 <tr>
		                            <td>
		                                <input class="btn btn-primary btn6 mr10" value="提交评论" type="submit">
		                                <input class="" type="hidden" name="article_id" value="<?php echo $_GET['id']?>">
		                            </td>
	                            </tr>
						</table>
					</form>
				</div>
				
				<!-- 评论展示区域 -->
				<div class="title" >
					<span class="name">最新评论</span>
				</div>
				<div class="list">
					<div class="comment-page" >
					<?php
						$sql="SELECT c.id,c.user_id,c.body,u.username FROM comment c left join user u on c.user_id =u.id   WHERE  article_id={$_GET['id']}";
						$res=mysqli_query($link,$sql);
						
						while(list($id,$user_id,$body,$username)=mysqli_fetch_row($res)){
					?>
						<div class="item clearfix" comment-type="item">
							<!-- 头像start -->
							<div class="head">
								<a><img style="border-radius: 25px" src="http://tp1.sinaimg.cn/5724178214/50/1"></a>
							</div>
							<!-- 头像结束 -->
							<!-- 内容开始 -->
							<div class="cont" style="margin:-40px 20px 0 85px;">
								<div class="info" style="margin-bottom: 5px">
									<span class="name"><a style="color: #ff8500"><?php echo $username;?></a></span>
								</div>
								<div class="txt" style="padding: 0 0 5px;line-height: 24px;font-size: 14px;word-wrap: break-word;">
									<?php echo $body;?>
								</div>
								<div class="action" style="height:26px;margin:5px 0 5px 0;font-size: 14px;text-align: left">
								<span class="time"><?php echo date('Y-m-d H:m:s')?></span>
								
								</div>
							</div>
						</div>
						<?php }?>
					</div>
					
				</div>
			</div>
			
		</div>
	</div>
	</body>
</html>