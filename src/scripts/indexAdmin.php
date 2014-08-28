<?php
	header("Content-type: text/html; charset=utf-8");
	session_start();
	
	require('../inc/template.inc');
	$tpl = new Template('../html');
	$tpl->set_file('indexAdmin', 'indexAdmin.html');

	$tpl->pparse('output', 'indexAdmin');

	if(isset($_SESSION["info"]))
	{
		echo "<b>$_SESSION[info]你好!</b>";
		echo '<div>
				<form action="/index.php" method="post">
					<input id="logout" type="submit" name="exit" value="注销登录" />
				</form>	
			</div>';
	}
?>