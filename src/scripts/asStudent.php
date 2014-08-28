<?php
	header("Content-type: text/html; charset=utf-8");
	session_start();
	
	require('../inc/template.inc');
	$tpl = new Template('../html');
	$tpl->set_file('asStudent', 'asStudent.html');

	include(__DIR__ . '/../lib.php');
	Config::loadCustom('/etc/Info/config.ini');

	if(isset($_SESSION["info"]))
	{
		$tpl->set_var("status","$_SESSION[info]");
	}

	$tpl->pparse('output', 'asStudent');
	
	if(isset($_POST["submit"]))
	{
		 $Student_id = $_POST["no"];

		 if(is_numeric($Student_id))
		 {
		  	if(strlen($Student_id) != 10)
		  	{
		  		echo "<script language=\"JavaScript\">\r\n"; 
				echo " alert(\"查询失败，请注意学号长度\");\r\n"; 
				echo "</script>"; 
				exit; 
		  	}
		 }
		 else 
		 {
		 	echo "<script language=\"JavaScript\">\r\n"; 
			echo " alert(\"查询失败，请输入数字\");\r\n"; 
			echo "</script>"; 
			exit;
		 }

		 $query = "SELECT 
		 					Activity_Student.student_id,
		 					Student.name AS student_name,
		 					Student.status AS student_status,		 				  	
		 					Activity.id,
		 				  	Activity.type,
		 				  	Activity.name AS activity_name,
		 				  	Activity.department,
		 				  	Activity.date,
		 				  	Activity.place,
		 				  	Activity.staff,
		 				  	Activity.status AS activity_status,
							Activity_Student.note
		 			FROM 
		 					Activity_Student
		 			LEFT JOIN 
		 					Activity ON Activity_Student.activity_id = Activity.id
		 			LEFT JOIN
		 					Student ON Activity_Student.student_id = Student.id
		 			WHERE 
		 					Activity_Student.student_id = '$Student_id'";

		 $checkAsStudentData = getSql( $query );

		 getTable($checkAsStudentData,array('学号',
		 									'姓名',
		 									'学生状态',
		 									'活动代号',
											'类型',
											'活动名称',
											'主办部门',
											'日期',
											'地点',
											'负责人',
											'活动状态',
											'备注'),"border='1' align='center' width='888'");
	} 
?>