<?php
	header("Content-type: text/html; charset=utf-8");
	session_start();

	require('../inc/template.inc');
	$tpl = new Template('../html');
	$tpl->set_file('global', 'global.html'); 
	$tpl->set_var("user","$_SESSION[student]");

	$type = $_GET['type'];

	$tpl->set_var('start',"<!--");
	$tpl->set_var('activitystart',"-->");
	$tpl->set_var('managerend',"<!--");
	$tpl->set_var('end',"-->");


	if($type === 'addStudent')
	{
		$tpl->set_var("operationName","添加学生");
	}
	else
	{
		$tpl->set_var("operationName","删除学生");
	}

	$tpl->pparse('output', 'global');

	if(isset($_POST['submit']))
	{
		include(__DIR__ . '/lib.php');
		Config::loadCustom('/etc/Info/config.ini');
		
		$input = array();
		$input[] = $_POST['number'];
		$input[] = $_POST['name'];
		$input[] = $_POST['gender'];
		$input[] = $_POST['major'];
		$input[] = $_POST['grade'];
		$input[] = $_POST['class'];

		if(validate($input,'student'))
		{
			if($type === 'addStudent')
			{
				
			}
			else
			{
				
			}
		}
	}
?>