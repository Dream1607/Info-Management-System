<?php
	include(__DIR__ . '/../lib.php');
	Config::loadCustom('/etc/Info/config.ini');

	$query = "INSERT INTO Activity_Student VALUES ('$_GET[activity]','$_GET[student]')";

	$activityStudentData = array();
	$activityStudentData[] = $_GET["activity"];
	$activityStudentData[] = $_GET["student"];
	
	$result = insert($activityStudentData, array(	'activity_id',
					 							 	'student_id'), 'Activity_Student');
?>