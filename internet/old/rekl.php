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

//вытащить всю таблицу.
	$ss = mysql_fetch_array(mysql_query("SELECT user_id FROM mydb.user WHERE user=\"".$ss[0]."\""));
	$ss = $ss[user_id];
	$ss1 = mysql_query("SELECT rekl_id FROM mydb.rekl_id WHERE owner_id=$ss");
	while($ss2[] = mysql_fetch_array($ss1)){}
	foreach($ss2 as $ss4)
	{
		$ss22[] = $ss4[rekl_id];
	}
	$array = array_diff($ss22, array(''));
	foreach($array as $sss => $sss1)
	{
		$ssv = mysql_query("SELECT * FROM mydb.rekl_page WHERE rekl_id=".$sss1);
		$ssv = mysql_fetch_array($ssv);
		if(is_array($ssv))
		{
			$ff[$sss1]=1;
		}
		else
		{
			$ff[$sss1]=0;
		}
	}
	if ($_POST[0]==1)
	{
		echo json_encode($ff);
		return;
	}
}
?>
