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

function getTable($tableData, $columnsName, $style = "", $links = NULL, $additiveEle = "")
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
	echo '<table '.$style.'>'.'<thead>';
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

    // setup the placeholders - a fancy way to make the long "(?, ?, ?)..." string
    $rowPlaces = '(' . implode(', ', array_fill(0, count($columns), '?')) . ')';
    $allPlaces = implode(', ', array_fill(0, 1 , $rowPlaces));

    $query = "INSERT INTO $table (" . implode(', ', $columns) . ") VALUES " . $allPlaces;

    $db->query("SET NAMES UTF8");

    $stmt = $db->prepare ( $query );

    return $stmt->execute($insertData);
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