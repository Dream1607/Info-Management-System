<?php
	header("Content-type: text/html; charset=utf-8");
	session_start();
	
	require('../inc/template.inc');
	$tpl = new Template('../html');
	$tpl->set_file('deleteStudent', 'deleteStudent.html'); 
	
	include(__DIR__ . '/../lib.php');
	Config::loadCustom('/etc/Info/config.ini');

	$tpl->set_var("user","$_SESSION[info]");
	
	$tpl->pparse('output', 'deleteStudent');

	if(isset($_POST["submit"]))
	{
		 $Student_id = $_POST["no"];
		 
		 $checkExist = getOneNumber("SELECT id FROM Student WHERE id = '$Student_id'");

		 if($checkExist === NULL)
		 {
		 	 echo "<script language=\"JavaScript\">\r\n"; 
			 echo " alert(\"删除失败，不存在该学生信息！\");\r\n"; 
			 echo "</script>"; 
			 exit;	
		 }

		 getDb()->query("UPDATE Student SET status = 'deleted' WHERE id = '$Student_id'");	

     	 echo "<script language=\"JavaScript\">\r\n"; 
		 echo " alert(\"删除成功！\");\r\n"; 
		 echo "</script>"; 
		 exit;
	} 
?>