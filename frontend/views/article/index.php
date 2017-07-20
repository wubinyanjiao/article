<!DOCTYPE html>
<?php 
include('../../../model/sql_connect.php');

?>
<html>
	<head>
		<meta charset="utf-8">
		<title>新闻资讯首页</title>
		<link rel="stylesheet" type="text/css" href="../../../web/css/style.css" />
		 <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
	    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
	    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
	<div class="page">
		<?php include('../common/base.php');?>

		<div class="main" style="padding-top:20px">
			<!-- 左侧新闻列表栏 -->
			<div class="article-list">
				<div class="article_container">
					<ul>
					<?php
					
					$search=$_REQUEST;
					$limtsql="";
                    if(isset($search['keywords'])&&!empty($search['keywords'])){
                            $limtsql=" WHERE a.title like '%{$search['keywords']}%' or a.body like '%{$search['keywords']}%' ";
                    }
					$page =1;
					$str_cate="";
					if($_GET){
						if(isset($_GET['category_id'])&&!empty($_GET['category_id'])){
							$category_id=$_GET['category_id'];
							$str_cate=" where category_id={$_GET['category_id']}";
						}if(isset($_GET['page'])){
							$page=$_GET['page'];
						}
						
					}
					$sqlcount="SELECT count(id) count FROM article a ".$str_cate.$limtsql; 
					// var_dump($sqlcount);
				
					$count_res=mysqli_query($link,$sqlcount);
					$totalCount=mysqli_fetch_assoc($count_res);
					$totalCount=$totalCount['count'];
					$page_limit=3;
					//设置当前页,默认第一页
					
					//总共多少页
					$totalPage=ceil($totalCount/$page_limit);
					
					

					//每页的起点；
					$page_start=($page-1)*$page_limit;


					$str_limit=$page_start.",".$page_limit;
					

					$sql="SELECT a.id,a.title,a.category_id,a.body,a.page_view,a.author_id,a.create_at,c.title as 'category_title'  from article a left join category c on a.category_id=c.id".$str_cate.$limtsql." limit {$str_limit}";

					$res=mysqli_query($link,$sql);

					while(list($id,$title,$category_id,$body,$page_view,$author_id,$create_at,$category_title)=mysqli_fetch_row($res)){
					?>
						<li>
							<ul class="single-article" style="">
								<li class="circle">
									<div><a style="text-decoration:none;">08/09</a></div>
								</li>
								<li class="article-head">
									<div class="category"> 
									
										<a  style="text-decoration:none;"><?php echo $category_title;?></a>
									</div>
									<div class="title">
										<a href="./view.php?id=<?php echo $id?>" style="text-decoration:none;"><strong><?php echo $title?></strong></a>
									</div>
								</li>
								<li >
									<div class="content">
										<a href="./view.php?id=<?php echo $id?>" style="text-decoration:none;"><?php echo substr($body,0,400)."......";?>
										</a>
									</div>
								</li>
							</ul>
						</li>
					<?php }?>		
					</ul>

					<ul class="pagination">
					    
					    
					    <?php
					    	if($page-3>0){
								$start=$page-3;
							}else{
								$start=1;
							}
							if($page+3<$totalPage+1){
								$end=$page+4;
							}else{
								$end=$totalPage+1;
							}
					    ?>
					    <li class=""><a href="?page=1">首页</a></li>
					    <?php
					    	for($i=$start;$i<$page;$i++){
					    		 echo "<li><a href='?page={$i}'>{$i}</a></li>";
					    	}
					    ?>
					    <li class="active"><a href="#"><?php echo $page;?></a></li>
					    <?php
					    	for($i=$page+1;$i<$end;$i++){
					    		 echo "<li><a href='?page={$i}'>{$i}</a></li>";
					    	}
					    ?>
					    <li class=""><a href="?page=<?php echo $totalPage;?>">尾页</a></li>

					</ul>

				</div>
			</div>
			<?php include('../common/sidebar.php');?>
		</div>	
	</div>
	  <footer>
        <div class="containerfooter">
            <p>
                Powered by&nbsp;
                <a href="http://www.edusoho.com/">EduSoho v7.3.3</a>&nbsp;
                &copy;2014-2016 &nbsp;&nbsp;
                <a href="http://www.howzhi.com/">好知网</a>&nbsp;&nbsp;
                <a href="#">课程存档</a>&nbsp;
                课程内容版权均归
                <a href="#">学编程</a>
                所有&nbsp;&nbsp;
                <a href="http://www.miibeian.gov.cn/">京ICP备13042384号</a>
            </p>
        </div>
    </footer>
	</body>
</html>