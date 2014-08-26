<?php
	session_start();
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
		#login{
			width:5%;
		}
		#login:hover{
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
	    <input id="login" type="submit" name="submit" value="登录" />
	    <br />
	</form>

	<?php
    	header("Content-type: text/html; charset=utf-8");
    	
    	include(__DIR__ . '/../lib.php');

		Config::loadCustom('/etc/Info/config.ini');

		if(isset($_SESSION["info"]))
		{
			echo "<script>location='/scripts/indexAdmin.php'</script>";
		}

		if(isset($_POST["submit"]))
		{
			 $username = $_POST["username"];
			 $password = md5($_POST["password"]);

			 $checkUsers = getSql("SELECT * FROM Account");

			 foreach ($checkUsers as $index => $account) 
			 {
			 	if($username === $account['username'])
			 	{
			 		 if($password === $account['password'] && $account['status'] === 'default')
			 		 {
			 		 	$_SESSION['info'] = $username;
			 		 	echo "<script>location='/scripts/indexAdmin.php'</script>";
			 		 }
			 	}
			 }

			 echo "<script language=\"JavaScript\">\r\n"; 
			 echo "alert(\"用户名或密码错误！\");\r\n";
			 echo "</script>";
			 exit;
		}
	?>
</body>
</html>
