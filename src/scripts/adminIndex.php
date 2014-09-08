<?php 
	session_start();
	require('../inc/template.inc');
	$tpl = new Template('../html'); 
	$tpl->set_file('adminIndex', 'adminIndex.html');

	include(__DIR__ . '/../lib.php');
	Config::loadCustom('/etc/Info/config.ini');

	if(isset($_SESSION['info']))
	{
		if($_SESSION['info'] === 'info')
		{
			$tpl->set_var('studentbegin',"<!--");
			$tpl->set_var('managerbegin',"-->");
			$tpl->set_var('user',$_SESSION['info']);
		}
		else
		{
			$tpl->set_var('studentbegin',"<!--");
			$tpl->set_var('studentend',"-->");
			$tpl->set_var('managerbegin',"<!--");
			$tpl->set_var('managerend',"-->");
			$tpl->set_var('user',$_SESSION['info']);
		}
	}
	else if(isset($_SESSION['student']))
	{
		$tpl->set_var('studentend',"<!--");
		$tpl->set_var('managerend',"-->");
		$username = getOneNumber("SELECT name FROM Student WHERE id ='$_SESSION[student]'");
		$tpl->set_var('user',$username);
	}
	else
	{
		echo "<script>location='/index.php'</script>";
	}
	$tpl->pparse('output', 'adminIndex');
?>