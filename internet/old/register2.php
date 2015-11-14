<?php
echo '<form action="register2.php" method="post">';
echo "<meta charset=\"utf-8\">";
echo "<input type='hidden' name='sex' value=".$_POST[sex].">";
echo "<input type='hidden' name='old' value=".$_POST[old].">";
echo "<input type='hidden' name='status' value=".$_POST[status].">";
echo "<input type='hidden' name='count' value=".$_POST[count].">";
echo "<input type='hidden' name='mac' value=".$_POST[mac].">";





$sss = mysql_connect("localhost", "root", "356386") or
die("Ошибка соединения: " . mysql_error());
mysql_set_charset('utf8',$sss);
mysql_select_db("mydb");
$result2 = mysql_query("SELECT info3_id,info3_name FROM info3 WHERE info2_id = $_POST[status]");
while ($row1[]=mysql_fetch_array($result2)) {
}

if ($_POST[pass1] != $_POST[pass2])
{
echo "<b><font color='red'>пароли не совападают<br></font></b>";
return;
}
if(preg_match('/(?=.*[A-Z])(?=.*[a-z]).*$/',$_POST[pass1]))
{
echo "ALL GOOD";
return;
}
else
{
echo "very BAD";
retunr;
}








if ($_POST[sex] == 1 || $_POST[sex] == 2)
{
        if ($_POST[old] < 100 && $_POST[old] > 1)
        {
                if($_POST[status] <= $_POST[count] && $_POST[status] >= 1)
                {
			if($_POST[status2] > 0)
			{
				$result  = mysql_query("INSERT INTO user (mac,sex,old,info3_id) VALUE ('$_POST[mac]',$_POST[sex],$_POST[old],$_POST[status2])");
				$suk =  mysql_insert_id();
				echo "asd";
				echo $suk;
				if (!$result) {
 				   die('Неверный запрос: ' . mysql_error());
					return;
				}
				$result1 = mysql_query("INSERT INTO hobbi * VALUE (NULL,$_POST[hobbi],$suk");
				 if (!$result1) {
                                   die('Неверный запрос: ' . mysql_error());
                                        return;
                                }

				/////////////////////////////////
				/// здесь подтверждение успеха //
				/////////////////////////////////
				echo "<font color=green><b>Поздравляю вы успешно зарегались</b></font>";
				echo "<br>можете пользоваться инетом! <b>на какоето время.</b> <br>если интернет <b>исчезнет</b><br>надо будет зайти через <b>барузер</b> <br>и вас перенаправит опять на этот сайт<br>и следуйте дальнейшим инстукциям но об этом позже<br><br><br><br>p.s.: для тех кто незнает что такое браузер, это обозреватель интернет страниц... через который вы сейчас видите этот сайт " ;

				return;
			}
			else
			{
				echo "выберите вторую группу";
			}
                }
                else
                {
                        echo "<b><font color='red'>вы забыли указать статус<br></font></b>";
			echo "<a href=/register.php>назад</a>";
			return;
                }
        }
        else
        {
                echo "<b><font color='red'>вы забыли указать возраст<br></font></b>";
		echo "<a href=/register.php>назад</a>";
		return;
        }

}
else
{
echo "<b><font color='red'>вы забыли указать пол<br></font></b>";
echo "<a href=/register.php>назад</a>";
return;
}



?>
