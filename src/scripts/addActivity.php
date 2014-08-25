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
		form{
			font-family:KaiTi;
			font-size:18px;
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
			height:23.5px;
			width:13%;
			border-radius:5px;
			box-shadow: 0px 0px 5px #000;
			font-family:KaiTi;
			font-size:16px;
			font-weight:700;
			border:2px solid white;
			background-color:#54C4EA;
		}
		input:hover{
			height:23.5px;
			width:13%;
			border-radius:5px;
			box-shadow: 0px 0px 5px #000;
			font-family:KaiTi;
			font-size:16px;
			font-weight:700;
			border:2px solid white;
			background-color:white;
		}
		select{
			height:23.5px;
			width:13%;
			border-radius:5px;
			box-shadow: 0px 0px 5px #000;
			font-family:KaiTi;
			font-size:16px;
			font-weight:700;
			border:2px solid white;
			background-color:#54C4EA;
		}
		select:hover{
			height:23.5px;
			width:13%;
			border-radius:5px;
			box-shadow: 0px 0px 5px #000;
			font-family:KaiTi;
			font-size:16px;
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
	</br>
    <b>输入需要添加的活动信息</b>
    <br /><br/>
	<form id="data" name="data" action="" method="post">
		活动类型:
		<select width="200" id="type" name="type">
		   <option value="体育竞技类">体育竞技类</option>
		   <option value="文化艺术类">文化艺术类</option>
		   <option value="科技创新类">科技创新类</option>
		   <option value="志愿服务类">志愿服务类</option>
		   <option value="知识竞赛类">知识竞赛类</option>
		   <option value="娱乐放松类">娱乐放松类</option>
		   <option value="学术讲座类">学术讲座类</option>
		   <option value="经验交流类">经验交流类</option>
		   <option value="社会实践类">社会实践类</option>
		</select><br /><br/>
	    主办部门:
		<select width="200" id="department" name="department">
		   <option value="体育部">体育部</option>
		   <option value="文化部">文化部</option>
		   <option value="外联部">外联部</option>
		   <option value="实践部">实践部</option>
		   <option value="团宣部">团宣部</option>
		   <option value="团组部">团组部</option>
		   <option value="学习部">学习部</option>
		   <option value="信息宣">信息宣</option>
		   <option value="办公室">办公室</option>
		   <option value="青年志愿者协会">青年志愿者协会</option>
		   <option value="计算机协会">计算机协会</option>
		   <option value="信息月刊">信息月刊</option>
		   <option value="信息学院辩论队">信息学院辩论队</option>
		   <option value="党总支">党总支</option>
		   <option value="研究生会">研究生会</option>
		</select><br /><br/>
	    活动名称: <input type="text" id="name" name="name"><br /><br/>
	    活动日期:  <input type="date" id="date" name="date"><br /><br/>
	    活动地点:  <input type="text" id="place" name="place"><br /><br/>
	    录入人员:  <input type="text" id="staff" name="staff"><br /><br/>
	    
	    <input id="checkConfirm" type="submit" name="submit" value="确认添加"/>
	</form>
    <?php
    	header("Content-type: text/html; charset=utf-8");
    	
    	include(__DIR__ . '/../lib.php');

		Config::loadCustom('/etc/Info/config.ini');
    	
    	date_default_timezone_set("PRC");

		if(isset($_POST["submit"]))
		{
			 $activityData = array();
			
			//sanitize input
			if(preg_match("/^[\x{4e00}-\x{9fa5}]+$/u",$_POST["type"])){
				$activityData[] = $_POST["type"];
			}else die("Error: Type");
			
			if(preg_match("/^[\x{4e00}-\x{9fa5}]+$/u",$_POST["department"])){
				$activityData[] = $_POST["department"];
			}else die("Error: Department");
			
			if(preg_match("/^[\x{4e00}-\x{9fa5}A-Za-z0-9._-]+$/u",$_POST["name"])){
				$activityData[] = $_POST["name"];
			}else die("Error: Name");
			 
			if(DATE('Y-m-d',strtotime($_POST["date"])) == $_POST["date"]){
				$activityData[] = $_POST["date"];
			}else die("Error: Date");
			 
			if(preg_match("/^[\x{4e00}-\x{9fa5}A-Za-z0-9._-]+$/u",$_POST["place"])){
				$activityData[] = $_POST["place"];
			}else die("Error: Place");
			 
			if(preg_match("/^[\x{4e00}-\x{9fa5}A-Za-z0-9._-]+$/u",$_POST["staff"])){
				$activityData[] = $_POST["staff"];
			}else die("Error: Staff");
			

			 $result = insert($activityData, array(	 'type',
						 							 'department',
						 							 'name',
						 							 'date',
						 							 'place',
						 							 'staff'), 'Activity');
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