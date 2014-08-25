<?php
	session_start();
?>
<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<head>
	<style type="text/css">
		b{
			position:fixed;
			background-color:black;
			border:0px;
			left:2%;
			top:2%;
			color:#C5CBCD;
			font-family:KaiTi;
			font-size:15px;
			font-weight:700;
		}
		#TransDiv{
				position:fixed;
				width:100%;
				top:0px;
				left:0px;
				height:6%;
				background-color:#000000;
			}
			
		#LogInDiv{
					position:fixed;
					background-color:black;
					border:0px;
					right:1%;
					top:1%;
					color:#C5CBCD;
					font-family:KaiTi;
					font-size:15px;
					font-weight:700;
				}

		.input1{
			position:absolute;
			left:0px;
			height:30px;
			width:80%;
			margin-top:30px;
			border-radius:5px;
			box-shadow: 0px 0px 5px #000;
			font-family:KaiTi;
			font-size:20px;
			font-weight:700;
			border:2px solid white;
			background-color:#54C4EA;
		}
		.input1:hover{
			height:30px;
			width:90%;
			border-radius:5px;
			box-shadow: 0px 0px 5px #000;
			font-family:KaiTi;
			font-size:20px;
			font-weight:700;
			border:2px solid white;
			background-color:white;
		}
		.input2{
			position:absolute;
			right:0px;
			height:30px;
			width:80%;
			margin-top:30px;
			border-radius:5px;
			box-shadow: 0px 0px 5px #000;
			font-family:KaiTi;
			font-size:20px;
			font-weight:700;
			border:2px solid white;
			background-color:#54C4EA;
		}
		.input2:hover{
			height:30px;
			width:90%;
			border-radius:5px;
			box-shadow: 0px 0px 5px #000;
			font-family:KaiTi;
			font-size:20px;
			font-weight:700;
			border:2px solid white;
			background-color:white;
		}
		.input3{
			height:100px;
			width:100px;
			border-radius:5px;
			box-shadow: 0px 0px 5px #000;
			font-family:KaiTi;
			font-size:20px;
			font-weight:700;
			border:2px solid white;
			background-color:#54C4EA;
		}
		.input3:hover{
			height:100px;
			width:100px;
			border-radius:5px;
			box-shadow: 0px 0px 5px #000;
			font-family:KaiTi;
			font-size:20px;
			font-weight:700;
			border:2px solid white;
			background-color:white;
		}
		#checkIn{
			position:absolute;
			left:0px;
			top:80px;
		}
		#checkOut{
			position:absolute;
			right:0px;
			top:80px;
		}
		#div1{
			position:absolute;
			height:50%;
			width:30%;
			top:45%;
			left:0px;
		}
		#div2{
			position:absolute;
			height:50%;
			width:30%;
			top:45%;
			right:0px;
		}
		#div3{
			position:absolute;
			height:50%;
			width:20%;
			top:45%;
			left:40%;
		}
	</style>
</head>
<body align="center" background="../pic/backgroundPic.jpg">
	<a href="../index.php"><img id="BigTitle" src="../pic/titlePic.png" width="1180" align="center"></img></a>
	<br />
	<div id="div1">
		<form action="addActivity.php">
		    <input class="input1" type="submit" name="submit" value="添加活动" />
		</form>

		<br>
		</br>
		<br>
		</br>
		
		<form action="deleteActivity.php">
		    <input class="input1" type="submit" name="submit" value="删除活动" />
		</form>

		<br>
		</br>
		<br>
		</br>

		<form action="addStudent.php">
		    <input class="input1" type="submit" name="submit" value="添加学生" />
		</form>

		<br>
		</br>
		<br>
		</br>

		<form action="deleteStudent.php">
		    <input class="input1" type="submit" name="submit" value="删除学生" />
		</form>
	</div>

	<div id="div2">	
	
		<form action="inquiryActivity.php">
		    <input class="input2" type="submit" name="submit" value="查询所有活动信息" />
		</form>
		
		<br>
		</br>
		<br>
		</br>

		<form action="inquiryStudent.php">
		    <input class="input2" type="submit" name="submit" value="查询所有学生信息" />
		</form>
		
		<br>
		</br>
		<br>
		</br>

		<form action="asActivity.php">
		    <input class="input2" type="submit" name="submit" value="活动签到情况查询" />
		</form>
		
		<br>
		</br>
		<br>
		</br>

		<form action="asStudent.php">
		    <input class="input2" type="submit" name="submit" value="学生参加活动查询" />
		</form>
	</div>

	<div id="div3">
		<form action="checkIn.php">
		    <input id="checkIn" class="input3" type="submit" name="submit" value="活动签到" />
		</form>    
		
		<br>
		</br> 
		<br>
		</br>
		
		<form action="checkOut.php">
		    <input id="checkOut" class="input3" type="submit" name="submit" value="取消签到" />
		</form>
	</div>
	    
	<div id="TransDiv">
		<form action="/scripts/registerManager.php">
			<input id="LogInDiv" type="submit" name="submit" value="添加管理员" />
		</form>	
	</div>
</body>
</html>
<?php
	if(isset($_SESSION["info"]))
	{
		echo "<b>$_SESSION[info]你好!</b>";
	}
?>