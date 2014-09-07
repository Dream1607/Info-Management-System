<?php
	header("Content-type: text/html; charset=utf-8");
	session_start();

	require('../inc/template.inc');
	$tpl = new Template('../html');
	$tpl->set_file('global', 'global.html'); 
	$tpl->set_var("user",$_SESSION['student']);

	$type = $_GET['type'];

	$tpl->set_var('start',"<!--");
	$tpl->set_var('activitystart',"-->");
	$tpl->set_var('managerend',"<!--");
	$tpl->set_var('end',"-->");


	if($type === 'addStudent')
	{
		$tpl->set_var("operationName","添加学生");
	}
	else
	{
		$tpl->set_var("operationName","删除学生");
	}

	$tpl->pparse('output', 'global');

	if(isset($_POST['submit']))
	{
		include(__DIR__ . '/../lib.php');
		Config::loadCustom('/etc/Info/config.ini');
		
		$input = array();
		$input['student_id'] = $_POST['number'];
		$input['student_name'] = $_POST['name'];
		$input['student_gender'] = $_POST['gender'];
		$input['student_major'] = $_POST['major'];
		$input['student_grade'] = $_POST['grade'];
		$input['student_class'] = $_POST['class'];

		if(validate($input))
		{
			if($type === 'addStudent')
			{
                            if(!insert($input, array('id','name','gender','major','grade','class'), 'Student'))
                            {
                                die(0);
                            }
			}
			else
			{
                            getDb()->query("UPDATE Student SET status = 'deleted' WHERE id = '$input[student_id]'");
			}
		}
	}
?>