<?php
require_once __DIR__."/../../function/db_api.php";
$a = "SELECT * FROM `polygon_current` LEFT JOIN `polygon` ON `polygon_current`.`polygon_name_id`=`polygon`.`polygon_name_id` LEFT JOIN `polygon_geo` ON `polygon`.`polygon_geo_id`=`polygon_geo`.`polygon_geo_id`";
$ss = db_reqs($a);
foreach($ss as $ss1)
{
$as[][$ss1['polygon_name_id']] = array($ss1['long'],$ss1['lat']);
}
print_r($as);



?>
