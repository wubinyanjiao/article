<!DOCTYPE html>
<?php 

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
		 <div class="row" style="margin: 40px auto;background:white;width:550px;padding: 0px ;height: auto">
        <div class="">
          <div class="nav-tabs-custom loginnave">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">登录</a></li>
              <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">注册</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active " id="tab_1">
                <div class="register-form">
   		 		<form action="../../controller/user/login.php" method="post">
   		 			<div class="forms">
   		 				<label class="labels">邮箱</label>
   		 				<input type="text" name="email" placeholder="请输入邮箱" class="form-control" autofocus="auto" id="login_email">
   		 			</div>
   		 			<div class="forms">
   		 				<label class="labels">密码</label>
   		 				<input type="password" name="pwd" placeholder="请输入密码，包涵字母和数字" class="form-control"  id="login_pwd">
   		 			</div>
           
   		 			<div class="forms">
   		 				<input type="submit" class="btn btn-primary" id="login_submit" disabled="true" value=登录 >
   		 			</div>
   		 		</form>
   		 	</div>
      </div>
              <!-- /.tab-pane -->
          <div class="tab-pane " id="tab_2">
            <div class="register-form">
	   		 		<form action="../../controller/user/register.php" method="post">
   		 			<div class="forms">
   		 				<label class="labels">邮箱</label>
   		 				<input type="text" name="email" placeholder="请输入邮箱" class="form-control" autofocus="auto" id="email">
   		 			</div>
   		 			<div class="forms">
   		 				<label class="labels">用户名</label>
   		 				<input type="text" name="username" placeholder="请输入用户名,大于五位数" class="form-control" id="username">
   		 			</div>
   		 			<div class="forms">
   		 				<label class="labels">密码</label>
   		 				<input type="password" name="pwd" placeholder="请输入密码，包涵字母和数字，大于6位数" class="form-control"  id="pwd">
   		 			</div>
                    
   		 			<div class="forms">
   		 				<label class="labels">确认密码</label>
   		 				<input type="password" name="repwd" placeholder="再次输入密码" class="form-control" id="repwd">
   		 			</div>
             <div class="forms">
              <label class="labels">验证码</label>
              <input style="" type="text" name="code" placeholder="请输入验证码" class="form-control"  id="codeinput">
              <img id='code' src='./code.php' />
            </div>
   		 			<div class="forms">
   		 				<input type="submit"  class="btn btn-primary" id="register_submit" disabled="" value="注册用户">
   		 			</div>
   		 		</form>
	   		 	</div>
              </div>
            </div>
          </div>
        </div>
      </div>
	</div>
	</body>
	<script src="../../../web/js/register.js"></script>
    <script type="text/javascript">
    
    var code=document.getElementById("code");
    code.onclick=function(){
      this.src=this.src+"?"+Math.random;
    }
  </script>
</html>