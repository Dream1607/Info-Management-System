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
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<head>
	<style type="text/css">
		table{
			background-color:rgba(255,255,255,0.7);
			font-family:KaiTi;
			text-align:center;
			border:3px solid;
			border-color:#005AB5;
		}
		form{
			font-family:KaiTi;
			font-size:20px;
			font-weight:700;
		}
		b{
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
			font-size:15px;
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
		#checkConfirm{
			width:8%;
		}
		#checkConfirm:hover{
			width:8%;
		}
	</style>
</head>
<body align="center" background="../pic/backgroundPic.jpg">
	
	<a href="../index.php"><img id="BigTitle" src="../pic/titlePic.png" width="1180" align="center"></img></a>


	<br /><br /><br /><br />
    <b>输入需要签到的活动代号和学生代号</b>
    <br /><br />
	<form id="data" name="data" action="" method="post">

	    活动代号:  <input type="text" id="Ano" name="Ano"><br /></br>
	    学生代号: <input type="text" id="Sno" name="Sno"><br /><br />
	    备注: <input type="text" id="note" name="note"><br /><br />
	    
	    <input id="checkConfirm" type="submit" name="submit" value="签到" />
	</form></br>
    <?php
    	header("Content-type: text/html; charset=utf-8");
    	
    	include(__DIR__ . '/../lib.php');

		Config::loadCustom('/etc/Info/config.ini');

		if(isset($_POST["submit"]))
		{
			 $checkInData = array();
			 $checkInData[] = $_POST["Ano"];
			 $checkInData[] = $_POST["Sno"];
			 $checkInData[] = $_POST["note"];

			 $checkStudentExist = getOneNumber("SELECT id FROM Student WHERE id = '$_POST[Sno]'");

			 $checkActivityExist = getOneNumber("SELECT id FROM Activity WHERE id = '$_POST[Ano]'");

			 if($checkStudentExist === NULL || $checkActivityExist === NULL)
			 {
			 	 echo "<script language=\"JavaScript\">\r\n"; 
				 echo " alert(\"签到失败，请检查是否存在该学生或该活动！\");\r\n"; 
				 echo "</script>"; 
				 exit;	
			 }

			 $result = insert($checkInData, array(	 'activity_id',
						 							 'student_id',
						 							 'note'), 'Activity_Student');
			 if($result)
			 {
			 	 echo "<script language=\"JavaScript\">\r\n"; 
				 echo " alert(\"签到成功！\");\r\n"; 
				 echo "</script>"; 
				 exit;	
			 }
			 else
			 {
			 	 echo "<script language=\"JavaScript\">\r\n"; 
				 echo " alert(\"签到失败，请检查是否存在该学生或该活动！\");\r\n"; 
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