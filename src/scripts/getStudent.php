<?php
	header("Content-type: text/html; charset=utf-8");
	session_start();
	
	require('../inc/template.inc');
	$tpl = new Template('../html');
	$tpl->set_file('getStudent', 'getStudent.html'); 
	
	include(__DIR__ . '/../lib.php');
	Config::loadCustom('/etc/Info/config.ini');

	$tpl->set_var("activity","$_GET[activity]");
	
	$tpl->pparse('output', 'getStudent');

	$query = "SELECT name FROM Activity WHERE id = '$_GET[activity]'";
	$activityName = getOneNumber( $query );

	$query = "SELECT * FROM Student";
	$getStudentData = getSql( $query );

	$columnsName = array('学号','姓名','性别','专业','年级','班级','状态');

	$rowstart = '<tr>'; $rowend = '</tr>';
	$elestart = '<td>'; $eleend = '</td>';
	echo '<table '."border='1' align='center' width='888'".'>'.'<thead>';
	foreach($columnsName AS $name)
	{
		echo '<th scope="col">'.$name.'</th>';
	}
	echo '</thead>';
	echo '<tbody>';

	foreach($getStudentData AS $row)
	{
		echo $rowstart;
		foreach($row AS $element)
		{
			echo $elestart.$element.$eleend;
		}
		echo "<td><input type='checkbox' onclick='mark(this);'/></td>";
		echo $rowend;
	}
	echo '</tbody>';
	echo '</table>';
?>