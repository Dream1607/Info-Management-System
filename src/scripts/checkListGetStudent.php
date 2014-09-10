<?php
    include(__DIR__ . '/../lib.php');
    Config::loadCustom('/etc/Info/config.ini');


    if( isset($_GET["id"]) && $_GET['id'] != '')
    {
        if( is_numeric($_GET['id']) )
        {
            $id = $_GET["id"];
        } 
        else 
        {
            die();
        }
    } 
    else
    {
        $id = '';
    }

    if( isset($_GET["grade"]) && $_GET['grade'] != 'default')
    {
        if( validate($_GET['grade'], 'student_grade') )
        {
            $grade = $_GET["grade"];
        } 
        else 
        {
            die();
        }

    } 
    else
    {
        $grade = '';
    }

    if( isset($_GET["class"]) && $_GET['class'] != 'default')
    {
        if( validate($_GET['class'], 'student_class'))
        {
            $class = $_GET["class"];
        } 
        else 
        {
            die();
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
                    AND IF ('$id' = '', 0 = 0, id = '$id')";
    }
    else
    {
        if( ($grade=='' && $class=='' && $id=='') )
        {
            $query = "SELECT * FROM Student";
        } 
        else if( $id != '' ) 
        {    
            if( $grade != '' )
            {
                if( $class != '' )
                {        
                    $query = "SELECT * FROM Student WHERE grade = '$grade' AND class = '$class' AND id LIKE '%$id'";
                } 
                else 
                {
                    $query = "SELECT * FROM Student WHERE grade = '$grade' AND id LIKE '%$id'";
                }
            } 
            else 
            {
                if( $class != '' )
                {
                    $query = "SELECT * FROM Student WHERE class = '$class' AND id LIKE '%$id'";
                } 
                else 
                {
                    $query = "SELECT * FROM Student WHERE id LIKE '%$id'";
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

    if(empty($getStudentData))
    {
        exit;
    }
    
    getTable($getStudentData, array('学号',
                                    '姓名',
                                    '性别',
                                    '专业',
                                    '年级',
                                    '班级',
                                    '状态'), NULL, 
                                    "<td><input type='checkbox'/></td>");
?>