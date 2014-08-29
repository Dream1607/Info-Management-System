<?php
include(__DIR__ . '/../lib.php');
Config::loadCustom('/etc/Info/config.ini');

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
                AND IF ('$name' = '', 0 = 0, name = '$name')";
}
else
{
    if( ($type=='' && $department=='' && $name=='') )
    {
        $query = "SELECT * FROM Activity";
    } 
    else if( $name != '' ) 
    {    
        if( $type != '' )
        {
            if( $department != '' )
            {        
                $query = "SELECT * FROM Activity WHERE type = '$type' AND department = '$department' AND name LIKE '%$name%'";
            } 
            else 
            {
                $query = "SELECT * FROM Activity WHERE type = '$type' AND name LIKE '%$name%'";
            }
        } 
        else 
        {
            if( $department != '' )
            {
                $query = "SELECT * FROM Activity WHERE department = '$department' AND name LIKE '%$name%'";
            } 
            else 
            {
                $query = "SELECT * FROM Activity WHERE name LIKE '%$name%'";
            }
        }

    } 
    else 
    {
        if( $type != '' )
        {
            if( $department != '' )
            {
                $query = "SELECT * FROM Activity WHERE type = '$type' AND department = '$department'";
            } 
            else 
            {
                $query = "SELECT * FROM Activity WHERE type = '$type'";
            }
        } 
        else 
        {
            if( $department != '' )
            {
                $query = "SELECT * FROM Activity WHERE department = '$department'";
            }
        }
    }
}
$checkAsActivityData = getSql( $query );

getTable($checkAsActivityData,array(	'活动代号',
                                        '活动名称',
                                        '活动类型',
                                        '活动部门',
                                        '活动日期',
                                        '活动地点',
                                        '录入人员',
                                        '活动状态'),"border='1' align='center' width='888'");
?>