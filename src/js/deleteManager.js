

$(document).ready(function(){

		
		$("#username").focus(function(){
			$("#forusername").hide();		
		})

		$("#password1").focus(function(){
			$("#forpassword1").hide();		
		})

		$("#password2").focus(function(){
			$("#forpassword2").hide();		
		})

		$("#username").blur(function(){
			var text=$("#username").val();
			if(text=="") $("#forusername").show();
		})

		$("#password1").blur(function(){
			var text=$("#password1").val();
			if(text=="") $("#forpassword1").show();		
		})

		$("#password1").blur(function(){
			var text=$("#password2").val();
			if(text=="") $("#forpassword2").show();		
		})

})