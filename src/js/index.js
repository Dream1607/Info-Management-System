

$(document).ready(function(){
	//initialize divs display
	$("#loginmanager").hide();
	$("#loginstudent").hide();

	//log-in move effects
		$("#login1").click(function(){
			$("#loginmanager").slideDown();
			if($("#managerusername").val()!="") $("#formanagerusername").hide();
			if($("#managerpassword").val()!="") $("#formanagerpassword").hide();			
		})

		$("#login2").click(function(){
			$("#loginstudent").slideDown();
			if($("#studentpassword").val()!="") $("#forstudentpassword").hide();
			if($("#studentusername").val()!="") $("#forstudentusername").hide();		
		})

		$("#managercancel").click(function(){
			$("#loginmanager").slideUp();
		})

		$("#studentcancel").click(function(){
			$("#loginstudent").slideUp();
		})

		$("#managerusername").focus(function(){
			$("#formanagerusername").hide();		
		})

		$("#managerpassword").focus(function(){
			$("#formanagerpassword").hide();		
		})

		$("#studentusername").focus(function(){
			$("#forstudentusername").hide();		
		})

		$("#studentpassword").focus(function(){
			$("#forstudentpassword").hide();		
		})

		$("#managerusername").blur(function(){
			var text=$("#managerusername").val();
			if(text=="") $("#formanagerusername").show();
		})

		$("#managerpassword").blur(function(){
			var text=$("#managerpassword").val();
			if(text=="") $("#formanagerpassword").show();		
		})

		$("#studentusername").blur(function(){
			var text=$("#studentusername").val();
			if(text=="") $("#forstudentusername").show();
		})

		$("#studentpassword").blur(function(){
			var text=$("#studentpassword").val();
			if(text=="") $("#studentpassword").show();		
		})
})