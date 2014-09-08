<?php
	header("Content-type: text/html; charset=utf-8");
	session_start();
	
	require('../inc/template.inc');
	$tpl = new Template('../html');
	$tpl->set_file('checkList', 'checkList.html');
	
	$tpl->pparse('output', 'checkList');
?>