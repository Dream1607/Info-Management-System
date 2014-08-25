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
		#deleteConfirm{
			width:8%;
		}
		#deleteConfirm:hover{
			width:8%;
		}
	</style>
</head>
<body align="center" background="../pic/backgroundPic.jpg">
	
	<a href="../index.php"><img id="BigTitle" src="../pic/titlePic.png" width="1180" align="center"></img></a>
	
	<br /><br /><br /><br />
    <b>输入需要删除的学生信息</b>
    <br /><br />
	<form id="data" name="data" action="" method="post">

	    学生代号:  <input type="text" id="no" name="no"><br /></br></br>
	    
	    <input id="deleteConfirm" type="submit" name="submit" value="确认删除" onclick="return confirm('确认删除该学生全部的信息？')"/>
	</form></br>
    <?php
    	header("Content-type: text/html; charset=utf-8");
    	
    	include(__DIR__ . '/../lib.php');

		Config::loadCustom('/etc/Info/config.ini');

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
</body>
</html>
<?php
	if(isset($_SESSION["info"]))
	{
		echo "<b id='info'>$_SESSION[info]</b>";
	}
?>