$(document).ready(function(){
	$(".btn-block").click(function(){
		var oldpassword=$("#oldpassword").val();
		var password=$("#newpassword").val();
		var password1=$("#newpassword1").val();
		if(oldpassword==""){
			$(".error").html('原密码不能为空！');
			$("#oldpassword").focus();
			return false;
		}else if(password==""){
			$(".error1").html('密码不能为空！');
			$("#newpassword").focus();
			return false;
		}else if(password1==""){
			$(".error2").html('确认密码不能为空！');
			$("#newpassword1").focus();
			return false;
		}else if($("#newpassword").val().length<6){
			$(".error1").html('密码不能少于6位！');
			$("#newpassword").focus();
			return false;
		}else if(password!=password1){
			$(".error2").html('两次输入的密码不一致！');
			$("#newpassword1").focus();
			return false;
		}
		else{
			return true;
		}
	});

	//鼠标离开原密码输入框时
	$("#oldpassword").blur(function(){
		var oldpassword=$("#oldpassword").val();
		var url=checkOldPassword;
		if(oldpassword==""){
			$(".error").html('原密码不能为空！');
		}else{
			$.post(
				url,
				{oldpassword:oldpassword},
				function(data){
					if(data==1){
						$(".error").html('原密码不正确！');
						$("#oldpassword").focus();
					}else{
						$(".error").html('');
					}
				},
				'text'
				);
		}
	});

	//鼠标离开密码输入框时
		$("#newpassword").blur(function(){
			var password=$("#newpassword").val();
			if(password==""){
				$(".error1").html('密码不能为空！');
			}else if($("#newpassword").val().length<6){
					$(".error1").html('密码不能少于6位！');
			}else{
				$(".error1").html('');
			}
		});

	//鼠标离开确认密码输入框时
		$("#newpassword1").blur(function(){
			var password=$("#newpassword").val();
			var password1=$("#newpassword1").val();
			if(password==""){
				$(".error1").html('密码不能为空！');
			}
			if(password1==""){
				$(".error2").html('确认密码不能为空！');
			}else if(password!=password1){
				$(".error2").html('两次输入的密码不一致！');
				return false;
			}else{
				$(".error2").html('');
			}

		});
});