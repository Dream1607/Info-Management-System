<?php
	header("Content-type: text/html; charset=utf-8");
	session_start();
	
	require('../inc/template.inc');
	$tpl = new Template('../html');
	$tpl->set_file('inquiryActivity', 'inquiryActivity.html'); 
	
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

	$tpl->pparse('output', 'inquiryActivity');
	
	if(isset($_POST["submit"]))
	{
		 $type = $_POST["type"];

		 if($type == "全部类")
		 {
		 	$activityData = getSql("SELECT * FROM Activity");
		 }
		 else
		 {
		 	$activityData = getSql("SELECT * FROM Activity WHERE type = '$type'");
		 }
	     getTable($activityData,array(  '活动代号',
										'名称',
										'类型',
										'主办部门',
										'日期',
										'地点',
										'负责人',
										'状态'),"border='1' align='center' width='888'");
	} 
?>