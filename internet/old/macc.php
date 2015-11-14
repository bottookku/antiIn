<?php
$in1 = "   A4:f3:43:8f:01:11    ";
$reg_ex_find_mac = '/(^|\s|\t)(([0-9a-fA-F]{2}[:-\s]){5}[0-9a-fA-F]{2}){1}($|\s|\t)/';

preg_match($reg_ex_find_mac,$in1,$mac_address_client);
print_r($mac_address_client);
//echo "--";
?>
