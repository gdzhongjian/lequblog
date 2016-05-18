$(document).ready(function(){
	$(".btn-block").click(function(){
		var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/;
		var email=$("#email").val();
		var password=$("#password").val();
		isok=reg.test(email);
		if(email==""){
			$(".error").html('邮箱不能为空！');
			$("#error").focus();
			return false;
		}else if(password==""){
			$(".error1").html('密码不能为空！');
			$("#password").focus();
			return false;
		}else if(!isok){
			$(".error").html('邮箱格式不正确！');
			return false;
		}else{
			return true;
		}
	});

	//鼠标离开邮箱输入框时
	$("#email").blur(function(){
		//正则验证邮箱
		var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/;
		var email=$("#email").val();
		var url=checkEmail;
		isok=reg.test(email);
		if(email==""){
			$(".error").html('邮箱不能为空！');
		}else if(!isok){
			$(".error").html('邮箱格式不正确！');
		}else{
			$.post(
				url,
				{email:email},
				function(data){
					if (data==0){
						$(".error").html('该邮箱不存在！');
						return false;
					}else{
						$(".error").html('');
					}
				},
				"text"
				);
		}
		
	});

	//鼠标离开密码输入框时
	$("#password").blur(function(){
		var email=$("#email").val();
		var password=$("#password").val();
		var url=checkPassword;
		if(email==""){
			$('.error').html('邮箱不能为空！');
		}else if(password==""){
			$(".error1").html('密码不能为空！');
		}else{
			$.post(
				url, 
				{email:email,password:password},
				function(data){
					if (data==0){
							$(".error1").html('密码不正确！');
							return false;
						}else{
							$(".error1").html('');
						}
				},
				"text");
		}
	});


});