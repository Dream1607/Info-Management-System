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
			font-size:18px;
			font-weight:700;
		}
		b{
			font-family:KaiTi;
			font-size:20px;
			font-weight:700;
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

	</br><br /><br /><br />
    <b>输入需要查询的活动类型</b>
    <br /><br/><br />

	<form id="data" name="data" action="" method="post">

	    活动类型:  
	    <select width="200" id="type" name="type">
		   <option value="全部类">全部类</option>
		   <option value="体育竞技类">体育竞技类</option>
		   <option value="文化艺术类">文化艺术类</option>
		   <option value="科技创新类">科技创新类</option>
		   <option value="志愿服务类">志愿服务类</option>
		   <option value="知识竞赛类">知识竞赛类</option>
		   <option value="娱乐放松类">娱乐放松类</option>
		   <option value="学术讲座类">学术讲座类</option>
		   <option value="经验交流类">经验交流类</option>
		   <option value="社会实践类">社会实践类</option>
		</select><br /><br /><br /><br />

	    
	    <input id="checkConfirm" type="submit" name="submit" value="确认查询"/>
	</form>

    <?php
    	header("Content-type: text/html; charset=utf-8");
    	
    	include(__DIR__ . '/../lib.php');

		Config::loadCustom('/etc/Info/config.ini');

		if(isset($_POST["submit"]))
		{
			 $type = $_POST["type"];

			 if($type == "全部类")
			 {
			 	$activityData = getSql("SELECT * FROM Activity");
			 }
			 else
			 {
			 	$activityData = getSql("SELECT * FROM Activity WHERE type = '$type'");
			 }
		     getTable($activityData,array(  '活动代号',
											'名称',
											'类型',
											'主办部门',
											'日期',
											'地点',
											'负责人',
											'状态'),"border='1' align='center' width='888'");
		} 
	?>
</body>
</html>