<?php
require_once __DIR__."/../function/db.php";
$req = "SELECT `from`, `to`, `price`, `phone`, `polygon_name` FROM current_taxa LEFT JOIN polygon_name ON current_taxa.dist = polygon_name.polygon_name_id ORDER BY current_taxa_id DESC LIMIT 1;";
$ss = db_req($req);
echo json_encode($ss);
?>
