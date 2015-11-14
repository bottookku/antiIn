<?php
require_once __DIR__."/../../function/db_api.php";
if (file_exists('xml.txt'))

{
	$xml = simplexml_load_file('xml.txt');

	foreach($xml->node as $sss)
	{
		//ДОБАВЛЕНИЕ точек...
		//УБРАТЬ ЛИШНИЕ ЗНАКИ..... иначе в интеджер не поместится...
		$d1 = "INSERT INTO `polygon_geo` (`polygon_geo_id`, `long`, `lat`) VALUES ('".substr($sss['id'],4,10)."', '".$sss['lon']."', '".$sss['lat']."');";
		db_req_reg($d1);
	}

	foreach($xml->way as $ss)
	{
		//ДОБАВЛЕНИЕ ИМЕН РАЙОНОВ
		$ss123 = "INSERT INTO `polygon_name` (`polygon_name_id`, `polygon_name`) VALUES ('".substr($ss['id'],4,10)."', '".$ss->tag['v']."')";
		db_req_reg($ss123);

	}




	foreach($xml->way as $ss)
	{
		foreach($ss->nd as $rrr)
		{
			$id = intval(substr($rrr['ref'],4,10));
			foreach($xml->node as $sss)
			{
				$fff = intval(substr($sss['id'],4,10));
				if($fff==$id)
				{
					$d2 = "INSERT INTO `polygon` (`polygon_name_id`, `polygon_geo_id`) VALUES ('".substr($ss['id'],4,10)."', '".$fff."');";
					db_req_reg($d2);
				}
			}
		}
	}



}

?>
