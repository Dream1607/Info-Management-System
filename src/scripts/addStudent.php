<?php
	header("Content-type: text/html; charset=utf-8");
	session_start();

	require('../inc/template.inc');
	$tpl = new Template('../html');
	$tpl->set_file('addStudent', 'addStudent.html'); 

	include(__DIR__ . '/../lib.php');
	Config::loadCustom('/etc/Info/config.ini');
        
	$tpl->pparse('output', 'addStudent');
        
        $tpl->set_var('user', $_SESSION['info']);
        
	if(isset($_POST["submit"]))
	{
            if(is_numeric($_POST['number']))
            {
                $id = $_POST['number'];
            }
            else
            {
                echo "<script>"; 
                echo "alert(\"请输入正确的学号！\");";
                echo "location='/scripts/addStudent.php'";
                echo "</script>";
            }
            
            if( preg_match("/^[\x{4e00}-\x{9fa5}A-Za-z0-9._-]+$/u",$_POST["name"]) )
            {
                $name = $_POST["name"];
            } 
            else 
            {
                echo "<script>"; 
                echo "alert(\"请输入有效的学生姓名！\");";
                echo "location='/scripts/addStudent.php'";
                echo "</script>";
            }
            
            if( $_POST["gender"] == '男' || $_POST["gender"] == '女' )
            {
                $gender = $_POST["gender"];
            } 
            else 
            {
                echo "<script>"; 
                echo "alert(\"请选择正确的性别！\");";
                echo "location='/scripts/addStudent.php'";
                echo "</script>";
            }
            
            if( preg_match("/^[\x{4e00}-\x{9fa5}A-Za-z0-9._-]+$/u",$_POST["major"]) )
            {
                $major = $_POST["major"];
            } 
            else 
            {
                echo "<script>"; 
                echo "alert(\"请输入正确的专业！\");";
                echo "location='/scripts/addStudent.php'";
                echo "</script>";
            }
            
            if( preg_match("/^[\x{4e00}-\x{9fa5}A-Za-z0-9._-]+$/u",$_POST["grade"]) )
            {
                $grade = $_POST["grade"];
            } 
            else 
            {
                echo "<script>"; 
                echo "alert(\"请输入正确的年级！\");";
                echo "location='/scripts/addStudent.php'";
                echo "</script>";
            }
            
            if( preg_match("/^[\x{4e00}-\x{9fa5}A-Za-z0-9._-]+$/u",$_POST["class"]) )
            {
                $class = $_POST["class"];
            } 
            else 
            {
                echo "<script>"; 
                echo "alert(\"请输入正确的班级！\");";
                echo "location='/scripts/addStudent.php'";
                echo "</script>";
            }
            
            $studentData = array();
            $studentData[]=$id;
            $studentData[]=$name;
            $studentData[]=$gender;
            $studentData[]=$major;
            $studentData[]=$grade;
            $studentData[]=$class;
            
            insert($studentData, array(	'id',
                                        'name',
                                        'gender',
                                        'major',
                                        'grade',
                                        'class'), 'student');
            echo "<script>"; 
            echo "alert(\"添加成功！\");";
            echo "location='/scripts/addStudent.php'";
            echo "</script>";
	} 
?>