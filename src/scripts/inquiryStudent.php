<?php
	header("Content-type: text/html; charset=utf-8");
	session_start();
	
	require('../inc/template.inc');
	$tpl = new Template('../html');
	$tpl->set_file('inquiryStudent', 'inquiryStudent.html'); 
	
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

	$tpl->pparse('output', 'inquiryStudent');
	
	$studentData = getSql("SELECT * FROM Student");
	
	getTable($studentData,array('学号',
								'姓名',
								'性别',
								'专业',
								'年级',
								'班级',
								'状态'),"border='1' align='center' width='888'");
?>