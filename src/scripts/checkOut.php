<?php
	header("Content-type: text/html; charset=utf-8");
	session_start();
	
	require('../inc/template.inc');
	$tpl = new Template('../html');
	$tpl->set_file('checkOut', 'checkOut.html'); 
	
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

	$tpl->pparse('output', 'checkOut');

	if(isset($_POST["submit"]))
	{
		 $Ano = $_POST["Ano"];
		 $Sno = $_POST["Sno"];

		 $result = getDb()->query("UPDATE 
				 						Activity_Student 
				 					SET 
				 						status = 'deleted' 
				 					WHERE 
				 						activityid = '$Ano' 
				 					AND studentid = '$Sno'");

		 if($result)
		 {
		 	 echo "<script language=\"JavaScript\">\r\n"; 
			 echo " alert(\"取消签到成功！\");\r\n"; 
			 echo "</script>"; 
			 exit;	
		 }
		 else
		 {
		 	 echo "<script language=\"JavaScript\">\r\n"; 
			 echo " alert(\"取消签到失败，请检查该学生是否参加该活动！\");\r\n"; 
			 echo "</script>"; 
			 exit;
		 }		
	} 
?>