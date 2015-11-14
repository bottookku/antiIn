<?php
  if( $curl = curl_init() ) {
    curl_setopt($curl, CURLOPT_URL, 'http://192.168.0.80/check.php');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
    curl_setopt($curl, CURLOPT_POST,true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, "captcha=ee&num=3&idd=0&mac=e4:f3:43:8f:8e:61&");
    curl_setopt($curl, CURLOPT_COOKIE, "id=tiuman_1234");
    $out = curl_exec($curl);
    echo $out;
    curl_close($curl);
  }

?>
