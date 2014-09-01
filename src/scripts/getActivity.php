<?php
    include(__DIR__ . '/../lib.php');
    Config::loadCustom('/etc/Info/config.ini');

    if(isset($_SERVER['HTTP_REFERER']) && strstr($_SERVER['HTTP_REFERER'],"asStudent"))
    {
        header("Content-type: text/html; charset=utf-8");
        session_start();

        require('../inc/template.inc');
        $tpl = new Template('../html');
        $tpl->set_file('getActivity', 'getActivity.html'); 

        $tpl->pparse('output', 'getActivity');
            
        if(isset($_GET['student']))
        {
            if(is_numeric($_GET['student']))
            {
                $student = $_GET['student'];
                $query = "SELECT Activity.* FROM Activity_student LEFT JOIN Activity ON Activity.id = Activity_student.activity_id WHERE Activity_student.student_id = '$student'";
                $getActivityData = getSql( $query );
                
                getTable($getActivityData,array(    '活动代号',
                                                    '活动名称',
                                                    '活动类型',
                                                    '活动部门',
                                                    '活动日期',
                                                    '活动地点',
                                                    '录入人员',
                                                    '活动状态'),"border='1' align='center' width='888'");
            }
            else
            {
                die("Invalid Student ID");
            }
        }
        else
        {
            die("Need A Student ID");
        }
        
    } 
    else 
    { 
        if(isset($_SERVER['HTTP_REFERER']) && strstr($_SERVER['HTTP_REFERER'],"checkList"))
        {
            session_start();

            $accountId = getOneNumber("SELECT id FROM Account WHERE username = '$_SESSION[info]'");
            $activityId = getSql("SELECT activity_id FROM Account_Activity WHERE account_id = '$accountId'");

            $activityIn = array();

            foreach ($activityId as $value) 
            {
                $activityIn[] = $value["activity_id"]; 
            }
            $activityIn = "IN "."('".implode("','", array_unique( $activityIn ) )."')";
        }
        else
        {
            $activityIn = "NOT IN ('')";
        }

        if( isset($_GET["name"]) && $_GET['name'] != '')
        {
            if( preg_match("/^[\x{4e00}-\x{9fa5}A-Za-z0-9._-]+$/u",$_GET["name"]) )
            {
                $name = $_GET["name"];
            } 
            else 
            {
                die("请输入有效的活动名称！");
            }
        } 
        else
        {
            $name = '';
        }

        if( isset($_GET["type"]) && $_GET['type'] != 'default')
        {
            if(preg_match("/^[\x{4e00}-\x{9fa5}]+$/u",$_GET["type"]))
            {
                $type = $_GET["type"];
            } 
            else 
            {
                die("请输入有效的活动类型！");
            }

        } 
        else
        {
            $type = '';
        }

        if( isset($_GET["department"]) && $_GET['department'] != 'default')
        {
            if(preg_match("/^[\x{4e00}-\x{9fa5}]+$/u",$_GET["department"]))
            {
                $department = $_GET["department"];
            } 
            else 
            {
                die("请输入有效的活动部门！");
            }

        } 
        else
        {
            $department = '';
        }

        if( isset($_GET['blur']) && $_GET['blur']=='false' )
        {
            $query = "SELECT
                            *
                      FROM 
                                Activity
                      WHERE
                            IF ('$type' = '', 0 = 0, type = '$type')
                        AND IF ('$department' = '', 0 = 0, department = '$department')
                        AND IF ('$name' = '', 0 = 0, name = '$name')
                        AND id $activityIn";
        }
        else
        {
            if( ($type=='' && $department=='' && $name=='') )
            {
                $query = "SELECT * FROM Activity WHERE id $activityIn";
            } 
            else if( $name != '' ) 
            {    
                if( $type != '' )
                {
                    if( $department != '' )
                    {        
                        $query = "SELECT * FROM Activity WHERE id $activityIn AND type = '$type' AND department = '$department' AND name LIKE '%$name%'";
                    } 
                    else 
                    {
                        $query = "SELECT * FROM Activity WHERE id $activityIn AND type = '$type' AND name LIKE '%$name%'";
                    }
                } 
                else 
                {
                    if( $department != '' )
                    {
                        $query = "SELECT * FROM Activity WHERE id $activityIn AND department = '$department' AND name LIKE '%$name%'";
                    } 
                    else 
                    {
                        $query = "SELECT * FROM Activity WHERE id $activityIn AND name LIKE '%$name%'";
                    }
                }

            } 
            else 
            {
                if( $type != '' )
                {
                    if( $department != '' )
                    {
                        $query = "SELECT * FROM Activity WHERE id $activityIn AND type = '$type' AND department = '$department'";
                    } 
                    else 
                    {
                        $query = "SELECT * FROM Activity WHERE id $activityIn AND type = '$type'";
                    }
                } 
                else 
                {
                    if( $department != '' )
                    {
                        $query = "SELECT * FROM Activity WHERE id $activityIn AND department = '$department'";
                    }
                }
            }
        }
        if(isset($_SERVER['HTTP_REFERER']) && strstr($_SERVER['HTTP_REFERER'],"checkList"))
        {
            $getActivityData = getSql( $query );

            $link = array();
            foreach ($getActivityData as $value) 
            {
                $link[] = "getStudent.php?activity=$value[id]";       
            }

            getTable($getActivityData,array(	'活动代号',
                                                '活动名称',
                                                '活动类型',
                                                '活动部门',
                                                '活动日期',
                                                '活动地点',
                                                '录入人员',
                                                '活动状态'),"border='1' align='center' width='888'",$link);
        }
        else
        {
            $getActivityData = getSql( $query );

            $link = array();
            foreach ($getActivityData as $value)
            {
                $link[] = "getStudent.php?activity=$value[id]";       
            }

            getTable($getActivityData,array(    '活动代号',
                                                '活动名称',
                                                '活动类型',
                                                '活动部门',
                                                '活动日期',
                                                '活动地点',
                                                '录入人员',
                                                '活动状态'),"border='1' align='center' width='888'",$link);
        }
    }
?>