<?php
	header("Content-type: text/html; charset=utf-8");
	session_start();

	require('../inc/template.inc');
	$tpl = new Template('../html');
	$tpl->set_file('asActivity', 'asActivity.html'); 
	
	include(__DIR__ . '/../lib.php');
	Config::loadCustom('/etc/Info/config.ini');

	if(isset($_SESSION["info"]))
	{
		$tpl->set_var("status","$_SESSION[info]");
	}

	$tpl->pparse('output', 'asActivity');
	
	if(!isset($_POST["submit"])) 
	{
	    require('getActivity.php');
	} 
	else
	{
	    $type = $_POST["type"];
	    $department = $_POST["department"];
	    $name = $_POST["name"];

	    $query = "SELECT
	                    *
	              FROM 
	              		Activity
	              WHERE
	                    IF ('$type' = 'default', 0 = 0, type = '$type')
	                AND IF ('$department' = 'default', 0 = 0, department = '$department')
	                AND IF ('$name' = '', 0 = 0, name = '$name')";
	    $checkAsActivityData = getSql( $query );

	    getTable($checkAsActivityData,array('活动代号',
	                                        '活动名称',
	                                        '活动类型',
	                                        '活动部门',
	                                        '活动日期',
	                                        '活动地点',
	                                        '负责人',
	                                        '活动状态'),"border='1' align='center' width='888'");
	}
?>