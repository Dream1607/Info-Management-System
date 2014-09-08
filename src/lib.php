<?php

define('DB_NAME',   'DB_NAME');
define('DB_HOST',   'DB_HOST');
define('DB_PORT',   'DB_PORT');
define('DB_USER',   'DB_USER');
define('DB_PASS',   'DB_PASS');
define('DB_TYPE',   'DB_TYPE');

define('NAME',   'NAME');
define('HOST',   'HOST');
define('PORT',   'PORT');
define('USER',   'USER');
define('PASS',   'PASS');
define('TYPE',   'TYPE');

define('DB_MAIN',   'DB_MAIN');

class Config
{
    private static $configs = array( );

    public static function get( $constant )
    {
        if( !self::isDefined( $constant ) )
        {
            throw new \Exception( 'The constant is not defined: ' . $constant );
        }

        return self::$configs[$constant];
    }

    public static function set( $constant, $value )
    {
        self::$configs[$constant] = $value;
    }

    public static function isDefined( $constant )
    {
        return isset( self::$configs[$constant] );
    }

    public static function loadCustom( $config_file )
    {
        if ( file_exists( $config_file ) )
        {
            $configArray = parse_ini_file( $config_file );
            
            foreach ( $configArray as $key => $value )
            {
                Config::set( strtoupper( $key ), $value );
            }
        }
    }
}

set_error_handler( 'captureErrors' );
set_exception_handler( 'captureException' );


// CATCHABLE ERRORS
function captureErrors( $number, $message, $file, $line )
{
    // Insert all in one table
    $error = array( 'type' => $number, 'message' => $message, 'file' => $file, 'line' => $line );
    exit( json_encode( $error ) );
}

function captureException( $exception )
{
    // Insert all in one table
    $arrayException = array(
        'code'    => $exception->getCode(),
        'message' => ( strlen( $exception->getMessage() ) > 0 ? $exception->getMessage()
                        : ApiException::getStandardStatusCodeMessage( $exception->getCode() ) ),
        'file'    => $exception->getFile(),
        'line'    => $exception->getLine(),
        'trace'   => $exception->getTrace(),
    );

    exit( json_encode( $arrayException ) );
}

function getDb( $dbType = DB_MAIN, $cache = true )
{
    static $dbh;
    if(isset( $dbh[$dbType] ) && $cache)
    {
        return $dbh[$dbType];
    }
    
    $dbSettings = Config::get($dbType);
    if( !isset($dbSettings[PORT]) )
    {
        $dbSettings[PORT] = default_port($dbSettings[TYPE]);
    }

    $dbh[$dbType] = new PDO( $dbSettings[TYPE].':host='.$dbSettings[HOST].';port='.$dbSettings[PORT].';dbname='.$dbSettings[NAME], $dbSettings[USER], $dbSettings[PASS] );
    $dbh[$dbType]->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION );

    return $dbh[$dbType];
}

function getSql( $sql = '', $db = null)
{
    if( is_array($sql) )
    {
        foreach( $sql as $query)
        {
            if( isset( $db ) )
            {
                $data = $db->query( $query
                        ,\PDO::FETCH_ASSOC)->fetchAll();
            }
            else
            {
                $data = getDb()->query( $query
                        ,\PDO::FETCH_ASSOC)->fetchAll();
            }
        }        
    }
    else
    {
        if( isset( $db ) )
        {
            getDb()->query("SET NAMES UTF8");
            $data = $db->query( $sql
                    ,\PDO::FETCH_ASSOC)->fetchAll();
        }
        else
        { 
            getDb()->query("SET NAMES UTF8");
            $data = getDb()->query( $sql
                    ,\PDO::FETCH_ASSOC)->fetchAll();
        }        
    }

    return $data;
}

function getTable($tableData, $columnsName, $links = NULL, $additiveEle = "")
{
	if(empty($tableData))
	{
		die("Empty Data!");
	}
	if(count($columnsName) == 0)
	{
		die("There is no column name!");
	}
	if(count($columnsName) != count($tableData[0]))
	{
		die("Column names are not equal to table columns!");
	}
	
	$rowstart = '<tr>'; $rowend = '</tr>';
	$elestart = '<td>'; $eleend = '</td>';
	echo '<table '.'class="table table-striped table-bordered table-hover"'.'>'.'<thead>';
	foreach($columnsName AS $name)
	{
		echo '<th scope="col">'.$name.'</th>';
	}
	echo '</thead>';
	echo '<tbody>';
	if($links)
	{
		foreach($tableData AS $index => $row)
		{
			echo '<tr onclick="document.location = \''.$links[$index].'\';">';
			foreach($row AS $element)
			{
				echo $elestart.$element.$eleend;
			}
			echo $additiveEle.$rowend;
		}
	}else{
		foreach($tableData AS $row)
		{
			echo $rowstart;
			foreach($row AS $element)
			{
				echo $elestart.$element.$eleend;
			}
			echo $additiveEle.$rowend;
		}
	}	
	echo '</tbody>';
	echo '</table>';
}

function getOneNumber( $sql = '', $db = null )
{
    $rawData = getSql( $sql, $db );

    foreach( $rawData as $row )
    {
        foreach($row as $value )
        {
           return $value;
        }
    }
}

function insert($insertData, $columns, $table, $db = null, $rowendplace = false)
{
    if( empty( $insertData ) )
    {
        return;
    }

    if( !isset( $db ) )
    {
        $db =  $data = getDb();
    }

    //if insertData has keys, it would give error messages!
    $excludeKeyData = array();
    foreach($insertData as $key => $value)
    {
        $excludeKeyData[]=$value;
    }
    
    // setup the placeholders - a fancy way to make the long "(?, ?, ?)..." string
    $rowPlaces = '(' . implode(', ', array_fill(0, count($columns), '?')) . ')';
    $allPlaces = implode(', ', array_fill(0, 1 , $rowPlaces));

    $query = "INSERT INTO $table (" . implode(', ', $columns) . ") VALUES " . $allPlaces;

    $db->query("SET NAMES UTF8");

    $stmt = $db->prepare ( $query );
    return $stmt->execute($excludeKeyData);
}

function truncateTable( $table, $db = null )
{
    if( empty( $table ) )
    {
        return;
    }
    $query = "TRUNCATE TABLE $table";
    $trun = $db->query( $query );
}

function update($updateData, $whereColumn, $setColumn, $table, $db = null)
{
    if( empty( $updateData ) )
    {
        return;
    }

    if( !isset( $db ) )
    {
        $db =  $data = getDb();
    }
    
    $dataToInsert = array();
    
    $casePlace = "";
    for ( $i = 0 ; $i < count($updateData); $i++ )
    {
        $casePlace .= " WHEN ? THEN ?";
        array_push($dataToInsert, $updateData[$i][key($whereColumn)], $updateData[$i][key($setColumn)]);
    }
    $wherePlace = '( '.implode(',',  array_column($updateData, key($whereColumn))).' )';
 
    $query = "UPDATE $table SET ". current($setColumn) ." = CASE ". current($whereColumn)." ". $casePlace ." END WHERE ". current($whereColumn)." IN ".$wherePlace;
    
    $stmt = $db->prepare ($query);

    $stmt->execute($dataToInsert);
}

function alert( $msg )
{
    echo '<script> alert ("'.$msg.'") </script>';
}

function checkEle($ele,$array)
{
    foreach($array as $element)
    {
        if(strcmp($element,$ele)==0)
        {
            return true;
        }
    }
    return false;
}

function validate($input, $type = '')
{
    //mutli validate through array
    //array('type' => 'input')
    //key name should be validate type
    if(is_array($input))
    {
        foreach($input as $validate_type => $validate_value)
        {
            if(!validate($validate_value,$validate_type))
            {
                return false;
            }
        }
        return true;
    }
    else
    //single validate
    {
        $input = trim($input);
        $input = preg_replace('/\s(?=\s)/','',$input);
        if($input == '')
        {
            alert("无效空白！");
        }

        $gender = array('男','女');
        $major = array('理科试验班','数学与应用数学','计算机科学与技术','信息资源管理','信息安全');
        $grade = array('2011级本科','2012级本科','2013级本科','2014级本科');
        $class = array('1班','2班','3班','4班','5班','6班');

        $activity_type = array('体育竞技类','文化艺术类','科技创新类','志愿服务类','知识竞赛类','娱乐放松类','学术讲座类','经验交流类','社会实践类');
        $department = array('体育部','文化部','外联部','实践部','团宣部','团组部','学习部','信息宣','办公室','青年志愿者协会','计算机协会','信息月刊','信息学院辩论队','党总支','研究生会');

        //student
        if($type == 'student_id')
        {
            //format 20********
            if(preg_match('/^20+\d{8}$/',$input) )
            {
                return true;
            }
            else
            {
                alert("请输入正确的学号！");
            }
        }
        if($type == 'student_name')
        {
            if( preg_match("/^[\x{4e00}-\x{9fa5}]+$/u",$input ))
            {
                return true;
            }
            else
            {
                alert("请输入正确的学生姓名！");
            }
        }
        if($type == 'student_gender')
        {
            if(checkEle($input, $gender))
            {
                return true;
            }
            else
            {
                alert("请输入正确的学生性别！");
            }
        }
        if($type == 'student_major')
        {
            if(checkEle($input, $major))
            {
                return true;
            }
            else
            {
                alert("请输入正确的学生专业！");
            }
        }
        if($type == 'student_grade')
        {
            if(checkEle($input, $grade))
            {
                return true;
            }
            else
            {
                alert("请输入正确的年级！");
            }
        }
        if($type == 'student_class')
        {
            if(checkEle($input, $class))
            {
                return true;
            }
            else
            {
                alert("请输入正确的班级！");
            }
        }
        //activity
        if($type == 'activity_name')
        {
            if( preg_match("/^[\x{4e00}-\x{9fa5}A-Za-z0-9._-]+$/u",$input ))
            {
                return true;
            }
            else
            {
                alert("请输入合法的活动名称！");
            }
        }
        if($type == 'activity_type')
        {
            if(checkEle($input, $activity_type))
            {
                return true;
            }
            else
            {
                alert("请选择正确的活动类型！");
            }
        }
        if($type == 'activity_department')
        {
            if(checkEle($input, $department))
            {
                return true;
            }
            else
            {
                alert("请选择正确的活动部门！");
            }
        }
        if($type == 'activity_date')
        {
            if(date('Y-m-d',strtotime($input))==$input)
            {
                return true;
            }
            else
            {
                alert("请输入合法的活动日期！");
            }
        }
        if($type == 'activity_place')
        {
            if(preg_match("/^[\x{4e00}-\x{9fa5}A-Za-z0-9._-]+$/u",$input))
            {
                return true;
            }
            else
            {
                alert("请输入合法的活动地点！");
            }
        }
        if($type == 'activity_sponsor')
        {
            if(preg_match("/^[\x{4e00}-\x{9fa5}A-Za-z0-9._-]+$/u",$input))
            {
                return true;
            }
            else
            {
                alert("请输入正确的负责人！");
            }
        }
        if($type == 'username')
        {
            if(preg_match("/^[\x{4e00}-\x{9fa5}A-Za-z0-9._-]+$/u",$input))
            {
                return true;
            }
            else
            {
                alert("请输入合法的管理者用户名！");
            }
        }
        if($type == 'password')
        {
            if(preg_match("/^[A-Za-z0-9_-]{6,16}$/",$input))
            {
                return true;
            }
            else
            {
                alert("密码格式不合法！");
            }
        }
        return false;
    }
}