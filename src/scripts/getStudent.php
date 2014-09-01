<?php
        if(isset($_SERVER['HTTP_REFERER']) && strstr($_SERVER['HTTP_REFERER'],"checkIn"))
        {
            header("Content-type: text/html; charset=utf-8");
            session_start();

            require('../inc/template.inc');
            $tpl = new Template('../html');
            $tpl->set_file('getStudent', 'getStudent.html'); 

            include(__DIR__ . '/../lib.php');
            Config::loadCustom('/etc/Info/config.ini');

            $tpl->set_var("activity","$_GET[activity]");

            $tpl->pparse('output', 'getStudent');

            $query = "SELECT name FROM Activity WHERE id = '$_GET[activity]'";
            $activityName = getOneNumber( $query );

            $query = "SELECT * FROM Student";
            $getStudentData = getSql( $query );

            getTable($getStudentData, 
                    array('学号','姓名','性别','专业','年级','班级','状态'),
                    "border='1' align='center' width='888'", 
                    NULL, 
                    "<td><input type='checkbox' onclick='mark(this);'/></td>");
        } else 
        {
            echo "shit";
        }
?>