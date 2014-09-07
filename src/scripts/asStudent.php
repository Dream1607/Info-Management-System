<?php
	header("Content-type: text/html; charset=utf-8");
	session_start();

	require('../inc/template.inc');
	$tpl = new Template('../html');
	$tpl->set_file('inquire', 'inquire.html'); 
	
	$tpl->set_var("user","$_SESSION[info]");
	$tpl->set_var('begin',"<!--");
	$tpl->set_var('middle',"-->");
	
	$tpl->pparse('output', 'inquire');
?>