<?php
require_once __DIR__."/../function/db.php";
if($_POST[init]=='start')
{
	$sql = "SELECT polygon_current_id FROM polygon_current;";
	$ret  = db_req($sql);
	if(!is_null($ret['polygon_current_id']))
	{
		$req = "UPDATE `status` SET `init`='1' WHERE `status_id`='0';";
		db_req_without_resp($req);
		$req = "UPDATE `status` SET `work`='0' WHERE `status_id`='0';";
		db_req_without_resp($req);
		$req = "UPDATE `status` SET `disk`='0' WHERE `status_id`='0';";
	        db_req_without_resp($req);
		$req = "UPDATE `status` SET `call`='44' WHERE `status_id`='0';";
		db_req_without_resp($req);
		include "/var/www/indriver/modules/start.php";
		echo "1";
	}
	else
	{
		echo "error";
	}
}
if($_POST[init]=='stop')
{
	$req = "UPDATE `status` SET `init`='0' WHERE `status_id`='0';";
	db_req_without_resp($req);
	include "/var/www/indriver/modules/stop.php";
	echo "1";
}

if($_POST[work]=='1')
{
        $req = "UPDATE `status` SET `work`='1' WHERE `status_id`='0';";
	include "/var/www/indriver/modules/stop.php";
        db_req_without_resp($req);
	echo "1";
}
if($_POST[work]=='0')
{
        $req = "UPDATE `status` SET `work`='0' WHERE `status_id`='0';";
        db_req_without_resp($req);
	echo "1";
}

if($_POST[ask_work]=='1')
{
        $req = "SELECT * FROM status;";
        $ret = db_req($req);
	echo $ret['work'];
}
if($_POST[ask_start]=='1')
{
        $req = "SELECT * FROM status;";
        $ret = db_req($req);
        echo $ret['init'];
}
if($_POST[disconnect]=='1')
{
	$req = "UPDATE `status` SET `disk`='1' WHERE `status_id`='0';";
	db_req_without_resp($req);
	include "/var/www/indriver/modules/disconnect.php";
	echo "1";
}
?>
