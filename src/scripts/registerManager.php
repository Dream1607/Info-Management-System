<?php
	session_start();
	if(!isset($_SESSION["info"]))
	{
		echo "<script language=\"JavaScript\">\r\n"; 
		echo "alert(\"您尚未登录！\");\r\n";
		echo "location='/scripts/loginManager.php'";
		echo "</script>"; 
	}
?>
<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<head>
	<style type="text/css">
		form{
			font-family:KaiTi;
			font-size:20px;
			font-weight:700;
		}
		#info{
			position:fixed;
			border:0px;
			left:2%;
			top:2%;
			color:black;
			font-family:KaiTi;
			font-size:15px;
			font-weight:700;
		}
		input{
			height:30px;
			width:15%;
			border-radius:5px;
			box-shadow: 0px 0px 5px #000;
			font-family:KaiTi;
			font-size:20px;
			font-weight:700;
			border:2px solid white;
			background-color:#54C4EA;
		}
		input:hover{
			height:30px;
			width:15%;
			border-radius:5px;
			box-shadow: 0px 0px 5px #000;
			font-family:KaiTi;
			font-size:20px;
			font-weight:700;
			border:2px solid white;
			background-color:white;
		}
		#signup{
			width:5%;
		}
		#signup:hover{
			width:5%;
		}
	</style>
</head>
<body align="center" background="../pic/backgroundPic.jpg"> 
	
	<a href="../index.php"><img id="BigTitle" src="../pic/titlePic.png" width="1180" align="center"></img></a><br />

	<br /><br /><br /><br />
	<form action="" method="post">
		账号：<input type="text" name="username" />
		<br /><br />
		密码：<input type="password" name="password"/>
		<br /><br /><br /><br />
	    <input id="signup" type="submit" name="submit" value="添加" />
	    <br />
	</form>

	<?php
    	header("Content-type: text/html; charset=utf-8");
    	
    	include(__DIR__ . '/../lib.php');

		Config::loadCustom('/etc/Info/config.ini');

		if(isset($_POST["submit"]))
		{
			 $userData = array();
			 $userData[] = $_POST["username"];
			 $userData[] = md5($_POST["password"]);

			 $checkUsers = getSql("SELECT username FROM Account");
			 
			 foreach ($checkUsers as $index => $name) 
			 {
			 	if(in_array($_POST["username"],$name))
			 	{
			 		 echo "<script language=\"JavaScript\">\r\n"; 
					 echo " alert(\"该用户名已存在！\");\r\n"; 
					 echo "</script>"; 
					 exit;	
			 	}
			 }
			 
			 $result = insert($userData, array(	 'username',
						 						 'password'), 'Account');
			 if($result)
			 {
			 	 echo "<script language=\"JavaScript\">\r\n"; 
				 echo " alert(\"添加成功！\");\r\n"; 
				 echo "</script>"; 
				 exit;	
			 }
			 else
			 {
			 	 echo "<script language=\"JavaScript\">\r\n"; 
				 echo " alert(\"添加失败，请注意该活动信息的完整性！\");\r\n"; 
				 echo "</script>"; 
				 exit;
			 }
		} 
	?> 
</body>
</html>
<?php
	if(isset($_SESSION["info"]))
	{
		echo "<b id='info'>$_SESSION[info]</b>";
	}
?>