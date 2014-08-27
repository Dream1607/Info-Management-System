<?php
include(__DIR__ . '/../lib.php');
Config::loadCustom('/etc/Info/config.ini');
header("Content-Type: text/html; charset=utf-8");

if( (!isset($_GET['type']) && !isset($_GET['department']) && !isset($_GET['name'])) || ($_GET['type'] == 'default' && $_GET['department'] == 'default' && $_GET['name'] == '') )
{
    $query = "SELECT * FROM activity";
    
} else if( isset($_GET['name']) && $_GET['name'] != '') {
    
    if( preg_match("/^[\x{4e00}-\x{9fa5}A-Za-z0-9._-]+$/u",$_GET["name"]) ){
        $name = $_GET["name"];
    } else {
        die("请输入有效的活动名称！");
    }
    
    if( isset($_GET['type']) && $_GET['type'] != 'default')
    {
        if(preg_match("/^[\x{4e00}-\x{9fa5}]+$/u",$_GET["type"])){
            $type = $_GET["type"];
        } else {
            die("请输入有效的活动类型！");
        }

        if( isset($_GET['department']) && $_GET['department'] != 'default' ){
            if(preg_match("/^[\x{4e00}-\x{9fa5}]+$/u",$_GET["department"])){
                $department = $_GET["department"];
            } else {
                die("请输入有效的活动部门！");
            }
            $query = "SELECT * FROM activity WHERE type = '$type' AND department = '$department' AND name LIKE '%$name%'";
        } else {
            $query = "SELECT * FROM activity WHERE type = '$type' AND name LIKE '%$name%'";
        }
    } else {
        if( isset($_GET['department']) && $_GET['department'] != 'default' ){
            if(preg_match("/^[\x{4e00}-\x{9fa5}]+$/u",$_GET["department"])){
                $department = $_GET["department"];
            } else {
                die("请输入有效的活动部门！");
            }
            $query = "SELECT * FROM activity WHERE department = '$department' AND name LIKE '%$name%'";
        } else {
            $query = "SELECT * FROM activity WHERE name LIKE '%$name%'";
        }
    }
    
} else {
    if( isset($_GET['type']) && $_GET['type'] != 'default')
    {
        if(preg_match("/^[\x{4e00}-\x{9fa5}]+$/u",$_GET["type"])){
            $type = $_GET["type"];
        } else {
            die("请输入有效的活动类型！");
        }

        if( isset($_GET['department']) && $_GET['department'] != 'default' ){
            if(preg_match("/^[\x{4e00}-\x{9fa5}]+$/u",$_GET["department"])){
                $department = $_GET["department"];
            } else {
                die("请输入有效的活动部门！");
            }
            $query = "SELECT * FROM activity WHERE type = '$type' AND department = '$department'";
        } else {
            $query = "SELECT * FROM activity WHERE type = '$type'";
        }
    } else {
        if( isset($_GET['department']) && $_GET['department'] != 'default' ){
            if(preg_match("/^[\x{4e00}-\x{9fa5}]+$/u",$_GET["department"])){
                $department = $_GET["department"];
            } else {
                die("请输入有效的活动部门！");
            }
            $query = "SELECT * FROM activity WHERE department = '$department'";
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