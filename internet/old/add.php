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
	$result2 = mysql_query("SELECT user_id FROM mydb.user WHERE user=\"".$ss[0]."\"");
	$row1=mysql_fetch_assoc($result2);
	mysql_query("INSERT INTO mydb.rekl_id (owner_id) VALUES (".$row1[user_id].")");
	$id = mysql_insert_id();
	mysql_query("INSERT INTO mydb.rekl_page(title,text,answer,captcha,hint,num,rekl_id) VALUES (NULL,NULL,NULL,NULL,NULL,1,".$id.")");
	mysql_query("INSERT INTO mydb.rekl_page(title,text,answer,captcha,hint,num,rekl_id) VALUES (NULL,NULL,NULL,NULL,NULL,2,".$id.")");
	mysql_query("INSERT INTO mydb.rekl_page(title,text,answer,captcha,hint,num,rekl_id) VALUES (NULL,NULL,NULL,NULL,NULL,3,".$id.")");
}
//$ss = mysql_query("SELECT * FROM mydb.rekl_page WHERE rekl_id=7");
//print_r(mysql_fetch_array($ss));
?>
