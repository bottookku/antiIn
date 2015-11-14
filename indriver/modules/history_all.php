<?php
require_once __DIR__."/../function/db.php";
$req = "SELECT `from`,`to`,`price`,`phone`,`username`,`priznak`,`date` FROM history LEFT JOIN taxist USING (taxist_id) ORDER BY history_id DESC;";
$ret = db_reqs($req);
echo json_encode($ret);
?>
