<?php
$ss = explode("_",$_COOKIE[id]);
$sss = mysql_connect("localhost", "root", "356386") or
die("Ошибка соединения: " . mysql_error());
mysql_set_charset('utf8',$sss);
mysql_select_db("mydb");
$result2 = mysql_query("SELECT user,pass FROM mydb.user WHERE user=\"".$ss[0]."\"");
while ($row1[]=mysql_fetch_array($result2)){}
if($ss[0]==$row1[0][0]&&$ss[1]==$row1[0][1]&&$row1[0][0]!==null)
//ЕСЛИ ПАРОЛЬ И ЛОГИН ИЗ КУКИ ВЕРНЫ...
{

	$sss = mysql_query("SELECT user_id FROM mydb.user WHERE user=\"".$ss[0]."\"");
	$ss = mysql_fetch_assoc($sss);
	//echo $ss[user_id];
	$sss = mysql_query("SELECT coin_summ FROM mydb.coin_summ WHERE user_id=\"".$ss[user_id]."\"");
	$rww = mysql_fetch_assoc($sss);
	//echo $rww[coin_summ];
	if ($rww[coin_summ]=="")
	{
		echo "0";
	}
	else
	{
		echo $rww[coin_summ];
	}
}
?>
