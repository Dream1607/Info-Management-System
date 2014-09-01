<?php
    header("Content-type: text/html; charset=utf-8");
	require('../inc/template.inc');

	session_start();

	$tpl = new Template('../html'); 
	$tpl->set_file('deleteManager', 'deleteManager.html');

	include(__DIR__ . '/../lib.php');
	Config::loadCustom('/etc/Info/config.ini');

	$tpl->set_var('user', $_SESSION['info']);

	if(isset($_POST["submit"]))
	{
		 $username = $_POST["username"];
		 $password1 = md5($_POST["password1"]);
		 $password2 = md5($_POST["password2"]);

		 if($password1 != $password2)
		 {
		 	 echo "<script language=\"JavaScript\">\r\n"; 
			 echo "alert(\"密码不一致！\");\r\n";
			 echo "location='/scripts/deleteManager.php'";
			 echo "</script>";
			 exit;
		 }

		 $checkUsers = getSql("SELECT * FROM Account WHERE username = '$account[username]' AND password = '$account[password]'");

		 if(empty($checkUsers))
		 {
		 	 echo "<script language=\"JavaScript\">\r\n"; 
			 echo " alert(\"不存在该管理员账号\");\r\n";
			 echo "location='/scripts/addManager.php'";
			 echo "</script>"; 
			 exit;
		 }
		 else
		 {
		 	getDb()->query("UPDATE Account SET status = 'deleted' username = '$account[username]' AND password = '$account[password]'");
		 }
	}

	$tpl->pparse('output', 'deleteManager');
?>