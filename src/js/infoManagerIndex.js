

$(document).ready(function(){
	$("#tip1").hide();
	$("#tip2").hide();
	$("#tip3").hide();
	$("#tip4").hide();
	$("#tip5").hide();
	$("#tip6").hide();


	$("#asactivity").mouseenter(function(){
		$("#tip1").show();
	})

	$("#asactivity").mouseleave(function(){
		$("#tip1").hide();
	})

	$("#addstudent").mouseenter(function(){
		$("#tip2").show();
	})

	$("#addstudent").mouseleave(function(){
		$("#tip2").hide();
	})

	$("#deletestudent").mouseenter(function(){
		$("#tip3").show();
	})

	$("#deletestudent").mouseleave(function(){
		$("#tip3").hide();
	})

	$("#asstudent").mouseenter(function(){
		$("#tip4").show();
	})

	$("#asstudent").mouseleave(function(){
		$("#tip4").hide();
	})

	$("#addmanager").mouseenter(function(){
		$("#tip5").show();
	})

	$("#addmanager").mouseleave(function(){
		$("#tip5").hide();
	})

	$("#deletemanager").mouseenter(function(){
		$("#tip6").show();
	})

	$("#deletemanager").mouseleave(function(){
		$("#tip6").hide();
	})


})