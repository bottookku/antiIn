<?php
$ip = "0.0.0.999";
echo preg_match("/(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/",$ip);

//$_SERVER["REMOTE_ADDR"];
//$_COOKIE[id];

/*
$sss = mysql_connect("localhost", "root", "356386") or
die("Ошибка соединения: " . mysql_error());
mysql_set_charset('utf8',$sss);
mysql_select_db("mydb");
$result2 = mysql_query("SELECT * FROM mydb.rekl_page WHERE user=\"".$_POST[user]."\"");
while ($row1[]=mysql_fetch_array($result2)) {
}

*/

?>
