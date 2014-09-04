<?php
    include(__DIR__ . '/../lib.php');
    Config::loadCustom('/etc/Info/config.ini');

    if(isset($_SERVER['HTTP_REFERER']) && strstr($_SERVER['HTTP_REFERER'],"asActivity"))
    {
        header("Content-type: text/html; charset=utf-8");
        session_start();

        require('../inc/template.inc');
        $tpl = new Template('../html');
        $tpl->set_file('getStudent', 'getStudent.html'); 

        $tpl->pparse('output', 'getStudent');
            
        if(isset($_GET['activity']))
        {
            if(is_numeric($_GET['activity']))
            {
                $activity = $_GET['activity'];
                $query = "SELECT Student.* FROM Activity_Student LEFT JOIN Student ON Student.id = Activity_Student.student_id WHERE Activity_Student.activity_id = '$activity'";
                $getStudentData = getSql( $query );
                
                getTable($getStudentData, array('学号',
                                                '姓名',
                                                '性别',
                                                '专业',
                                                '年级',
                                                '班级',
                                                '状态'), "border='1' align='center' width='888'");
            }
            else
            {
                die("Invalid Activity ID");
            }
        }
        else
        {
            die("Need An Activity ID");
        }
        
    } 
    else if(isset($_SERVER['HTTP_REFERER']) && strstr($_SERVER['HTTP_REFERER'],"signInTable"))
    {
        header("Content-type: text/html; charset=utf-8");
        session_start();

        require('../inc/template.inc');
        $tpl = new Template('../html');
        $tpl->set_file('getStudent', 'getStudent.html'); 
        $tpl->set_var('getStudentJs', '/js/getStudent.js');

        $tpl->pparse('output', 'getStudent');

        $query = "SELECT * FROM Student";
        $getStudentData = getSql( $query );

        getTable($getStudentData, array('学号',
                                        '姓名',
                                        '性别',
                                        '专业',
                                        '年级',
                                        '班级',
                                        '状态'),"border='1' align='center' width='888'", NULL, 
                                    "<td><input type='checkbox'/></td>");
    } 
    else
    {

        if( isset($_GET["name"]) && $_GET['name'] != '')
        {
            if( preg_match("/^[\x{4e00}-\x{9fa5}]+$/u",$_GET["name"]) )
            {
                $name = $_GET["name"];
            } 
            else 
            {
                die("请输入有效的学生姓名！");
            }
        } 
        else
        {
            $name = '';
        }

        if( isset($_GET["grade"]) && $_GET['grade'] != 'default')
        {
            if(is_numeric($_GET["grade"]))
            {
                $grade = $_GET["grade"];
            } 
            else 
            {
                die("请输入有效的学生年级！");
            }

        } 
        else
        {
            $grade = '';
        }

        if( isset($_GET["class"]) && $_GET['class'] != 'default')
        {
            if(is_numeric($_GET["class"]))
            {
                $class = $_GET["class"];
            } 
            else 
            {
                die("请输入有效的学生班级！");
            }

        } 
        else
        {
            $class = '';
        }

        if( isset($_GET['blur']) && $_GET['blur']=='false' )
        {
            $query = "SELECT
                            *
                      FROM 
                                Student
                      WHERE
                            IF ('$grade' = '', 0 = 0, grade = '$grade')
                        AND IF ('$class' = '', 0 = 0, class = '$class')
                        AND IF ('$name' = '', 0 = 0, name = '$name')";
        }
        else
        {
            if( ($grade=='' && $class=='' && $name=='') )
            {
                $query = "SELECT * FROM Student";
            } 
            else if( $name != '' ) 
            {    
                if( $grade != '' )
                {
                    if( $class != '' )
                    {        
                        $query = "SELECT * FROM Student WHERE grade = '$grade' AND class = '$class' AND name LIKE '%$name%'";
                    } 
                    else 
                    {
                        $query = "SELECT * FROM Student WHERE grade = '$grade' AND name LIKE '%$name%'";
                    }
                } 
                else 
                {
                    if( $class != '' )
                    {
                        $query = "SELECT * FROM Student WHERE class = '$class' AND name LIKE '%$name%'";
                    } 
                    else 
                    {
                        $query = "SELECT * FROM Student WHERE name LIKE '%$name%'";
                    }
                }

            } 
            else 
            {
                if( $grade != '' )
                {
                    if( $class != '' )
                    {
                        $query = "SELECT * FROM Student WHERE grade = '$grade' AND class = '$class'";
                    } 
                    else 
                    {
                        $query = "SELECT * FROM Student WHERE grade = '$grade'";
                    }
                } 
                else 
                {
                    if( $class != '' )
                    {
                        $query = "SELECT * FROM Student WHERE class = '$class'";
                    }
                }
            }
        }
        
        $getStudentData = getSql( $query );

        $link = array();
        foreach ($getStudentData as $value)
        {
            $link[] = "getActivity.php?student=$value[id]";       
        }
                
        getTable($getStudentData, array('学号',
                                        '姓名',
                                        '性别',
                                        '专业',
                                        '年级',
                                        '班级',
                                        '状态'), "border='1' align='center' width='888'",$link);
    }
?>