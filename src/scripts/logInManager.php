<?php
	header("Content-type: text/html; charset=utf-8");
	session_start();
	
	require('../inc/template.inc');
	$tpl = new Template('../html');
	$tpl->set_file('logInManager', 'logInManager.html'); 
	
	include(__DIR__ . '/../lib.php');
	Config::loadCustom('/etc/Info/config.ini');

	if(isset($_SESSION["info"]))
	{
		echo "<script>location='/scripts/indexAdmin.php'</script>";
	}

	$tpl->pparse('output', 'logInManager');
	
	if(isset($_POST["submit"]))
	{
		 $username = $_POST["username"];
		 $password = md5($_POST["password"]);

		 $checkUsers = getSql("SELECT * FROM Account");

		 foreach ($checkUsers as $index => $account) 
		 {
		 	if($username === $account['username'])
		 	{
		 		 if($password === $account['password'] && $account['status'] === 'default')
		 		 {
		 		 	$_SESSION['info'] = $username;
		 		 	echo "<script>location='/scripts/indexAdmin.php'</script>";
		 		 }
		 	}
		 }

		 echo "<script language=\"JavaScript\">\r\n"; 
		 echo "alert(\"用户名或密码错误！\");\r\n";
		 echo "</script>";
		 exit;
	}
?>

