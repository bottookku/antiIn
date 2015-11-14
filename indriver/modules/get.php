<?php
require_once __DIR__."/../function/db.php";
$location=db_req("SELECT * FROM current_taxa;");
print_r($location);

?>
