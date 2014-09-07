<?php
	header("Content-type: text/html; charset=utf-8");
	session_start();

	require('../inc/template.inc');
	$tpl = new Template('../html');
	$tpl->set_file('global', 'global.html'); 
	$tpl->set_var("user","$_SESSION[info]");

	$type = $_GET['type'];

	$tpl->set_var('activitystart',"<!--");
	$tpl->set_var('end',"-->");

	if($type === 'addActivity')
	{
		$tpl->set_var("operationName","发起活动");
	}
	else if($type === 'closeActivity')
	{
		$tpl->set_var("operationName","关闭活动");
	}
	else if($type === 'deleteActivity')
	{
		$tpl->set_var("operationName","删除活动");
	}
        else
        {
            die("无效的页面！");
        }
        
	$tpl->pparse('output', 'global');

	if(isset($_POST['submit']))
	{
		include(__DIR__ . '/../lib.php');
		Config::loadCustom('/etc/Info/config.ini');
		
		$input = array();
		$input['activity_name'] = $_POST['name'];
		$input['activity_type'] = $_POST['type'];
		$input['activity_department'] = $_POST['department'];
		$input['activity_date'] = $_POST['date'];
		$input['activity_place'] = $_POST['place'];
		$input['activity_sponsor'] = $_POST['sponsor'];

		if(validate($input))
		{
                    if($type === 'addActivity')
                    {
                        if(!insert($input, array('name','type','department','date','place','staff'), 'Activity'))
                        {
                            die(0);
                        }

                        $accountId = getOneNumber("SELECT id FROM Account WHERE username = '$_SESSION[info]'");
                        $activityId = getOneNumber("SELECT id FROM Activity ORDER BY id DESC LIMIT 1");

                        $accountActivityData = array();
                        $accountActivityData[] = $accountId;
                        $accountActivityData[] = $activityId;

                        if(!insert($accountActivityData, array('account_id','activity_id'), 'Account_Activity'))
                        {
                            die(0);
                        }
                    }
                    else if($type === 'closeActivity')
                    {
                        $activity_id = getOneNumber("SELECT id FROM Activity WHERE name = '$input[activity_name]'");
                        getDb()->query("UPDATE Activity SET status = 'closed' WHERE id = '$activity_id'");
                    }
                    else
                    {
                        $activity_id = getOneNumber("SELECT id FROM Activity WHERE name = '$input[activity_name]'");
                        getDb()->query("UPDATE Activity SET status = 'deleted' WHERE id = '$activity_id'");
                    }
		}
	}
?>