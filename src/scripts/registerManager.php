<?php
	header("Content-type: text/html; charset=utf-8");
	session_start();
	
	require('../inc/template.inc');
	$tpl = new Template('../html');
	$tpl->set_file('registerManager', 'registerManager.html'); 
	
	include(__DIR__ . '/../lib.php');
	Config::loadCustom('/etc/Info/config.ini');

	if(!isset($_SESSION["info"]))
	{
		echo "<script language=\"JavaScript\">\r\n"; 
		echo "alert(\"您尚未登录！\");\r\n";
		echo "location='/scripts/loginManager.php'";
		echo "</script>"; 
	}
	else if($_SESSION["info"] != 'info')
	{
		echo "<script language=\"JavaScript\">\r\n"; 
		echo "alert(\"对不起，您没有添加管理员的权限！\");\r\n";
		echo "location='/scripts/indexAdmin.php'";
		echo "</script>"; 
	}
	else
	{
		$tpl->set_var("status","$_SESSION[info]");
	}

	$tpl->pparse('output', 'registerManager');
	
	if(isset($_POST["submit"]))
	{
		 $userData = array();
		 $userData[] = $_POST["username"];
		 $userData[] = md5($_POST["password"]);

		 $checkUsers = getSql("SELECT username FROM Account");
		 
		 foreach ($checkUsers as $index => $name) 
		 {
		 	if(in_array($_POST["username"],$name))
		 	{
		 		 echo "<script language=\"JavaScript\">\r\n"; 
				 echo " alert(\"该用户名已存在！\");\r\n"; 
				 echo "</script>"; 
				 exit;	
		 	}
		 }
		 
		 $result = insert($userData, array(	 'username',
					 						 'password'), 'Account');
		 if($result)
		 {
		 	 echo "<script language=\"JavaScript\">\r\n"; 
			 echo " alert(\"添加成功！\");\r\n";
			 echo "location='/scripts/indexAdmin.php'";
			 echo "</script>"; 
			 exit;	
		 }
		 else
		 {
		 	 echo "<script language=\"JavaScript\">\r\n"; 
			 echo " alert(\"添加失败！\");\r\n"; 
			 echo "</script>"; 
			 exit;
		 }
	} 
?>