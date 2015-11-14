<?php
require_once __DIR__."/../function/db.php";
$req = "SELECT * FROM status;";
$ss = db_req($req);
//print_r($ss);
$call_sost = $ss['call'];
echo $call_sost;

?>
