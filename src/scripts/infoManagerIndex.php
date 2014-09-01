<?php 
	require('../inc/template.inc');

	session_start();

	$tpl = new Template('../html'); 
	$tpl->set_file('infoManagerIndex', 'infoManagerIndex.html');

	include(__DIR__ . '/../lib.php');
	Config::loadCustom('/etc/Info/config.ini');

	$tpl->set_var('user', $_SESSION['info']);

	$tpl->pparse('output', 'infoManagerIndex');
?>