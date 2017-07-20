<?php
include('../../../model/sql_connect.php');
$sqlside="SELECT id ,title from article ";
$resside=mysqli_query($link,$sqlside);
?>
<div class="article-left">
	<div class="side-contailer" style="">
		<!-- 热门文章 -->
		<div class="sidewa">
			<div class="litt-head">
				<a>热门文章，热门文章</a>
			</div>
			<?php while(list($id,$title)=mysqli_fetch_row($resside)){ ?>
			<div class="side-box">
				<ul> 
					
					<li ><a href="../article/view.php?id=<?php echo $id?>"> <?php echo substr($title, 0,40)  ;?></a></li>
				</ul>
			</div>
			<?php }?>
			
		</div>
	</div>
</div>
				
