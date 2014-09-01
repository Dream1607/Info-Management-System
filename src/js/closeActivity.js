
$(document).ready(function(){
		$("#name").focus(function(){
			$("#forname").hide();
		})

		$("#time").focus(function(){
			$("#fortime").hide();		
		})

		$("#place").focus(function(){
			$("#forplace").hide();		
		})

		$("#sponsor").focus(function(){
			$("#forsponsor").hide();		
		})

		$("#name").blur(function(){
			var text=$("#name").val();
			if(text=="") $("#forname").show();
		})

		$("#time").blur(function(){
			var text=$("#time").val();
			if(text=="") $("#fortime").show();		
		})

		$("#place").blur(function(){
			var text=$("#place").val();
			if(text=="") $("#forplace").show();		
		})

		$("#sponsor").blur(function(){
			var text=$("#sponsor").val();
			if(text=="") $("#forsponsor").show();		
		})

		$("#type").change(function(){
			var text=$("#type option:selected").text();
			if(text!="") 	$("#fortype").hide();
			else $("#fortype").show();
		})

		$("#department").change(function(){
			var text=$("#department option:selected").text();
			if(text!="") 	$("#fordepartment").hide();
			else $("#fordepartment").show();
		})	
})