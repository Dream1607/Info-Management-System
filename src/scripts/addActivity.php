<?php
	header("Content-type: text/html; charset=utf-8");
	session_start();

	require('../inc/template.inc');
	$tpl = new Template('../html');
	$tpl->set_file('addActivity', 'addActivity.html'); 

	include(__DIR__ . '/../lib.php');
	Config::loadCustom('/etc/Info/config.ini');

	if(!isset($_SESSION["info"]))
	{
		echo "<script language=\"JavaScript\">\r\n"; 
		echo "alert(\"您尚未登录！\");\r\n";
		echo "location='/scripts/loginManager.php'";
		echo "</script>"; 
	}
	if(isset($_SESSION["info"]))
	{
		if($_SESSION["info"] == "info")
		{
			echo "<script language=\"JavaScript\">\r\n"; 
			echo "alert(\"您没有添加活动的权限!\");\r\n";
			echo "location='/scripts/indexAdmin.php'";
			echo "</script>"; 
		}
		else
		{
			$tpl->set_var("status","$_SESSION[info]");
		}
	}

	date_default_timezone_set("PRC");

	$tpl->pparse('output', 'addActivity');

	if(isset($_POST["submit"]))
	{
		 $activityData = array();
		
		//sanitize input
		if(preg_match("/^[\x{4e00}-\x{9fa5}]+$/u",$_POST["type"])){
			$activityData[] = $_POST["type"];
		}else die("Error: Type");
		
		if(preg_match("/^[\x{4e00}-\x{9fa5}]+$/u",$_POST["department"])){
			$activityData[] = $_POST["department"];
		}else die("Error: Department");
		
		if(preg_match("/^[\x{4e00}-\x{9fa5}A-Za-z0-9._-]+$/u",$_POST["name"])){
			$activityData[] = $_POST["name"];
		}else die("Error: Name");
		 
		if(DATE('Y-m-d',strtotime($_POST["date"])) == $_POST["date"]){
			$activityData[] = $_POST["date"];
		}else die("Error: Date");
		 
		if(preg_match("/^[\x{4e00}-\x{9fa5}A-Za-z0-9._-]+$/u",$_POST["place"])){
			$activityData[] = $_POST["place"];
		}else die("Error: Place");
		 
		if(preg_match("/^[\x{4e00}-\x{9fa5}A-Za-z0-9._-]+$/u",$_POST["staff"])){
			$activityData[] = $_POST["staff"];
		}else die("Error: Staff");
		

		 $result1 = insert($activityData, array( 'type',
					 							 'department',
					 							 'name',
					 							 'date',
					 							 'place',
					 							 'staff'), 'Activity');

		 $query = "SELECT id FROM Account WHERE username = '$_SESSION[info]'";
		 $accountId = getOneNumber($query);
		 $query = "SELECT id FROM Activity ORDER BY id DESC";
		 $activityId = getOneNumber($query);

		 $accountActivityData = array();
		 $accountActivityData[] = $accountId;
		 $accountActivityData[] = $activityId;

		 $result2 = insert($accountActivityData, array(	'account_id',
					 							 		'activity_id'), 'Account_Activity');
		 if($result1 && $result2)
		 {
		 	 echo "<script language=\"JavaScript\">\r\n"; 
			 echo " alert(\"添加成功！\");\r\n"; 
			 echo "</script>"; 
			 exit;	
		 }
		 else
		 {
		 	 echo "<script language=\"JavaScript\">\r\n"; 
			 echo " alert(\"添加失败，请注意该活动信息的完整性！\");\r\n"; 
			 echo "</script>"; 
			 exit;
		 }
	} 
?>