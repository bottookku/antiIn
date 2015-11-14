<?php
require_once __DIR__."/../function/db_api.php";
if(!is_null($_GET[rem]))
{
	if(preg_match('/^\d+$/',$_GET[rem]))
	{
	$q1 = "DELETE FROM `polygon_current` WHERE `polygon_name_id`=".$_GET[rem];
	db_reqss($q1);
	}
	else
	{
		$s3 = "SELECT `polygon_name_id` FROM polygon_name WHERE `napr`='".$_GET[rem]."'";
		$s4 = db_reqss($s3);
		foreach($s4 as $s5)
		{
			$s6 = "DELETE FROM `polygon_current` WHERE `polygon_name_id`=".$s5[polygon_name_id];
			db_reqss($s6);
		}
	}
}
if(!is_null($_GET[loc]))
{
	$q2 = "INSERT INTO `polygon_current` (`polygon_name_id`) VALUES ($_GET[loc])";
	db_reqss($q2);
}
if(!is_null($_GET[rem_all]))
{
	$q11 = "TRUNCATE `polygon_current`";
	db_reqss($q11);
	echo "11";
}
?>
