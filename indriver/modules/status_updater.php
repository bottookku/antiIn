<?php
////////////////////////////////////
///ОБНОВЛЕНИЯ СТАТУСА START STOP ///
///от астеристка		 ///
////////////////////////////////////
require_once __DIR__."/../function/db.php";
$req = "UPDATE status SET `init`=$argv[1] WHERE status_id=0;";
db_req_without_resp($req);
?>
