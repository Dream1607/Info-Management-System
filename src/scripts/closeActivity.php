<?php
	header("Content-type: text/html; charset=utf-8");
	session_start();
	
	require('../inc/template.inc');
	$tpl = new Template('../html');
	$tpl->set_file('closeActivity', 'closeActivity.html'); 
	
	include(__DIR__ . '/../lib.php');
	Config::loadCustom('/etc/Info/config.ini');

	$tpl->set_var('user', $_SESSION['info']);

	$tpl->pparse('output', 'closeActivity');
	
	if(isset($_POST["submit"]))
	{
		 $Activity_id = $_POST["no"];

		 $checkExist = getOneNumber("SELECT id FROM Activity WHERE id = '$Activity_id'");

		 if($checkExist === NULL)
		 {
		 	 echo "<script language=\"JavaScript\">\r\n"; 
			 echo " alert(\"关闭失败，不存在该活动信息！\");\r\n"; 
			 echo "</script>"; 
			 exit;	
		 }

		 getDb()->query("UPDATE Activity SET status = 'deleted' WHERE id = '$Activity_id'");	

     	 echo "<script language=\"JavaScript\">\r\n"; 
		 echo " alert(\"关闭成功！\");\r\n"; 
		 echo "</script>"; 
		 exit;
	} 
?>