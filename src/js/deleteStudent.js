
$(document).ready(function(){
		if($("#number").val()!="") $("#fornumber").hide();
		if($("#name").val()!="") $("#forname").hide();

		$("#name").focus(function(){
			$("#forname").hide();
		})

		$("#number").focus(function(){
			$("#fornumber").hide();		
		})

		$("#name").blur(function(){
			var text=$("#name").val();
			if(text=="") $("#forname").show();
		})

		$("#number").blur(function(){
			var text=$("#number").val();
			if(text=="") $("#fornumber").show();		
		})

		$("#gender").change(function(){
			var text=$("#gender option:selected").text();
			if(text!="") 	$("#forgender").hide();
			else $("#forgender").show();
		})

		$("#major").change(function(){
			var text=$("#major option:selected").text();
			if(text!="") 	$("#formajor").hide();
			else $("#formajor").show();
		})	

		$("#grade").change(function(){
			var text=$("#grade option:selected").text();
			if(text!="") 	$("#forgrade").hide();
			else $("#forgrade").show();
		})

		$("#class").change(function(){
			var text=$("#class option:selected").text();
			if(text!="") 	$("#forclass").hide();
			else $("#forclass").show();
		})	
})