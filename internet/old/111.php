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



//снимает значения рекламного текста
$T1 = mysql_query("SELECT title,text,answer,captcha,hint,num FROM mydb.rekl_page WHERE rekl_id=$_GET[1]");
while($T2[] = mysql_fetch_assoc($T1)){}
$arr = array_diff($T2, array(''));

//снимает показания редиректов и рестиктов
$T33 = mysql_query("SELECT * FROM mydb.rekl_id WHERE rekl_id=$_GET[1]");
while($T22[] = mysql_fetch_assoc($T33)){}
$arr1 = array_diff($T22, array(''));

//вычисляет id пользователя $fff1[user_id]
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



echo "<meta charset=utf-8>";
echo "<form method=POST action=112.php>";
echo "<a href=/rekl_add.html>Назад</a><br>";
$bb = $_GET[2];
for ($i = 1; $i <= 3; $i++) {
if ($bb == $i)
{
echo " Часть № ".$i." ";
}
else
{
echo "<a href=111.php?1=".$_GET[1]."&2=".$i.">Перейти на часть № ".$i."</a> ";
}
}
echo "<br><b>Реклама №".$_GET[1]." Часть: ".$bb."</b>";
echo "<br>Заголовок*:<br><input maxlength=30 required size=30 value='".$arr[$bb-1][title]."' name=title>";
echo "<br>Текст*: <br><textarea maxlength=500 required name=text cols=47 rows=3>".$arr[$bb-1][text]."</textarea>";
echo "<br>Вопрос*:<br><input required maxlength=100 size=100 value='".$arr[$bb-1][answer]."' name=answer>";
echo "<br>Ответ*:<br><input required maxlength=30 size=30 value='".$arr[$bb-1][captcha]."' name=captcha>";
echo "<br>Посказка:<br><input size=100 maxlength=100 value='".$arr[$bb-1][hint]."' name=hint>";
echo "<input hidden value=".$bb." name=num>";
echo "<input hidden value=".$_GET[1]." name=id>";
echo "<br>Редирект:<br><input size=60 value='".$arr1[0][redirect]."' name=redirect>";
////////////////////////////////////////////////////
//$res0 сколько всего ресов у этого пользователя  //
// деньги цена ресы                               //
// денгьи/цену - ресы = доступно                  //
////////////////////////////////////////////////////
$dostupno = $coin5/$g1[cost] - $res0;
$dostupno = intval($dostupno);
$ss_a = $dostupno + $arr1[0][restrict];

echo "<br>Утсановить количество показов<br><input type=number min=0 max=".$ss_a." size=60 value='".$arr1[0][restrict]."' name=restrict>";


echo "Цена: ".$g1[cost]."\n";
echo "Баланс: ".$coin5."\n";
echo "Ресов: ".$res0."\n";
echo "Доступно: ".$dostupno."\n";


echo "<br>Вашего баланса хватает еще на ".$dostupno." показа";
echo "<br>Это объявления было показано ".$arr1[0][restrictred]." раз";
echo "<br><br><input type=submit value=Сохранить></form>";
echo "<form method=POST action=dell.php><input hidden value=".$_GET[1]." name=id>";
echo "<input type=submit value=Удалить></form>";

}
else
{
        echo "<meta charset=utf-8>";
        echo "авторизации нет ";
        echo "<a href=login.html>войти</a></br>";

}


?>
