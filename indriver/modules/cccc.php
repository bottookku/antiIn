<?php
	$url = "http://178.248.236.45/api/getlastorders";
	$postdata = array(
	        'phone'         => '+79841016941',
        	'token'         => '3bc84e1121f9a26049ce488a3469494d',
	        'v'             => '3',
	        'city_id'       => '',
	        );
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_NOBODY, 0);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_POST,1);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$postdata);
	curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,5);
	curl_setopt($ch,CURLOPT_TIMEOUT,5);
	$out = curl_exec($ch);
	curl_close($ch);
	$idd = json_decode($out);
	print_r($idd);

?>
