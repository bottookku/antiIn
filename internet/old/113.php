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
	//ПРОВЕРКА НА АДМИНА
	$sss = mysql_query("SELECT role FROM mydb.user WHERE user=\"".$ss[0]."\"");
	$ss = mysql_fetch_assoc($sss);
	if($ss[role] == 1)
	{
		//снимает значения рекламного текста
		$T1 = mysql_query("SELECT title,text,answer,captcha,hint,num FROM mydb.rekl_page WHERE rekl_id=0");
		while($T2[] = mysql_fetch_assoc($T1)){}
		$arr = array_diff($T2, array(''));
		//снимает показания редиректов и рестиктов
		$T33 = mysql_query("SELECT * FROM mydb.rekl_id WHERE rekl_id=0");
		while($T22[] = mysql_fetch_assoc($T33)){}
		$arr1 = array_diff($T22, array(''));
		echo "<meta charset=utf-8>";
		echo "<form method=POST action=114.php>";
		echo "<a href=/cost.php>Назад</a><br>";
		$bb = $_GET[2];
		for ($i = 1; $i <= 3; $i++)
		{
			if ($bb == $i)
			{
				echo " Часть № ".$i." ";
			}
			else
			{
				echo "<a href=113.php?2=".$i.">Перейти на часть № ".$i."</a> ";
			}
		}
		echo "<br><b>Реклама по дефаулту. Часть: ".$bb."</b>";
		echo "<br>Заголовок*:<br><input maxlength=30 required size=30 value='".$arr[$bb-1][title]."' name=title>";
		echo "<br>Текст*: <br><textarea maxlength=500 required name=text cols=47 rows=3>".$arr[$bb-1][text]."</textarea>";
		echo "<br>Вопрос*:<br><input required maxlength=100 size=100 value='".$arr[$bb-1][answer]."' name=answer>";
		echo "<br>Ответ*:<br><input required maxlength=30 size=30 value='".$arr[$bb-1][captcha]."' name=captcha>";
		echo "<br>Посказка:<br><input size=100 maxlength=100 value='".$arr[$bb-1][hint]."' name=hint>";
		echo "<input hidden value=".$bb." name=num>";
		echo "<input hidden value=0 name=id>";
		echo "<br>Редирект:<br><input size=60 value='".$arr1[0][redirect]."' name=redirect>";
		echo "<br>Это объявления было показано ".$arr1[0][restrictred]." раз";
		echo "<br><br><input type=submit value=Сохранить></form>";
	}
	else
	{
	        echo "<meta charset=utf-8>";
	        echo "Вы не админ";
	        echo "<br><a href=lk.html>Назад</a></br>";
	}
}
else
{
        echo "<meta charset=utf-8>";
        echo "авторизации нет ";
        echo "<a href=login.html>войти</a></br>";

}
?>
