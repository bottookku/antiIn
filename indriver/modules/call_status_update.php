<?php
if(!is_null($call_status))
{
	$req = "UPDATE status SET `call`=$call_status WHERE status_id=0;";
	db_req_without_resp($req);
}
?>
