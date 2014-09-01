<?php 
	require('../inc/template.inc');

	session_start();

	$tpl = new Template('../html'); 
	$tpl->set_file('studentIndex', 'studentIndex.html');

	include(__DIR__ . '/../lib.php');
	Config::loadCustom('/etc/Info/config.ini');

	$userName = getOneNumber("SELECT name FROM Student WHERE id = '$_SESSION[student]'");

	$tpl->set_var('user', $userName);

	$tpl->pparse('output', 'studentIndex');
?>