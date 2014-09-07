<?php
	header("Content-type: text/html; charset=utf-8");
	session_start();

	require('../inc/template.inc');
	$tpl = new Template('../html');
	$tpl->set_file('global', 'global.html'); 
	$tpl->set_var("user","$_SESSION[info]");

	$type = $_GET['type'];

	$tpl->set_var('activitystart',"<!--");
	$tpl->set_var('end',"-->");

	if($type === 'addActivity')
	{
		$tpl->set_var("operationName","发起活动");
	}
	else if($type === 'closeActivity')
	{
		$tpl->set_var("operationName","关闭活动");
	}
	else
	{
		$tpl->set_var("operationName","删除活动");
	}

	$tpl->pparse('output', 'global');

	if(isset($_POST['submit']))
	{
		include(__DIR__ . '/lib.php');
		Config::loadCustom('/etc/Info/config.ini');
		
		$input = array();
		$input[] = $_POST['name'];
		$input[] = $_POST['type'];
		$input[] = $_POST['department'];
		$input[] = $_POST['time'];
		$input[] = $_POST['place'];
		$input[] = $_POST['sponsor'];

		if(validate($input,'activity'))
		{

			if($type === 'addActivity')
			{
				
			}
			else if($type === 'closeActivity')
			{
				
			}
			else
			{
				
			}
		}
	}
?>