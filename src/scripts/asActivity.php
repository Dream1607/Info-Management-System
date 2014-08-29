<?php
	header("Content-type: text/html; charset=utf-8");
	session_start();

	require('../inc/template.inc');
	$tpl = new Template('../html');
	$tpl->set_file('asActivity', 'asActivity.html'); 
	

	if(isset($_SESSION["info"]))
	{
		$tpl->set_var("status","$_SESSION[info]");
	}

	$tpl->pparse('output', 'asActivity');
?>