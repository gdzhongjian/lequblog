$(document).ready(function(){
	$(".btn-block").click(function(){
		var username=$("#username").val();
		var mail=$("#mail").val();
		var pwd=$("#pwd").val();
		var pwd1=$("#pwd1").val();
		var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/;
		isok=reg.test(mail);
		if(username==""){
			$(".error").html('用户名不能为空！');
			$("#username").focus();
			return false;
		}else if(mail==""){
			$(".error1").html('邮箱不能为空！');
			$("#mail").focus();
			return false;
		}else if(pwd==""){
			$(".error2").html('密码不能为空！');
			$("#pwd").focus();
			return false;
		}else if(pwd1==""){
			$(".error3").html('确认密码不能为空！');
			$("#pwd1").focus();
			return false;
		}else if(!isok){
			$(".error1").html('邮箱格式不正确！');
			$("#mail").focus();
			return false;
		}else if($("#pwd").val().length<6){
			$(".error2").html('密码不能少于6位！');
			$("#pwd").focus();
			return false;
		}else if(pwd!=pwd1){
			$(".error3").html('两次输入的密码不一致！');
			$("#pwd1").focus();
			return false;
		}
		else{
			$("#userform")[0].submit();
		}
	});

	//鼠标离开用户名输入框时
		$("#username").blur(function(){
			var username=$("#username").val();
			var url=checkUsername;
			if(username==""){
				$(".error").html('用户名不能为空！');
			}else{
				$.post(
					url,
					{user:username},
					function(data){
						if (data==0){
							$(".error").html('');
						}else{
							$(".error").html('该用户名已被注册！');
							return false;
						}
					},
					"text"
					);
			}
			
		});

	//鼠标离开邮箱输入框时
		$("#mail").blur(function(){
			//正则验证邮箱
			var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/;
			var username=$("#username").val();
			var mail=$("#mail").val();
			var url=checkEmail;
			isok=reg.test(mail);
			if(username==""){
				$(".error").html('用户名不能为空！');
			}
			if(mail==""){
				$(".error1").html('邮箱不能为空！');
			}else if(!isok){
				$(".error1").html('邮箱格式不正确！');
			}else{
				$.post(
					url,
					{email:mail},
					function(data){
						if(data==0){
							$(".error1").html('');
						}else{
							$(".error1").html('该邮箱已被注册！');
							return false;
						}
					},
					"text"
					);
			}

		});

	//鼠标离开密码输入框时
		$("#pwd").blur(function(){
			var username=$("#username").val();
			var mail=$("#mail").val();
			var pwd=$("#pwd").val();
			if(username==""){
				$(".error").html('用户名不能为空！');
			}
			if(mail==""){
				$(".error1").html('邮箱不能为空！');
			}
			if(pwd==""){
				$(".error2").html('密码不能为空！');
			}else if($("#pwd").val().length<6){
					$(".error2").html('密码不能少于6位！');
			}else{
				$(".error2").html('');
			}
		});

	//鼠标离开确认密码输入框时
		$("#pwd1").blur(function(){
			var username=$("#username").val();
			var mail=$("#mail").val();
			var pwd=$("#pwd").val();
			var pwd1=$("#pwd1").val();
			if(username==""){
				$(".error").html('用户名不能为空！');
			}
			if(mail==""){
				$(".error1").html('邮箱不能为空！');
			}
			if(pwd==""){
				$(".error2").html('密码不能为空！');
			}
			if(pwd1==""){
				$(".error3").html('确认密码不能为空！');
			}else if(pwd!=pwd1){
				$(".error3").html('两次输入的密码不一致！');
				return false;
			}else{
				$(".error3").html('');
			}

		});
});