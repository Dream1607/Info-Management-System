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
    <b>输入需要删除的活动信息</b>
    <br /><br />
	<form id="data" name="data" action="" method="post">

	    活动代号:  <input type="text" id="no" name="no"><br /></br>
	    
	    <input id="deleteConfirm" type="submit" name="submit" value="确认删除" onclick="return confirm('确认删除该活动全部的信息？')" />
	</form></br>
    <?php
    	header("Content-type: text/html; charset=utf-8");
    	
    	include(__DIR__ . '/../lib.php');

		Config::loadCustom('/etc/Info/config.ini');

		if(isset($_POST["submit"]))
		{
			 $Activity_id = $_POST["no"];

			 $checkExist = getOneNumber("SELECT id FROM Activity WHERE id = '$Activity_id'");

			 if($checkExist === NULL)
			 {
			 	 echo "<script language=\"JavaScript\">\r\n"; 
				 echo " alert(\"删除失败，不存在该活动信息！\");\r\n"; 
				 echo "</script>"; 
				 exit;	
			 }

			 getDb()->query("UPDATE Activity SET status = 'deleted' WHERE id = '$Activity_id'");	

         	 echo "<script language=\"JavaScript\">\r\n"; 
			 echo " alert(\"删除成功！\");\r\n"; 
			 echo "</script>"; 
			 exit;
		} 
	?>
</body>
</html>