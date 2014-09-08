<?php
	header("Content-type: text/html; charset=utf-8");
	session_start();

    if(!isset($_SESSION['info']))
    {
        echo "<script language=\"JavaScript\">\r\n";
        echo " alert(\"您尚未登陆\");\r\n";
        echo "location='/index.php'";
        echo "</script>";
        exit;
    }

	require('../inc/template.inc');
	$tpl = new Template('../html');
	$tpl->set_file('global', 'global.html'); 
	$tpl->set_var("user",$_SESSION['info']);

	$type = $_GET['type'];
	
	$tpl->set_var('start',"<!--");
	$tpl->set_var('managerend',"-->");

	if($type === 'addManager')
	{
		$tpl->set_var("operationName","添加管理员");
	}
	else
	{
		$tpl->set_var("operationName","删除管理员");
	}

	$tpl->pparse('output', 'global');

	if(isset($_POST['submit']))
	{
		include(__DIR__ . '/../lib.php');
		Config::loadCustom('/etc/Info/config.ini');
		
		$input = array();
		$input['username'] = $_POST['username'];
		$input['password'] = $_POST['password1'];
		$input['password'] = $_POST['password2'];

		if(validate($input))
		{
			if($type === 'addManager')
			{
			    $username = $_POST["username"];
                $password1 = md5($_POST["password1"]);
                $password2 = md5($_POST["password2"]);
                
                if($password1 != $password2)
                {
                    echo "<script language=\"JavaScript\">\r\n";
                    echo "alert(\"密码不一致！\");\r\n";
                    echo "location='/scripts/manager.php'";
                    echo "</script>";
                    exit;
                }
                $checkUsers = getSql("SELECT * FROM Account");
                foreach ($checkUsers as $account)
                {
                    if($username === $account['username'])
                    {
                        echo "<script language=\"JavaScript\">\r\n";
                        echo "alert(\"该用户名已存在\");\r\n";
                        echo "location='/scripts/manager.php'";
                        echo "</script>";
                        exit;
                    }
                }
                $userData = array();
                $userData[] = $username;
                $userData[] = $password1;
                $result = insert($userData, array(	'username',
                'password'), 'Account');
                echo "<script language=\"JavaScript\">\r\n";
                echo " alert(\"添加成功！\");\r\n";
                echo "location='/scripts/manager.php'";
                echo "</script>";
                exit;
			}
			else
			{
                $checkUsers = getSql("SELECT * FROM Account WHERE username = '$input[username]'");
                if(empty($checkUsers))
                {
                    echo "<script language=\"JavaScript\">\r\n";
                    echo " alert(\"不存在该管理员账号\");\r\n";
                    echo "location='/scripts/manager.php'";
                    echo "</script>";
                    exit;
                }
                else
                {
                    getDb()->query("UPDATE Account SET status = 'deleted' WHERE username = '$input[username]'");
                    echo "<script language=\"JavaScript\">\r\n";
                    echo " alert(\"删除成功\");\r\n";
                    echo "location='/scripts/manager.php'";
                    echo "</script>";
                    exit;
                }
			}
		}
        echo "<script language=\"JavaScript\">\r\n";
        echo " alert(\"用户名不要有特殊字符哦,请注意密码应在6-16位！\");\r\n";
        echo "location='/scripts/manager.php'";
        echo "</script>";
        exit;
	}
?>