<?php
    include(__DIR__ . '/../lib.php');
    Config::loadCustom('/etc/Info/config.ini');

    if(isset($_SERVER['HTTP_REFERER']) && strstr($_SERVER['HTTP_REFERER'],"asStudent"))
    {
        header("Content-type: text/html; charset=utf-8");
        session_start();
        require('../inc/template.inc');
        $tpl = new Template('../html'); 
        $tpl->set_file('display', 'display.html');
        $tpl->pparse('output', 'display');

        if(isset($_GET['student']))
        {
            if(validate($_GET['student'], 'student_id'))
            {
                $student = $_GET['student'];
                $query = "SELECT 
                                Activity.* 
                            FROM 
                                Activity_Student 
                            LEFT JOIN Activity ON Activity.id = Activity_Student.activity_id 
                            WHERE 
                                Activity_Student.status != 'deleted'
                            AND Activity_Student.student_id = '$student'";
                $getActivityData = getSql( $query );

                if(empty($getActivityData))
                {
                    exit;
                }
                getTable($getActivityData,array(    '活动代号',
                                                    '活动名称',
                                                    '活动类型',
                                                    '活动部门',
                                                    '活动日期',
                                                    '活动地点',
                                                    '负责人',
                                                    '活动状态'));
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
            $activityId = getSql(" SELECT 
                                            activity_id 
                                    FROM 
                                            Account_Activity 
                                    LEFT JOIN Activity  ON Activity.id = Account_Activity.activity_id
                                    WHERE 
                                            Activity.status = 'default'
                                        AND account_id = '$accountId'");

            $activityIn = array();

            foreach ($activityId as $value) 
            {
                $activityIn[] = $value["activity_id"]; 
            }
            $activityIn = "IN "."('".implode("','", array_unique( $activityIn ) )."')";
        }
        else
        {
            $activityId = getSql(" SELECT 
                                            Activity.id 
                                    FROM 
                                            Activity
                                    WHERE 
                                            Activity.status != 'deleted'");

            $activityIn = array();

            foreach ($activityId as $value) 
            {
                $activityIn[] = $value["id"]; 
            }
            $activityIn = "IN "."('".implode("','", array_unique( $activityIn ) )."')";
        }

        if( isset($_GET["name"]) && $_GET['name'] != '')
        {
            if(validate($_GET['name'], 'activity_name'))
            {
                $name = $_GET['name'];
            }
            else
            {
                die();
            }
        } 
        else
        {
            $name = '';
        }

        if( isset($_GET["type"]) && $_GET['type'] != 'default')
        {
            if(validate($_GET['type'], 'activity_type'))
            {
                $type = $_GET["type"];
            }
            else
            {
                die();
            }
        } 
        else
        {
            $type = '';
        }

        if( isset($_GET["department"]) && $_GET['department'] != 'default')
        {
            if(validate($_GET['department'], 'activity_department'))
            {
                $department = $_GET["department"];
            } 
            else 
            {
                die();
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
        
        $getActivityData = getSql( $query );

        $link = array();
        foreach ($getActivityData as $value) 
        {
            $link[] = "getStudent.php?activity=$value[id]";       
        }

        if(empty($getActivityData))
        {
            exit;
        }
        getTable($getActivityData,array(	'活动代号',
                                            '活动名称',
                                            '活动类型',
                                            '活动部门',
                                            '活动日期',
                                            '活动地点',
                                            '负责人',
                                            '活动状态'),$link);
    }
    