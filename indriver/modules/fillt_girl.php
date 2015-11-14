<?php
$postdata = array(
'phone'         => '+79841016941',
'token'         => '3bc84e1121f9a26049ce488a3469494d',
'v'             => '3',
'city_id'       => '',
);

require_once "/var/www/indriver/function/db.php";


$ch = curl_init();
while(1)
{
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
//	print_r($idd);
	foreach($idd->response->items as $s => $ss)
	{
	///print_r($ss);
	echo "\n";
		if($ss->client->gender==2||$ss->client->gender==0)
		{
			if($ss->client->avatarbig!="")
			{
				$sst = explode(" ",$ss->client->birthday);
				//if($ss[1]>=21&&$ss[2]=="Mar"||$ss[1]<=20&&$ss[2]=="Apr")
				//{
					echo $ss->client->avatarbig."\n";
					echo $ss->client->phone."\n";
					echo $sst[1]." ".$sst[2]." ".$sst[3];
					//return;
				//}
			}
		}
	sleep(2);
	}
}
curl_close($ch);
?>
