<?php
$ss = file_get_contents("http://doska.ykt.ru/catsjson.jsjsp?outVar=CATS_JSON&region=yakutsk");
$text = preg_replace("/var CATS_JSON = /", "", $ss);
$txt = preg_replace("/}];/", "}]", $text);
$dd = json_decode($txt);
print_r($dd);


?>
