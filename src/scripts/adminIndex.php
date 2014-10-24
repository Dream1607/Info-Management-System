<?php 
	session_start();
	require('../inc/template.inc');
	$tpl = new Template('../html'); 
	$tpl->set_file('adminIndex', 'adminIndex.html');

	include(__DIR__ . '/../lib.php');
	Config::loadCustom('/etc/Info/config.ini');

	if(isset($_SESSION['info']))
	{
		if($_SESSION['info'] === 'info')
		{
			$query = "SELECT 
						name,
						type,
						department,
						date
					FROM 
						Activity
					WHERE 
						status != 'deleted'
					ORDER BY 
						Activity.date";
			$getActivityData = getSql( $query );
			
			$columnsName = array('活动名称','活动类型','活动部门','活动日期');
			$rowstart = '<tr>'; $rowend = '</tr>';
			$elestart = '<td>'; $eleend = '</td>';
			$current = '<table '.'class="table table-striped table-bordered table-hover"'.'>'.'<thead>';
			foreach($columnsName AS $name)
			{
				$current = $current.'<th scope="col">'.$name.'</th>';
			}
			$current = $current.'</thead>';
			$current = $current.'<tbody>';
			$current = $current.'<h3>快来看看都有哪些活动^_^<h3>';
			foreach($getActivityData AS $row)
			{
				$current = $current.$rowstart;
				foreach($row AS $element)
				{
					$current = $current.$elestart.$element.$eleend;
				}
				$current = $current.$rowend;
			}
			$current = $current.'</tbody>';
			$current = $current.'</table>';
			
			$tpl->set_var('Activity',$current);
			$tpl->set_var('studentbegin',"<!--");
			$tpl->set_var('managerbegin',"-->");
			$tpl->set_var('user',$_SESSION['info']);
		}
		else
		{
			$query = "SELECT 
						Activity.name,
						Activity.type,
						Activity.department,
						Activity.date
					FROM 
						Account_Activity 
					LEFT JOIN 
						Activity ON Activity.id = Account_Activity.activity_id
					LEFT JOIN 
						Account ON Account.id = Account_Activity.account_id
					WHERE 
						Account.username = '$_SESSION[info]'
					AND Activity.status != 'deleted'
					ORDER BY 
						Activity.date";
			$getActivityData = getSql( $query );
			if(empty($getActivityData))
			{
				$getActivityData = "你还没有发起任何活动呦!";
				$columnsName = array('活动名称','活动类型','活动部门','活动日期');
				$rowstart = '<tr>'; $rowend = '</tr>';
				$elestart = '<td colspan=4 align="center">'; $eleend = '</td>';
				$current = '<table '.'class="table table-striped table-bordered table-hover"'.'>'.'<thead>';
				foreach($columnsName AS $name)
				{
					$current = $current.'<th scope="col">'.$name.'</th>';
				}
				$current = $current.'</thead>';
				$current = $current.'<tbody>';
				$current = $current.'<h3>快来看看你发起了哪些活动^_^<h3>';
				$current = $current.$rowstart.$elestart."<h4>$getActivityData<h4>".$eleend.$rowend;
				$current = $current.'</tbody>';
				$current = $current.'</table>';
			}
			else
			{
				$columnsName = array('活动名称','活动类型','活动部门','活动日期');
				$rowstart = '<tr>'; $rowend = '</tr>';
				$elestart = '<td>'; $eleend = '</td>';
				$current = '<table '.'class="table table-striped table-bordered table-hover"'.'>'.'<thead>';
				foreach($columnsName AS $name)
				{
					$current = $current.'<th scope="col">'.$name.'</th>';
				}
				$current = $current.'</thead>';
				$current = $current.'<tbody>';
				$current = $current.'<h3>快来看看你发起了哪些活动^_^<h3>';
				foreach($getActivityData AS $row)
				{
					$current = $current.$rowstart;
					foreach($row AS $element)
					{
						$current = $current.$elestart.$element.$eleend;
					}
					$current = $current.$rowend;
				}
				$current = $current.'</tbody>';
				$current = $current.'</table>';
			}
			$tpl->set_var('Activity',$current);

			$tpl->set_var('studentbegin',"<!--");
			$tpl->set_var('studentend',"-->");
			$tpl->set_var('managerbegin',"<!--");
			$tpl->set_var('managerend',"-->");
			$tpl->set_var('user',$_SESSION['info']);
		}
	}
	else if(isset($_SESSION['student']))
	{
		$query = "SELECT 
						Activity.name,
						Activity.type,
						Activity.department,
						Activity.date
					FROM 
						Activity 
					LEFT JOIN 
						Activity_Student ON Activity.id = Activity_Student.activity_id
					WHERE 
						Activity_Student.student_id = '$_SESSION[student]'
					AND Activity.status != 'deleted'
					AND Activity_Student.status != 'deleted'
					ORDER BY 
						Activity.date";
		$getActivityData = getSql( $query );
		if(empty($getActivityData))
		{
			$getActivityData = "你还没有参加任何活动呦!";
			$columnsName = array('活动名称','活动类型','活动部门','活动日期');
			$rowstart = '<tr>'; $rowend = '</tr>';
			$elestart = '<td colspan=4 align="center">'; $eleend = '</td>';
			$current = '<table '.'class="table table-striped table-bordered table-hover"'.'>'.'<thead>';
			foreach($columnsName AS $name)
			{
				$current = $current.'<th scope="col">'.$name.'</th>';
			}
			$current = $current.'</thead>';
			$current = $current.'<tbody>';
			$current = $current.'<h3>快来看看你参加了哪些活动^_^<h3>';
			$current = $current.$rowstart.$elestart."<h4>$getActivityData<h4>".$eleend.$rowend;
			$current = $current.'</tbody>';
			$current = $current.'</table>';
		}
		else
		{
			$columnsName = array('活动名称','活动类型','活动部门','活动日期');
			$rowstart = '<tr>'; $rowend = '</tr>';
			$elestart = '<td>'; $eleend = '</td>';
			$current = '<table '.'class="table table-striped table-bordered table-hover"'.'>'.'<thead>';
			foreach($columnsName AS $name)
			{
				$current = $current.'<th scope="col">'.$name.'</th>';
			}
			$current = $current.'</thead>';
			$current = $current.'<tbody>';
			$current = $current.'<h3>快来看看你参加了哪些活动^_^<h3>';
			foreach($getActivityData AS $row)
			{
				$current = $current.$rowstart;
				foreach($row AS $element)
				{
					$current = $current.$elestart.$element.$eleend;
				}
				$current = $current.$rowend;
			}
			$current = $current.'</tbody>';
			$current = $current.'</table>';
		}
		$tpl->set_var('Activity',$current);

		$tpl->set_var('studentend',"<!--");
		$tpl->set_var('managerend',"-->");
		$username = getOneNumber("SELECT name FROM Student WHERE id ='$_SESSION[student]'");
		$tpl->set_var('user',$username);
	}
	else
	{
		echo "<script>location='/index.php'</script>";
	}
	$tpl->pparse('output', 'adminIndex');
?>