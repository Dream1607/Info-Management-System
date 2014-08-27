<?php
	session_start();
?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<head>
        <script src="/js/asActivity.js"></script>
	<link href="/css/asActivity.css" rel="stylesheet" type="text/css">
</head>
<body align="center" background="../pic/backgroundPic.jpg">
	
    <a href="../index.php"><img id="BigTitle" src="../pic/titlePic.png" width="1180" align="center"></img></a><br />

    <br /><br />
	<form id="data" name="data" action="" method="post">
                活动名称: <input type="text" id="name" name="name" oninput="showActivity(this.name,this.value)">
		活动类型:
                <select width="200" id="type" name="type" onchange="showActivity(this.name,this.value)">
		   <option value="default">不限制</option>
		   <option value="体育竞技类">体育竞技类</option>
		   <option value="文化艺术类">文化艺术类</option>
		   <option value="科技创新类">科技创新类</option>
		   <option value="志愿服务类">志愿服务类</option>
		   <option value="知识竞赛类">知识竞赛类</option>
		   <option value="娱乐放松类">娱乐放松类</option>
		   <option value="学术讲座类">学术讲座类</option>
		   <option value="经验交流类">经验交流类</option>
		   <option value="社会实践类">社会实践类</option>
		</select>
	    主办部门:
		<select width="200" id="department" name="department" onchange="showActivity(this.name,this.value)">
		   <option value="default">不限制</option>
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
		</select>
            <input id="checkConfirm" type="submit" name="submit" value="确认查询"/>
	</form><br/>
        <div id="activityTable"><?php 
                                    if(!isset($_POST["submit"])) 
                                    {
                                        require('ajax_getActivity.php');
                                    } else {
                                        include(__DIR__ . '/../lib.php');
                                        Config::loadCustom('/etc/Info/config.ini');
                                        header("Content-Type: text/html; charset=utf-8");

                                        $type = $_POST["type"];
                                        $department = $_POST["department"];
                                        $name = $_POST["name"];
                                        $query = "SELECT
                                                        *    
                                                  FROM activity
                                                  WHERE
                                                        IF ('$type' = 'default', 0 = 0, type = '$type')
                                                    AND IF ('$department' = 'default', 0 = 0, department = '$department')
                                                    AND IF ('$name' = '', 0 = 0, name = '$name')";
                                        $checkAsActivityData = getSql( $query );
                                        getTable($checkAsActivityData,array('活动代号',
                                                                            '活动名称',
                                                                            '活动类型',
                                                                            '活动部门',
                                                                            '活动日期',
                                                                            '活动地点',
                                                                            '录入人员',
                                                                            '活动状态'),"border='1' align='center' width='888'");
                                    }
                                    ?></div>
	<br />
</body>
</html>
<?php
	if(isset($_SESSION["info"]))
	{
		echo "<b id='info'>$_SESSION[info]</b>";
	}
?>