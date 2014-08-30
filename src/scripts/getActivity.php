<?php
    include(__DIR__ . '/../lib.php');
    Config::loadCustom('/etc/Info/config.ini');

    if(strstr($_SERVER['HTTP_REFERER'],"checkIn"))
    {
        session_start();

        $accountId = getOneNumber("SELECT id FROM Account WHERE username = '$_SESSION[info]'");
        $acticityId = getSql("SELECT activity_id FROM Account_Activity WHERE account_id = '$accountId'");
        
        $acticityIn = array();

        foreach ($acticityId as $value) 
        {
            $acticityIn[] = $value["activity_id"]; 
        }
        $acticityIn = "IN "."('".implode("','", array_unique( $acticityIn ) )."')";
    }
    else
    {
        $acticityIn = "NOT IN ('')";
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
                    AND id $acticityIn";
    }
    else
    {
        if( ($type=='' && $department=='' && $name=='') )
        {
            $query = "SELECT * FROM Activity WHERE id $acticityIn";
        } 
        else if( $name != '' ) 
        {    
            if( $type != '' )
            {
                if( $department != '' )
                {        
                    $query = "SELECT * FROM Activity WHERE id $acticityIn AND type = '$type' AND department = '$department' AND name LIKE '%$name%'";
                } 
                else 
                {
                    $query = "SELECT * FROM Activity WHERE id $acticityIn AND type = '$type' AND name LIKE '%$name%'";
                }
            } 
            else 
            {
                if( $department != '' )
                {
                    $query = "SELECT * FROM Activity WHERE id $acticityIn AND department = '$department' AND name LIKE '%$name%'";
                } 
                else 
                {
                    $query = "SELECT * FROM Activity WHERE id $acticityIn AND name LIKE '%$name%'";
                }
            }

        } 
        else 
        {
            if( $type != '' )
            {
                if( $department != '' )
                {
                    $query = "SELECT * FROM Activity WHERE id $acticityIn AND type = '$type' AND department = '$department'";
                } 
                else 
                {
                    $query = "SELECT * FROM Activity WHERE id $acticityIn AND type = '$type'";
                }
            } 
            else 
            {
                if( $department != '' )
                {
                    $query = "SELECT * FROM Activity WHERE id $acticityIn AND department = '$department'";
                }
            }
        }
    }
    if(strstr($_SERVER['HTTP_REFERER'],"checkIn"))
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
        getTable($getActivityData,array(    '活动代号',
                                            '活动名称',
                                            '活动类型',
                                            '活动部门',
                                            '活动日期',
                                            '活动地点',
                                            '录入人员',
                                            '活动状态'),"border='1' align='center' width='888'");
    }
?>