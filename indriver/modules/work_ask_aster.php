<?php
require_once __DIR__."/../function/db.php";
$req = "SELECT * FROM status WHERE status_id=0;";
$ret = db_req($req);
echo $ret['work'];
?>
