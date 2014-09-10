<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
    <meta name="author" content="">
    <title>中国人民大学信息学院</title>
    <link href="/bootstrap-3.2.0-dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background:url(/css/pic/background.jpg);background-repeat:no-repeat;">
    <div class="container-fluid" style="width:40%;position:relative;top:60px;">
      <form class="form-signin" role="form" action="" method="post"><br><br>
  	    <h1 class="form-signin-heading">校园活动管理系统<small><small>Ver_1.0.0_beta</small></small></h1>
  	    <h2 class="form-signin-heading"><small class="pull-right" style="color:lightgrey;">中国人民大学信息学院</small></h2>
  	    <br><br>
  	    <div class="form-group">
	      <label style="color:white;">账号</label>
	      <input type="username" class="form-control" name="username" placeholder="username" required autofocus>
	    </div>
	    <div class="form-group">
	      <label style="color:white;">密码</label>
	      <input type="password" class="form-control" name="password" placeholder="password" required>
	    </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">登陆</button>
      </form>
    </div>
</body>
</html>
<?php
	session_start();

	include(__DIR__ . '/lib.php');
	Config::loadCustom('/etc/Info/config.ini');

	if(isset($_SERVER['HTTP_REFERER']))
	{
		unset($_SESSION["info"]);
		unset($_SESSION["student"]);
	}

	if(isset($_POST["submit"]))
	{
		if(is_numeric($_POST["username"]))
		{
			 $username = $_POST["username"];
			 $password = $_POST["password"];

			 $checkUsers = getSql("SELECT id,status FROM Student");

			 foreach ($checkUsers as $account) 
			 {
			 	if($username === $account['id'] && $password === $account['id'] && $account['status'] === 'default')
			 	{
		 		 	$_SESSION['student'] = $username;
		 		 	echo "<script>location='/scripts/adminIndex.php'</script>";
		 		 	exit;
			 	}
			 }

			 echo "<script language=\"JavaScript\">\r\n"; 
			 echo "alert(\"用户名或密码错误！\");\r\n";
			 echo "</script>";
			 exit;
		}
		else
		{
			 $username = $_POST["username"];
			 $password = md5($_POST["password"]);

			 $checkUsers = getSql("SELECT * FROM Account");

			 foreach ($checkUsers as $account) 
			 {
			 	if($username === $account['username'] && $password === $account['password'] && $account['status'] === 'default')
			 	{
			 		 $_SESSION['info'] = $username;
			 		 echo "<script>location='/scripts/adminIndex.php'</script>";
			 		 exit;
			 	}
			 }

			 echo "<script language=\"JavaScript\">\r\n"; 
			 echo "alert(\"用户名或密码错误！\");\r\n";
			 echo "</script>";
			 exit;
		}
	}
?>