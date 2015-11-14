<?php
function db_conn()
{
	require __DIR__."/../config/config.php";
	$connect = mysql_connect($host,$user,$pass) or
	die("Ошибка соединения: " . mysql_error());
	mysql_set_charset('utf8',$connect);
	mysql_select_db($db_name);
}


function db_req($req)
{
	db_conn();
	$result = mysql_query($req);
	while ($rows[]=mysql_fetch_assoc($result)) {}
	$rowss = array_filter($rows);
	return $rowss;
}

function db_req_without_resp($req)
{
	db_conn();
	$result = mysql_query($req);
}
?>
