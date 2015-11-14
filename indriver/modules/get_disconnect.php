<?php
require_once __DIR__."/../function/db.php";
$req = "SELECT * FROM status;";
$ret = db_req($req);
echo $ret['disk'];
?>
