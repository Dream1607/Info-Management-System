

$(document).ready(function(){
	$("#name").focus(function(){
		$("#forname").hide();
	})

	$("#name").blur(function(){
		var text=$("#name").val();
		if(text!="") $("#forname").hide();
		else  $("#forname").show();
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