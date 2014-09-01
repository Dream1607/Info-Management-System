<?php
	header("Content-type: text/html; charset=utf-8");
	session_start();
	
	require('../inc/template.inc');
	$tpl = new Template('../html');
	$tpl->set_file('asStudent', 'asStudent.html');

	include(__DIR__ . '/../lib.php');
	Config::loadCustom('/etc/Info/config.ini');

	if(isset($_SESSION["info"]))
	{
		$tpl->set_var("status","$_SESSION[info]");
	}

	$tpl->pparse('output', 'asStudent');
?>