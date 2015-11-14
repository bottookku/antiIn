<?php
$ss = explode("_",$_COOKIE[id]);
$sss = mysql_connect("localhost", "root", "356386") or
die("Ошибка соединения: " . mysql_error());
mysql_set_charset('utf8',$sss);
mysql_select_db("mydb");
$result2 = mysql_query("SELECT user,pass FROM mydb.user WHERE user=\"".$ss[0]."\"");
while ($row1[]=mysql_fetch_array($result2)){}
if($ss[0]==$row1[0][0]&&$ss[1]==$row1[0][1]&&$row1[0][0]!==null)
{
	echo "<meta charset=utf-8>";
	if($_POST[title]==""||$_POST[text]==""||$_POST[answer]==""||$_POST[captcha]=="")
	{
		echo "<b><font color=red>Заполните все поля!!</b>";
		echo "<br><a href=$_SERVER[HTTP_REFERER]>Назад</a>";
	return;
	}
	//снимает показания редиректов и рестиктов
	$T33 = mysql_query("SELECT * FROM mydb.rekl_id WHERE rekl_id=$_POST[id]");
	while($T22[] = mysql_fetch_assoc($T33)){}
	$arr1 = array_diff($T22, array(''));
	//print_r($arr1);
	//Вычисляет ID пользователя
	$ff1 = mysql_query("SELECT user_id FROM mydb.user WHERE user=\"".$ss[0]."\"");
	$fff1 = mysql_fetch_assoc($ff1);
	//вычисляет сумму рестиктов у текущего пользователя $res0
	$T3f = mysql_query("SELECT * FROM mydb.rekl_id WHERE owner_id='".$fff1[user_id]."'");
	while ($row1[]=mysql_fetch_array($T3f)){}
	$res0 = 0;
	foreach($row1 as $kopb)
	{
        	$res1 = $kopb[restrict];
	        $res0 = $res0 + $res1;
	}
	//вычисляет сумму денег $coin5;
	$coin1 = mysql_query("SELECT coin_summ FROM mydb.coin_summ WHERE user_id=\"".$fff1[user_id]."\"");
	$rww = mysql_fetch_assoc($coin1);
	$coin5 = $rww[coin_summ];
	//Вычисляет стоимость показа $g1[cost]
	$g1 = mysql_query("SELECT cost FROM mydb.cost WHERE cost_id=0");
	$g1 = mysql_fetch_assoc($g1);
	// Расчмитывет сколько доступно
	$dostupno = $coin5/$g1[cost] - $res0;
	$dostupno = intval($dostupno);

	/*
	echo "Цена: ".$g1[cost]."\n";
	echo "Баланс: ".$coin5."\n";
	echo "Ресов всего: ".$res0."\n";
	echo "Доступно: ".$dostupno."\n";
	echo "Сколько ресов ввожу:".$_POST[restrict]."\n";
	*/

	// Проверяет есть ли пустые строки обязательные...
	$field = mysql_query("SELECT * FROM mydb.rekl_page WHERE rekl_id=".$_POST[id]);
	while ($field1[]=mysql_fetch_assoc($field)){}
	$aab = 1;
	foreach($field1 as $fill)
	{
		//пропустить последнюю итерацию
		if($fill == end($field1))
		{
			break;
  		}
		if($fill[title]==""||$fill[text]==""||$fill[answer]==""||$fill[captcha]=="")
		{
			$aab = 0;
		}
	}
	//ввести ТЕКСТ
	$ss = "UPDATE mydb.rekl_page SET title='".$_POST[title]."', text='".$_POST[text]."', answer='".$_POST[answer]."', captcha='".$_POST[captcha]."', hint='".$_POST[hint]."' WHERE rekl_id='".$_POST[id]."' AND num='".$_POST[num]."'";
	mysql_query($ss);
        //////ХВАТАЕТ ЛИ ДЕНЕГ?
        $aag = $_POST[restrict] - $arr1[0][restrict];
        if ($dostupno < $aag)
        {
                echo "Не хватает средств для показа даного количества";
                echo "<br><a href=$_SERVER[HTTP_REFERER]>Назад</a>";
                return;
        }
	//ЕСЛИ есть пустые строки то не запсать ПОКАЗЫ
        if ($aab == 0 && $_POST[restrict] > 0)
        {
		echo "Показы не установлены<br>";
                echo "Заполните все поля всех трех частей этого объявления<br>";
		echo "<br><a href=$_SERVER[HTTP_REFERER]>Назад</a>";
                return;
        }
	if ($_POST[restrict] < 0)
	{
		//////////////ВНИМАНИЕ ХАК!!!!!!!!!!
		echo "Ты че сука самый умный что ли?";
		return;
	}
	//       <<<<<<<<<<ВВЕСТИ РЕСТРИКТ>>>>>>>>
	$fuu = "UPDATE mydb.rekl_id SET `restrict`='".$_POST[restrict]."', `redirect`='".$_POST[redirect]."' WHERE rekl_id='".$_POST[id]."'";
	mysql_query($fuu);
	echo "<b><font color=green>Сохранено</b>";
	echo "<br><a href=$_SERVER[HTTP_REFERER]>Назад</a>";
}
else
{
        echo "<meta charset=utf-8>";
        echo "авторизации нет ";
        echo "<a href=login.html>войти</a></br>";
}
?>
