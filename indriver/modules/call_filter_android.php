<?php
//echo "79841016941@android-out";
//echo "104";
//return;
///функция измерения растояния
set_time_limit(300);
function le($lat1, $long1, $lat2, $long2)  {
 $R = 6372795;
 $lat1 *= pi() / 180;
 $lat2 *= pi() / 180;
 $long1 *= pi() / 180;
 $long2 *= pi() / 180;
 $cl1 = cos($lat1);
 $cl2 = cos($lat2);
 $sl1 = sin($lat1);
 $sl2 = sin($lat2);
 $delta = $long2 - $long1;
 $cdelta = cos($delta);
 $sdelta = sin($delta);
 $y = sqrt(pow($cl2 * $sdelta, 2) + pow($cl1 * $sl2 - $sl1 * $cl2 * $cdelta, 2));
 $x = $sl1 * $sl2 + $cl1 * $cl2 * $cdelta;
 $ad = atan2($y, $x);
 $dist = $ad * $R;
 return intval($dist);
}
////авторизация на сервере индрайвер
$postdata = array(
'phone'         => '+79841016941',
'token'         => '3bc84e1121f9a26049ce488a3469494d',
'v'             => '3',
'city_id'       => '',
);

require_once "/var/www/indriver/function/db.php";

/// по номеру телефона найти айди таксиста.... ОСТАВИТЬ В ЖИВЫХ ЭТО ПРАВИЛЬНО!!!!!!!!!
$numb = substr($argv[1],1,10);
$sql = "SELECT * FROM indriver.taxist WHERE `phone_taxist`=".$numb;
$ss1 = db_req($sql);

///ФИЛЬТРЫ
$descr = "";
$price = $ss1['filt_price'];
$dist1 = $ss1['filt_dist'];

///освободить ненужную память от массива. НУЖНО!
$ss1 = $ss1['taxist_id'];

//WORK STATUS
///установить на поиск...
$sql = "UPDATE `taxist` SET `work`='4' WHERE `taxist_id`='".$ss1."';";
db_req_without_resp($sql);

/////инициализировать курл
$ch = curl_init();
while(1)
{

////найти 5 последних idriver_id показанных этому таксисту заказов.....
$sql = "SELECT `id_tax` FROM `current_taxa_android` WHERE taxist_id='".$ss1."' ORDER BY `id_taxa` DESC LIMIT 5";
$id_tax = db_reqs($sql);


///// взять два айди от 0,1 идекса массива данных, из псоледней итерации.
$sql = "SELECT `last1`,`last2` FROM `last_indriver_id` WHERE taxist_id='".$ss1."' AND `date` >= (now() - interval 5 minute);";
$last = db_req($sql);
$last1 = $last['last1'];
$last2 = $last['last2'];
	////////////////////////
	///GET GEO taxist    ///
	////////////////////////
	$sql = "SELECT `long`,`lat` FROM geoloc WHERE `taxist_id`='".$ss1."' order by `time` DESC limit 1";
	$ret = db_req($sql);
	$lat1 = $ret['lat'];
	$long1 = $ret['long'];
	////////////
	////curl////
	////////////
	curl_setopt_array($ch, array(
		CURLOPT_NOBODY => 0,
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL => "http://178.248.236.45/api/getlastorders",
		CURLOPT_POST => 1,
		CURLOPT_POSTFIELDS => $postdata,
		CURLOPT_CONNECTTIMEOUT => 5,
		CURLOPT_TIMEOUT => 5,
		CURLOPT_HEADER => 0,
	));
	$out = curl_exec($ch);
	$idd = json_decode($out);
	print_r($idd);
	//$start = microtime(true);
	$x=0;
	foreach($idd->response->items as $s => $ss)
	{
		///ПРОВЕРКА. если индексы из массива данных 0 и 1. от последней итерации совападут в той же последовательности
		///в которой они были в последней итерации то завершить итерацию и запросить данные по новой...
		///ЗАЧЕМ КАЛЬКУЛИРОВАТЬ за ново ТО ЧТО КАЛЬКУЛИРОВАЛОСЬ РАНЬШЕ.... незачем!
		if($idd->response->items[$s]->id == $last1||$idd->response->items[$s]->id == $last2)
		{
			$x++;
			if($x == 2)
			{
				break;
			}
			else
			{
				continue;
			}
		}
		else
		{
			$x=0;
		}
		/// если цена удовлетворяет фильтру
		if($idd->response->items[$s]->price >= $price)
		{
			/// если нет дескрипшена
			if ($idd->response->items[$s]->description == $descr)
			{
				////если айди заказа совпадает с последними 5 заказами....
				foreach($id_tax as $uii)
				{
					if($uii['id_tax']==$idd->response->items[$s]->id)
					{
						//пропустить итерацию...
						continue 2;
					}
				}
				///гео данные клиента
				$long22 = $idd->response->items[$s]->client->locationlongitude;
				$lat22 = $idd->response->items[$s]->client->locationlatitude;
				$lat2 = $idd->response->items[$s]->fromlatitude;
				$long2 = $idd->response->items[$s]->fromlongitude;
				///если гео данные пусты пропустить обработку клиента
				if($long22 == ""&&$long2 == "")
				{
					continue;
				}
				///иначе найти более достверный источник это FROMlontitude и FROMlatitude
				///А locationlatitude и locationlongtitude менее достоверный источник
				else
				{
					if($long22=="")
					{
						////найти растояние
						$dist0 = le($lat1,$long1,$lat2,$long2);
					}
					if($long2=="")
					{
						///найти растояние
						$dist0 = le($lat1,$long1,$lat22,$long22);
					}
					else
					{
						///найти растояние
						$dist0 = le($lat1,$long1,$lat2,$long2);
					}
				}
				///если фильтр растояния удовлетворяет...
				if($dist1 >= $dist0)
				{
					$from = 	$idd->response->items[$s]->from;
					$to = 		$idd->response->items[$s]->to;
					$price = 	$idd->response->items[$s]->price;
					$phone =  	$idd->response->items[$s]->client->phone;
					$idd1 =		$idd->response->items[$s]->id;
					$req = "INSERT INTO `current_taxa_android` (`from`, `to`, `price`, `phone`, `dist`, `id_tax`, `taxist_id`) VALUES ('$from', '$to', '$price', '$phone', '$dist0', '$idd1', '".$ss1."');";
					echo $phone."@android-out";
					//echo 104;
					db_req_without_resp($req);
					//////изменить статус на кандидат найден
					$sql = "UPDATE `indriver`.`taxist` SET `work`='5' WHERE `taxist_id`='".$ss1."';";
					db_req_without_resp($sql);
					//////изменить статус телефона на ВЫЗОВ
					$sql = "UPDATE `indriver`.`taxist` SET `dial_status`='2' WHERE `taxist_id`='".$ss1."';";
					db_req_without_resp($sql);
					//измерить время
					//$time = microtime(true) - $start;
					//printf('Скрипт выполнялся %.4F сек.', $time);
					break 2;
				}
			}
		}
	}
	////////Сохранить в память первого и второго клиента этой итерации...т.е. 0 и 1
	$last1 = $idd->response->items[0]->id;
	$last2 = $idd->response->items[1]->id;
}
///mysql last save
///ЗАпсиать клиента 0 и 1 из последней проделанной итерации...
///ЕСЛИ НЕТ СОЗДАЕТ ЕЛСИ ЕСТЬ ПЕРЕЗАПИСЫВАЕТ ЕСЛИ taxist_id уникью!!!
$req = "REPLACE INTO last_indriver_id (`last1`, `last2`, `taxist_id`) VALUES('".$last1."', '".$last2."', '".$ss1."');";
db_req_without_resp($req);
///закрыть курл
curl_close($ch);
?>
