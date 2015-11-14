<?php
require_once __DIR__."/../function/db.php";
$req = "SELECT * FROM info2";
$row1 = db_req($req);
foreach($row1 as $key => $val)
{
$row[$val[info2_id]] = $val[info2_name];
}
echo json_encode($row);
?>
