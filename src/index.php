<?php
	require('./inc/template.inc');

	session_start();

	$tpl = new Template('./html'); 
	$tpl->set_file('index', 'index.html');

	include(__DIR__ . '/lib.php');
	Config::loadCustom('/etc/Info/config.ini');

	if(isset($_POST["exit"]))
	{
		unset($_SESSION["info"]);
		header("Location: /index.php");
	}

	if(isset($_POST["submitmanager"]))
	{
		 $username = $_POST["username"];
		 $password = md5($_POST["password"]);

		 $checkUsers = getSql("SELECT * FROM Account");

		 foreach ($checkUsers as $account) 
		 {
		 	if($username === $account['username'] && $password === $account['password'] && $account['status'] === 'default')
		 	{
		 		 $_SESSION['info'] = $username;
		 		 if($username === 'info')
		 		 {
		 		 	echo "<script>location='/scripts/infoManagerIndex.php'</script>";
		 		 }
		 		 else
		 		 {
		 		 	echo "<script>location='/scripts/otherManagerIndex.php'</script>";
		 		 }

		 	}
		 }

		 echo "<script language=\"JavaScript\">\r\n"; 
		 echo "alert(\"用户名或密码错误！\");\r\n";
		 echo "</script>";
		 exit;
	}

	if(isset($_POST["submitstudent"]))
	{
		 $username = $_POST["username"];
		 $password = $_POST["password"];

		 $checkUsers = getSql("SELECT id,status FROM Student");

		 foreach ($checkUsers as $account) 
		 {
		 	if($username === $account['id'] && $password === $account['id'] && $account['status'] === 'default')
		 	{
		 		 	$_SESSION['student'] = $username;
		 		 	echo "<script>location='/scripts/studentIndex.php'</script>";
		 	}
		 }

		 echo "<script language=\"JavaScript\">\r\n"; 
		 echo "alert(\"用户名或密码错误！\");\r\n";
		 echo "</script>";
		 exit;
	}

	$tpl->pparse('output', 'index');
?>
