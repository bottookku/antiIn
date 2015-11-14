<?php
require_once "/var/www/indriver/function/db.php";
$reg = "SELECT * FROM history";
$ret = db_reqs($reg);
foreach($ret as $ss => $rrr)
{
	if ($rrr[indriver_id]==0)
	{
		$reg = "UPDATE history SET `indriver_id`=$ss WHERE `history_id`=$rrr[history_id]";
		$ret = db_reqs($reg);
	}
}




?>
