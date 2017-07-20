function hasClass(obj,cls){
    return obj.className.match(new RegExp('(\\s|^)' + cls + '(\\s|$)'));
}
function addClass(obj,cls){ //给 obj添加class
    if(!this.hasClass(obj,cls)){
        obj.className += " "+cls;
    }
}
function removeClass(obj,cls){ //移除obj对应的class
    if(hasClass(obj,cls)){
        var reg = new RegExp('(\\s|^)' + cls + '(\\s|$)');
        obj.className = obj.className.replace(reg," ");
    }
}
function checkEmail(email){  
    var emailPattern =/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
     
    if(!emailPattern.test(email)){ 
        
    removeClass(ele.email,"borderGreen"); //移除class
    addClass(ele.email,"borderRed"); //增加class
        return false;
    }else{ 
        
        removeClass(ele.email,"borderRed");
        addClass(ele.email,"borderGreen");
        // emailOk=true;
        return true;
    }
}
function checkLoginEmail(email){  
	
    var emailPattern =/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
     
    if(!emailPattern.test(email)){ 
        
    removeClass(ele.login_email,"borderGreen"); //移除class
    addClass(ele.login_email,"borderRed"); //增加class
        return false;
    }else{ 
        
        removeClass(ele.login_email,"borderRed");
        addClass(ele.login_email,"borderGreen");
        // emailOk=true;
        return true;
    }
}

//验证用户名
function checkUsername(username){
	
	var namePattern=/^[a-zA-Z][a-zA-Z0-9]{4,15}$/;
	if(!namePattern.test(username)){
		removeClass(ele.username,"borderGreen"); //移除class
    	addClass(ele.username,"borderRed"); //增加class
        return false;
	}
	else{
		removeClass(ele.username,"borderRed");
	    addClass(ele.username,"borderGreen");
	    

	    return true;
	   	}
}
//验证密码
function checkPwd(pwd){
	var pwdPattern=/^[a-zA-Z]\w{5,17}$/;
	if(pwd=""||!pwdPattern.test(pwd)){
		removeClass(ele.pwd,"borderGreen"); //移除class
    	addClass(ele.pwd,"borderRed"); //增加class
        return false;
	}else{
		removeClass(ele.pwd,"borderRed");
	    addClass(ele.pwd,"borderGreen");
	    // var pwdOk=false;
	    return true;
	}
}
function checkLoginPwd(pwd){
	var pwdPattern=/^[a-zA-Z]\w{5,17}$/;
	if(pwd=""||!pwdPattern.test(pwd)){
		removeClass(ele.login_pwd,"borderGreen"); //移除class
    	addClass(ele.login_pwd,"borderRed"); //增加class
        return false;
	}else{
		removeClass(ele.login_pwd,"borderRed");
	    addClass(ele.login_pwd,"borderGreen");
	    // var pwdOk=false;
	    return true;
	}
}

//验证确认密码
function checkRepwd(pwd,repwd){
	var repwdPattern=/^[a-zA-Z]\w{5,17}/;
	if(pwd==" "||repwd==" "|| pwd!=repwd||!repwdPattern.test(pwd)||!repwdPattern.test(repwd)){
		removeClass(ele.repwd,"borderGreen"); //移除class
    	addClass(ele.repwd,"borderRed"); //增加class
        return false;
	}else{
		removeClass(ele.repwd,"borderRed");
	    addClass(ele.repwd,"borderGreen");
	    return true;
	}
}

var ele={
	email:document.getElementById("email"),
	username:document.getElementById("username"),
	pwd:document.getElementById("pwd"),
	repwd:document.getElementById("repwd"),
	login_email:document.getElementById("login_email"),
	login_pwd:document.getElementById("login_pwd"),
	// code:document.getElementById("code")
};

ele.email.onblur = function(){       
	checkEmail(ele.email.value);

	check();
}
ele.username.onblur=function(){
	checkUsername(ele.username.value);
	check();
}
ele.pwd.onblur=function(){
	checkPwd(ele.pwd.value);
	check();
}
ele.repwd.onblur=function(){
	checkRepwd(ele.pwd.value,ele.repwd.value);
	check();
}
ele.login_email.onblur=function(){
	checkLoginEmail(ele.login_email.value);
	login_check();
}
ele.login_pwd.onblur=function(){
	checkLoginPwd(ele.login_pwd.value);
	login_check();
}
function check(){

	var nameOk=false;
	var emailOk=false;
	var pwdOk=false;
	var repwdOk=false;
	var registerbtn = document.getElementById("register_submit");
	if(checkUsername(ele.username.value)){
		nameOk=true;
	}
	if(checkEmail(ele.email.value)){
		emailOk=true;
	}
	if(checkPwd(ele.pwd.value)){
		pwdOk=true;
	}
	if(checkRepwd(ele.pwd.value,ele.repwd.value)){
		repwdOk=true;
	}
	
	if(nameOk&&emailOk&&pwdOk&&repwdOk){
		
		registerbtn.removeAttribute("disabled");
	}else{
		
		registerbtn.setAttribute("disabled","");
		return false;
	}
}
function login_check(){
	var emailOk=false;
	var pwdOk=false;
	var login_submit=document.getElementById("login_submit");
	if(checkLoginEmail(ele.login_email.value)){
		emailOk=true;
	}
	if(checkLoginPwd(ele.login_pwd.value)){
		pwdOk=true;
	}
	if(emailOk&&pwdOk){
		login_submit.removeAttribute("disabled");
	}else{
		login_submit.setAttribute("disabled","");
		return false;
	}
}