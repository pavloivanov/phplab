<?php
require_once('config.php');

function dbConnect()
{
	global $dbConnection;
	$dbConnection = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if (!$dbConnection){
		throw new Exception('Unable to connect to host');
	}
	mysql_select_db(DB_NAME, $dbConnection);
}

function dbCheckError($query)
{
	global $dbConnection;
	if(mysql_error($dbConnection)){
		$error = mysql_error($dbConnection);
		$errorNum = mysql_errno($dbConnection);
		
		throw new Exception("Unable to execute query: {$query}."
							. " Error text: {$error}."
							. " Error details: {$errorNum}");
	}
}
function dbGetItemList($query)
{
	global $dbConnection;
	$results = mysql_query($query, $dbConnection);
	
	dbCheckError($query);

	$items = array();
	while($row = mysql_fetch_assoc($results)){
		$items[] = $row;
	}

	return $items;
}