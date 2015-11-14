<?php
require_once __DIR__."/../../function/db_api.php";
//$ss1 = "SELECT `polygon_name`,`long`,`lat` FROM `polygon` right join `polygon_geo` ON `polygon`.`polygon_geo_id` = `polygon_geo`.`polygon_geo_id` inner join `polygon_name` ON `polygon`.`polygon_name_id` = `polygon_name`.`polygon_name_id`";
$ss2 = "SELECT * FROM indriver.polygon_name;";
$ss12 = db_reqss($ss2);
//print_r($ss12);

foreach($ss12 as $ss3)
{
	//$ss1 = "SELECT `long`,`lat` FROM `polygon` right join `polygon_geo` ON `polygon`.`polygon_geo_id` = `polygon_geo`.`polygon_geo_id` WHERE `polygon_name_id`=".$ss3['polygon_name_id'];
	$ss5 = "SELECT napr FROM `polygon_name` WHERE `polygon_name_id`=".$ss3['polygon_name_id'];
	//$ss4 = db_reqss($ss1);
	$ss5 = db_reqss($ss5);
	$ss5 = $ss5[0][napr];
	$asd[$ss3['polygon_name']] = array($ss3['polygon_name_id'],$ss5);

}


echo json_encode($asd);

?>
