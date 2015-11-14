<?php
//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);

require_once __DIR__."/../function/db.php";
$req = "SELECT info3_id,info3_name FROM info3 WHERE info2_id = $_POST[status]";
$row1 = db_req($req);
foreach($row1 as $key => $val)
{
$row[$val[info3_id]] = $val[info3_name];
}
echo json_encode($row);
?>

