<?php
	header("Content-type: text/html; charset=utf-8");
	session_start();

	require('../inc/template.inc');
	$tpl = new Template('../html');
	$tpl->set_file('asActivity', 'asActivity.html'); 
	
	$tpl->set_var("user","$_SESSION[info]");
	
	$tpl->pparse('output', 'asActivity');
?>