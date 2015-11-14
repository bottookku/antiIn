<?php
$asd = file_get_contents("11.txt");


preg_match_all("/\[.*\]/",$asd,$ss);

$ss1 = array_unique($ss[0]);
print_r($ss1);


?>
