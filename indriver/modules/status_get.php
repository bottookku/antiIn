<?php
require_once __DIR__."/../function/db.php";

if($_GET[abas]==1)
{
	$req = "SELECT * FROM status;";
	$ss = db_req($req);
	echo json_encode($ss);
}
else
{
	$req = "SELECT * FROM status;";
	$ss = db_req($req);
	echo $ss['init'];
}
?>
