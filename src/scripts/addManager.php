<?php
    header("Content-type: text/html; charset=utf-8");
	require('../inc/template.inc');

	session_start();

	$tpl = new Template('../html'); 
	$tpl->set_file('addManager', 'addManager.html');

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
			 echo "location='/scripts/addManager.php'";
			 echo "</script>";
			 exit;
		 }

		 $checkUsers = getSql("SELECT * FROM Account");

		 foreach ($checkUsers as $account) 
		 {
		 	if($username === $account['username'])
		 	{
		 		 echo "<script language=\"JavaScript\">\r\n"; 
				 echo "alert(\"该用户名已存在\");\r\n";
				 echo "location='/scripts/addManager.php'";
				 echo "</script>";
				 exit;
		 	}
		 }

		 $userData = array();
		 $userData[] = $username;
		 $userData[] = $password1;

		 $result = insert($userData, array(	 'username',
					 						 'password'), 'Account');

		 echo "<script language=\"JavaScript\">\r\n"; 
		 echo " alert(\"添加成功！\");\r\n";
		 echo "location='/scripts/addManager.php'";
		 echo "</script>"; 
		 exit;
	}

	$tpl->pparse('output', 'addManager');
?>