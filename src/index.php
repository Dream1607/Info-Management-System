<?php
	require('./inc/template.inc');

	session_start();

	if(isset($_POST["exit"]))
	{
		unset($_SESSION["info"]);
		header("Location: /index.php");
	}

	$tpl = new Template('./html'); 
	$tpl->set_file('index', 'index.html'); 

	if(!isset($_SESSION["info"]))
	{
		$tpl->set_var("PAGE","logInManager");
		$tpl->set_var("button","管理员登陆");
	}
	else
	{
		$tpl->set_var("PAGE","indexAdmin");
		$tpl->set_var("button","进入管理员界面");
		$tpl->set_var("status","$_SESSION[info]");
	}

	$tpl->pparse('output', 'index');
?>
