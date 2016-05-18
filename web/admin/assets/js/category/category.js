$(document).ready(function(){
	$("#lanmuname").blur(function(){
		var name=$("#lanmuname").val();
		var url=checkName;
		if(name==""){
			$(".error").html('栏目名称不能为空！');
		}else{
			$.post(
				url,
				{name:name}, 
				function(data){
					if(data==1){
						$(".error").html('栏目名称已存在！');
					}
				}
				);
		}
	});
});