<?php
	header("Content-type: text/html; charset=utf-8");
	session_start();

	if(!isset($_SESSION['info']) && !isset($_SESSION['student']))
    {
        echo "<script language=\"JavaScript\">\r\n";
        echo " alert(\"您尚未登陆\");\r\n";
        echo "location='/index.php'";
        echo "</script>";
        exit;
    }

	require('../inc/template.inc');
	$tpl = new Template('../html');
	$tpl->set_file('inquire', 'inquire.html'); 
	
    $tpl->set_var('script', '<script type="text/javascript" src="/js/getActivity.js"></script>');
	$tpl->set_var('middle',"<!--");
	$tpl->set_var('end',"-->");
	
	$tpl->pparse('output', 'inquire');
?>