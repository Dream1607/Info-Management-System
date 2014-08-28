<?php
	header("Content-type: text/html; charset=utf-8");
	session_start();
	
	require('../inc/template.inc');
	$tpl = new Template('../html');
	$tpl->set_file('checkIn', 'checkIn.html'); 
	
	include(__DIR__ . '/../lib.php');
	Config::loadCustom('/etc/Info/config.ini');

	if(!isset($_SESSION["info"]))
	{
		echo "<script language=\"JavaScript\">\r\n"; 
		echo "alert(\"您尚未登录！\");\r\n";
		echo "location='/scripts/loginManager.php'";
		echo "</script>"; 
	}
	else
	{
		$tpl->set_var("status","$_SESSION[info]");
	}

	$tpl->pparse('output', 'checkIn');
	
	if(isset($_POST["submit"]))
	{
		 $checkInData = array();
		 $checkInData[] = $_POST["Ano"];
		 $checkInData[] = $_POST["Sno"];
		 $checkInData[] = $_POST["note"];

		 $checkStudentExist = getOneNumber("SELECT id FROM Student WHERE id = '$_POST[Sno]'");

		 $checkActivityExist = getOneNumber("SELECT id FROM Activity WHERE id = '$_POST[Ano]'");

		 if($checkStudentExist === NULL || $checkActivityExist === NULL)
		 {
		 	 echo "<script language=\"JavaScript\">\r\n"; 
			 echo " alert(\"签到失败，请检查是否存在该学生或该活动！\");\r\n"; 
			 echo "</script>"; 
			 exit;	
		 }

		 $result = insert($checkInData, array(	 'activity_id',
					 							 'student_id',
					 							 'note'), 'Activity_Student');
		 if($result)
		 {
		 	 echo "<script language=\"JavaScript\">\r\n"; 
			 echo " alert(\"签到成功！\");\r\n"; 
			 echo "</script>"; 
			 exit;	
		 }
		 else
		 {
		 	 echo "<script language=\"JavaScript\">\r\n"; 
			 echo " alert(\"签到失败，请检查是否存在该学生或该活动！\");\r\n"; 
			 echo "</script>"; 
			 exit;
		 }		
	} 
?>