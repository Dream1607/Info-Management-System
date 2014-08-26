<?php
	session_start();
	if(isset($_POST["submit"]))
	{
		unset($_SESSION["info"]);
	}
	if(!isset($_SESSION["info"]))
	{
		echo '<div id="TransDiv">
				<form action="/scripts/loginManager.php">
					<input id="LogInDiv" type="submit" name="submit" value="管理员登录" />
				</form>	
			</div>';
	}
	else
	{
		echo '<div id="TransDiv">
				<form action="/scripts/loginManager.php">
					<input id="LogInDiv" type="submit" name="submit" value="进入管理员界面" />
				</form>	
			</div>';
	}
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
					top:2%;
					color:#C5CBCD;
					font-family:KaiTi;
					font-size:15px;
					font-weight:700;
				}
				
				#LogInDiv:hover{
					position:fixed;
					right:1%;
					top:2%;
					color:#FFFFFF;
					font-family:KaiTi;
					font-size:15px;
					font-weight:700;
				}

			#TitleDiv{
				position:absolute;
				top:6%;
				left:0px;
				width:100%;
				height:90%;
			}
				
				#TitleImage{
					position:absolute;
					top:170px;
					left:100px;
					width:1120px;
					height:240px;
				}
				
				#TitleBackImage{
					width:100%;
					height:100%;
					overflow:hidden;
				}
				
			#BodyDiv{
				position:absolute;
				top:92%;
				left:0px;
				width:100%;
				height:8%;
				
			}

				.CheckBox{		
					height:50px;
					width:30%;
					border-radius:5px;
					box-shadow: 0px 0px 5px #000;
					font-family:KaiTi;
					font-size:25px;
					font-weight:700;
					border:2px solid white;
					background-color:#54C4EA;
				}
				
				.CheckBox:hover{		
					height:50px;
					width:30%;
					border-radius:5px;
					box-shadow: 0px 0px 5px #000;
					font-family:KaiTi;
					font-size:25px;
					font-weight:700;
					border:2px solid white;
					background-color:white;
				}
				
				#CheckBox1{
					position:absolute;
					top:0px;
					left:20%;
				}
				
				#CheckBox2{
					position:absolute;
					top:0px;
					left:50%;		
		}
	</style>
</head>

<body>
	
	<div id="TitleDiv">

		<img id="TitleImage" src="pic/titlePic.png" width="1180" align="center"></img>
		<img id="TitleBackImage" src="pic/backgroundPic.jpg" ></img>
		
	</div>
	
	<div id="BodyDiv">
		<form action="/scripts/asActivity.php">
			<input class="CheckBox" id="CheckBox1" type="submit" name="submit" value="活动签到情况查询" />
		</form>	
		<form action="/scripts/asStudent.php">
			<input class="CheckBox" id="CheckBox2" type="submit" name="submit" value="学生参加活动查询" />
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
