<?php
if(preg_match('/^[a-z0-9]{4,10}$/',$_POST[user]))
{

if($_POST[pass1] == $_POST[pass2])
{
if(preg_match('/^[a-z0-9]{4,10}$/',$_POST[pass1]))
{

require_once __DIR__."/../function/db.php";
$req = "SELECT * FROM user WHERE user=\"".$_POST[user]."\"";
$row1 = db_req($req);
if($row1[0][0])
{
{echo "Пользователь с такими именем уже есть";}
}
else
{
				$date = date("Y-m-d H:i:s");
				$result  = mysql_query("INSERT INTO user (user,pass,sex,old,info3_id,date_reg) VALUE ('$_POST[user]','$_POST[pass1]','$_POST[sex]','$_POST[old]','$_POST[status2]','$date')");
                                $suk =  mysql_insert_id();
			//	echo $suk;
                                if (!$result) {
                                   die('Не верный запрос: ' . mysql_error());
                                        return;}


echo "ok";}
}
else
{echo "пароль должен состоять минимум из 4 максимум из 10 латинских букв и арабских цифр, только в нижнем регистре";}

}

else
{echo "парльи не одинаковые";}

}
else
{
 echo "логин должен состоять минимум из 4 и максимум 10 только латинские буквы и арабские цифры, только в нижнем регистре";
}
?>
