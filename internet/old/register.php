<?php
$sss = mysql_connect("localhost", "root", "356386") or
die("Ошибка соединения: " . mysql_error());
mysql_set_charset('utf8',$sss);
mysql_select_db("mydb");
$result = mysql_query("SELECT info2_name FROM info2");
while ($row[]=mysql_fetch_array($result)) {
}
if($_POST[sex] == 1)
{$sex1 = "checked";}
if($_POST[sex] == 2)
{$sex2 = "checked";}
echo "<html>\n";
echo "<head>\n";
echo "<meta charset=utf-8>\n";
echo '<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js" type="text/javascript"></script>'."\n";
echo '<script type="text/javascript">'."\n";
echo '$(document).ready(function(){$("#suka").mouseup(function(){var info3 = $(\'#suka\').val();$.post("reg.php",{status: info3},function(data){$(\'.abas\').remove(); $(\'#sss\').append("<option class=\'abas\' selected disabled>Выберите</option>");  $.each(data, function(i, val) $(\'#sss\').append("<option class=\'abas\' value="+i+">"+val+"</option>"));}, "json");});});';
echo '$(document).ready(function(){$("#suka").ready(function(){var info3 = $(\'#suka\').val();$.post("reg.php",{status: info3},function(data){$(\'.abas\').remove(); $(\'#sss\').append("<option class=\'abas\' selected disabled>Выберите</option>");  $.each(data, function(i, val) $(\'#sss\').append("<option class=\'abas\' value="+i+">"+val+"</option>"));}, "json");});});';
//echo ''
echo '</script>'."\n";
echo "</head>"."\n";
echo "Здавствуйте вы попали в локальную сеть от <b>БОТТЬООККУ</b><br>для того чтобы пользоваться интерентом зарегистрируйтесь отвечая на эти вопросы.<br>прошу пишите только правду и ничего кроме правды <b>это для вашего же блага...</b> ";
echo "<br><br><br><b>Регистрация</b>";
echo '<form action="register2.php" method="post">';
echo "<br>Введите имя пользователья: <br><input type='text' name='user' size='10'>";
echo "<br>Введите пароль:<br> <input type='password' name='pass1' size='10'";
echo "<br>Введите подтверждение пароля: <br><input type='password' name='pass2' size='10'";
echo "<br><br>Выберите пол: ";
echo "<input type='radio' $sex1 name='sex' value='1'> Мужской <input type='radio' $sex2 name='sex' value='2'>Женский<br>";
echo "<br>Введите возраст: <input type='text' name='old' size='2' value=$_POST[old]>";
echo '<br><br>Социальный статус: <select id="suka" name=status>';
if(is_numeric($_POST[status]))
{
	echo "<option disabled>Выберите</option>";
}
else
{
	echo "<option selected disabled>Выберите</option>";
}
foreach ($row as $key => $status)
{
	        if($status === end($row))
        {
                continue;
        }

	$ss = $key + 1;
	if ($_POST[status] == $ss)
	{
		echo "<option selected value=$ss>$status[0]</option>";
	}
	else
	{
		echo "<option value=$ss>$status[0]</option>";
	}
}
echo "</select>";
echo '<select id="sss" name=status2>';
//echo "<option selected disabled>Выберите</option>";
echo '</select>';
echo '<p><input type="submit" value="Далее"></p>';
return;
?>
