

$(document).ready(function(){
		if($("#username").val()!="") $("#forusername").hide();
		if($("#password1").val()!="") $("#forpassword1").hide();
		if($("#password2").val()!="") $("#forpassword2").hide();
		
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