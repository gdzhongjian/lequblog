$(document).ready(function(){
	$(".btn-block").click(function(){
		var password=$(".password").val();
		var password1=$(".password1").val();
		if(password==""){
			$(".error1").html('密码不能为空！');
			$(".password").focus();
			return false;
		}else if(password1==""){
			$(".error2").html('确认密码不能为空！');
			$(".password1").focus();
			return false;
		}else if($(".password").val().length<6){
			$(".error1").html('密码不能少于6位！');
			$(".password").focus();
			return false;
		}else if(password!=password1){
			$(".error2").html('两次输入的密码不一致！');
			$(".password1").focus();
			return false;
		}
		else{
			return true;
		}
	});

	//鼠标离开密码输入框时
		$(".password").blur(function(){
			var password=$(".password").val();
			if(password==""){
				$(".error1").html('密码不能为空！');
			}else if($(".password").val().length<6){
					$(".error1").html('密码不能少于6位！');
			}else{
				$(".error1").html('');
			}
		});

	//鼠标离开确认密码输入框时
		$(".password1").blur(function(){
			var password=$(".password").val();
			var password1=$(".password1").val();
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