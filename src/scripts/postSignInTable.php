<?php
	include(__DIR__ . '/../lib.php');
	Config::loadCustom('/etc/Info/config.ini');
        
        if(is_numeric($_POST['student']) && is_numeric($_POST['activity']))
        {
            $student = $_POST['student'];
            $activity = $_POST['activity'];
            
            if( isset($_POST['status']) )
            {
                $status = $_POST['status'];
                if($status == 'true')
                {
                    $query = "SELECT status FROM Activity_Student WHERE student_id = '$student' AND activity_id = '$activity'";
                    $checkData = getOneNumber( $query );
               
                    if(empty($checkData))//no data in database
                    {
                        $activityStudentData = array();
                        $activityStudentData[] = $activity;
                        $activityStudentData[] = $student;

                        $result = insert($activityStudentData, array('activity_id','student_id'), 'Activity_Student');
                    }
                    else
                    {
                        $query = "UPDATE Activity_Student SET status = 'default' WHERE student_id = '$student' AND activity_id = '$activity'";
                        getDb()->query($query);
                    }
                }
                else
                {
                    $query = "UPDATE Activity_Student SET status = 'deleted' WHERE student_id = '$student' AND activity_id = '$activity'";
                    getDb()->query($query);
                }
            }
            else
            {
                $query = "SELECT * FROM Activity_Student WHERE student_id = '$student' AND activity_id = '$activity' AND status = 'default'";
                $checkData = getSql( $query );
                if(!empty($checkData))//checked
                {
                    echo 1;
                }
                else//not checked
                {
                    echo 0;
                }
            }
        }
?>