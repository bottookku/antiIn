<?php
$sss = mysql_connect("localhost", "root", "356386") or
die("Ошибка соединения: " . mysql_error());
mysql_set_charset('utf8',$sss);
mysql_select_db("mydb");

//Вычисляет стоимость показа $g1[cost]
$g1 = mysql_query("SELECT cost FROM mydb.cost WHERE cost_id=0");
$g1 = mysql_fetch_assoc($g1);
echo $g1[cost];
?>
