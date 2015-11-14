<?php
ini_set('allow_url_include', '1');


$ss = explode("_",$_COOKIE[id]);
$sss = mysql_connect("localhost", "root", "356386") or
die("Ошибка соединения: " . mysql_error());
mysql_set_charset('utf8',$sss);
mysql_select_db("mydb");
$result2 = mysql_query("SELECT user,pass FROM mydb.user WHERE user=\"".$ss[0]."\"");
while ($row1[]=mysql_fetch_array($result2)){}
if($ss[0]==$row1[0][0]&&$ss[1]==$row1[0][1]&&$row1[0][0]!==null)
{
$sss = mysql_query("SELECT role FROM mydb.user WHERE user=\"".$ss[0]."\"");
$ss = mysql_fetch_assoc($sss);
if($ss[role] == 1)
{
		if($_POST[time_x]==!null&&$_POST[time_y]==!null&&$_POST[cost]==!null)
		{

			if(preg_match('/^\d{1,2}\.\d{1,2}$/',$_POST[cost])||preg_match('/^\d{1,2}$/',$_POST[cost]))
			{
				mysql_query("UPDATE mydb.cost SET cost=".$_POST[cost]." WHERE cost_id=0");
			}
			else
			{
				echo "<b><font color=red>некорректный формат стоимости</font></b>";
			}


			if($_POST[time_x]>$_POST[time_y])
			{
				if(preg_match('/^(?:[01][0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]$/',$_POST[time_x]))
				{
					if(preg_match('/^(?:[01][0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]$/',$_POST[time_y]))
					{
						mysql_query("UPDATE mydb.time_interval SET time_x='$_POST[time_x]', time_y='$_POST[time_y]' WHERE `time_id`='1';" );
                                	}

				}
			}
			else
			{
				echo "<b><font color=red>Время халявы не должно быть меньше промежутка между ответами<br>";
				echo "это может вызвать проблему с хакерами</font></b>";
			}
		}
		$time_n = mysql_query("SELECT time_x,time_y FROM mydb.time_interval");
		$time_n = mysql_fetch_assoc($time_n);
		$time_x = $time_n[time_x];
		$time_y = $time_n[time_y];
		echo "<meta charset=utf-8>";
		$g1 = mysql_query("SELECT cost FROM mydb.cost WHERE cost_id=0");
		$g1 = mysql_fetch_assoc($g1);
		echo "<meta charset=utf-8>";
		echo "<form method=post action=cost.php>";
		echo "<a href=lk.html>Назад</a></br>";
		//echo "Цена за один показ рекламы (целые числа писать через точку а не через запятую)<br>";
		echo "<input value=".$g1[cost]." name=cost>Цена за один показ рекламы (целые числа писать через точку а не через запятую)";
		echo "<br><input name=time_x value='".$time_x."'>Время халявы";
		echo "<br><input name=time_y value='".$time_y."'>Максимальный промежуток между ответами.";
		echo "<br><input type=submit>";
		echo "</form>";
		echo "<a href=113.php?1=0&2=1>Реклама по дефаулту<a>";




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
	echo "Вы не админ";
        echo "<br>авторизации нет ";
        echo "<a href=login.html>войти</a></br>";

}
?>
