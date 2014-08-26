<?php
	session_start();
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
	
	<a href="../index.php"><img id="BigTitle" src="../pic/titlePic.png" width="1180" align="center"></img></a><br />
	
	<br /><br /><br /><br />
    <b>输入需要查询的学号</b>
    <br /><br />
	<form id="data" name="data" action="" method="post">

	    学号:  <input type="text" id="no" name="no"><br />
	    <br /><br /><br /><br />
	    <input id="checkConfirm" type="submit" name="submit" value="确认查询"/>
	</form>
    <?php
    	header("Content-type: text/html; charset=utf-8");
    	
    	include(__DIR__ . '/../lib.php');

		Config::loadCustom('/etc/Info/config.ini');

		if(isset($_POST["submit"]))
		{
			 $Student_id = $_POST["no"];

			 if(is_numeric($Student_id))
			 {
			  	if(strlen($Student_id) != 10)
			  	{
			  		echo "<script language=\"JavaScript\">\r\n"; 
					echo " alert(\"查询失败，请注意学号长度\");\r\n"; 
					echo "</script>"; 
					exit; 
			  	}
			 }
			 else 
			 {
			 	echo "<script language=\"JavaScript\">\r\n"; 
				echo " alert(\"查询失败，请输入数字\");\r\n"; 
				echo "</script>"; 
				exit;
			 }

			 $query = "SELECT 
			 					Activity_Student.student_id,
			 					Student.name AS student_name,
			 					Student.status AS student_status,		 				  	
			 					Activity.id,
			 				  	Activity.type,
			 				  	Activity.name AS activity_name,
			 				  	Activity.department,
			 				  	Activity.date,
			 				  	Activity.place,
			 				  	Activity.staff,
			 				  	Activity.status AS activity_status,
								Activity_Student.note
			 			FROM 
			 					Activity_Student
			 			LEFT JOIN 
			 					Activity ON Activity_Student.activity_id = Activity.id
			 			LEFT JOIN
			 					Student ON Activity_Student.student_id = Student.id
			 			WHERE 
			 					Activity_Student.student_id = '$Student_id'";

			 $checkAsStudentData = getSql( $query );
			 
			 getTable($checkAsStudentData,array('学号',
			 									'姓名',
			 									'学生状态',
			 									'活动代号',
												'类型',
												'活动名称',
												'主办部门',
												'日期',
												'地点',
												'负责人',
												'活动状态',
												'备注'),"border='1' align='center' width='888'");
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