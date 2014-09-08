$(document).ready(function(){
	$(".btn").click(function(){
		var id = $(this).attr('id')
		if(id == "asActivity"){
			window.location.href = "asActivity.php"
			return
		}

		if(id == "asStudent"){
			window.location.href = "asStudent.php"
			return
		}
		
		if(id == "checkList"){
			window.location.href = "checkList.php"
			return
		}

		if(id.indexOf("Activity")>=0){
			var url = "activity.php"
			url = url + "?type=" +id
			window.location.href = url
			return
		}

		if(id.indexOf("Student")>=0){
			var url = "student.php"
			url = url + "?type=" +id
			window.location.href = url
			return
		}

		if(id.indexOf("Manager")>=0){
			var url = "manager.php"
			url = url + "?type=" +id
			window.location.href = url
			return
		}	
	});
});

