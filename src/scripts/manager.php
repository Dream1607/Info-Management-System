<?php
	header("Content-type: text/html; charset=utf-8");
	session_start();

	require('../inc/template.inc');
	$tpl = new Template('../html');
	$tpl->set_file('global', 'global.html'); 
	$tpl->set_var("user","$_SESSION[info]");

	$type = $_GET['type'];
	
	$tpl->set_var('start',"<!--");
	$tpl->set_var('managerend',"-->");

	if($type === 'addManager')
	{
		$tpl->set_var("operationName","添加管理员");
	}
	else
	{
		$tpl->set_var("operationName","删除管理员");
	}

	$tpl->pparse('output', 'global');

	if(isset($_POST['submit']))
	{
		include(__DIR__ . '/lib.php');
		Config::loadCustom('/etc/Info/config.ini');
		
		$input = array();
		$input[] = $_POST['username'];
		$input[] = $_POST['password1'];
		$input[] = $_POST['password2'];

		if(validate($input,'manager'))
		{
			if($type === 'addManager')
			{
				
			}
			else
			{
				
			}
		}
	}
?>