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



		echo "<meta charset=utf-8>";
		if($_POST[title]==""||$_POST[text]==""||$_POST[answer]==""||$_POST[captcha]=="")
		{
			echo "<b><font color=red>Заполните все поля!!</b>";
			echo "<br><a href=$_SERVER[HTTP_REFERER]>Назад</a>";
			return;
		}

		//ВВЕСТИ ТЕКСТ
		$ss = "UPDATE mydb.rekl_page SET title='".$_POST[title]."', text='".$_POST[text]."', answer='".$_POST[answer]."', captcha='".$_POST[captcha]."', hint='".$_POST[hint]."' WHERE rekl_id='".$_POST[id]."' AND num='".$_POST[num]."'";
		mysql_query($ss);

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

		//если есть пустые строки все остановить...
	        if ($aab == 0)
	        {
        	        echo "Внимание показ не полноценный<br>";
	                echo "Заполните все поля всех трех частей этого объявления<br>";
	                echo "<br><a href=$_SERVER[HTTP_REFERER]>Назад</a>";
			return;
	        }

		//ввести редирект
		$fuu = "UPDATE mydb.rekl_id SET redirect='".$_POST[redirect]."' WHERE rekl_id=0";
	        mysql_query($fuu);
		echo "<b><font color=green>Сохранено</b>";
		echo "<br><a href=$_SERVER[HTTP_REFERER]>Назад</a>";
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
