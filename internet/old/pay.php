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
	//Выявить USER_ID $ss[user_id]
	$sss = mysql_query("SELECT user_id FROM mydb.user WHERE user=\"".$ss[0]."\"");
	$ss = mysql_fetch_assoc($sss);
	echo "<meta charset=utf-8>";
	echo "<br><a href=rekl_add.html>Назад</a></br>";
	echo "<b><font color=red size=5>Пержде чем приступить к оплате, надо получить доступ в интернет<br></font>";
	echo "Потому что большинство банков используют дополнительный метод авторизации через интеренет<br>";
	echo '<iframe frameborder="0" allowtransparency="true" scrolling="no" src="https://money.yandex.ru/embed/shop.xml?account=410013226131594&quickpay=shop&payment-type-choice=on&writer=seller&targets=%D0%97%D0%B0+%D1%83%D1%81%D0%BB%D1%83%D0%B3%D0%B8+%D1%80%D0%B5%D0%BA%D0%BB%D0%B0%D0%BC%D1%8B+%D0%BD%D0%B0+bottookku.tk&targets-hint=&default-sum=&button-text=01&successURL=bottookku.tk%2Frekl_add.html&label='.$ss[user_id].'" width="450" height="200"></iframe>';
}
else
{
	echo "<meta charset=utf-8>";
	echo "авторизации нет ";
	echo "<a href=login.html>войти</a></br>";
}
?>
