<?php
$sss = mysql_connect("localhost", "root", "356386") or
die("Ошибка соединения: " . mysql_error());
mysql_set_charset('utf8',$sss);
mysql_select_db("mydb");
$tt = 0;
$s = 0;
for($i = 0 ; $i <= 1000; $i++)
{
if($s<255)
{
$s++;
$ip = "10.".$tt.".".$s.".0/24";
}
else
{
$tt++;
$s=0;
$ip = "10.".$tt.".".$s.".0/24";
}
mysql_query("INSERT INTO `mydb`.`local_net` (`local_net`) VALUES ('$ip')");
}
?>
