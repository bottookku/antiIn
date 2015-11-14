<?php
require_once __DIR__."/../function/db.php";
$req = "UPDATE location SET `latitude`='$_GET[lat]',longtitude='$_GET[long]' WHERE location_id=0;";
echo $req;
db_req_without_resp($req);
?>
