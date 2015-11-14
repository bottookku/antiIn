<?php
$ss = explode("_",$_COOKIE['id']);
$sss = mysql_connect("localhost", "root", "356386") or
die("Ошибка соединения: " . mysql_error());
mysql_set_charset('utf8',$sss);
mysql_select_db("mydb");
$result2 = mysql_query("SELECT user,pass FROM mydb.user WHERE user=\"".$ss[0]."\"");
while ($row1[]=mysql_fetch_array($result2)){}
if($ss[0]==$row1[0][0]&&$ss[1]==$row1[0][1]&&$row1[0][0]!==null)
//ЕСЛИ ПАРОЛЬ И ЛОГИН ИЗ КУКИ ВЕРНЫ...
{
	//print_r($_POST);
        //Выявить USER_ID $x[user_id]
        $user_id10 = mysql_query("SELECT user_id FROM mydb.user WHERE user=\"".$ss[0]."\"");
        $user_id10 = mysql_fetch_assoc($user_id10);
        $user_id10 = $user_id10[user_id];
	echo "<meta charset=utf-8>";
	if($_GET==!null)
	{
		$fj2 = mysql_query("SELECT router_owner FROM mydb.routers WHERE router_id=$_GET[id]");
		$fj2 = mysql_fetch_assoc($fj2);
		if($fj2[router_owner]==$user_id10)
		{
			if($_GET[yes]==1)
			{
				mysql_query("DELETE FROM mydb.routers WHERE router_id=$_GET[id] AND router_owner=$user_id10");
				header("Location: routers.php");
			}
			else
			{
				echo "Вы действительно хотите? удалить ваш роутер";
				echo "<br><a href=routers.php>Нет</a>----/----<a href=routers.php?id=$_GET[id]&yes=1>Да</a>";
				return;
			}
		}
		else
		{
			//ХАКЕР!!!!!!!;;
		}
	}
	//есть ли пост запрос
	if($_POST==!null)
        {
		//если ли пост добавления роутера
		if($_POST[add]==1)
		{
			//БЕРЕМ СПИСОК ip
			$fop2 = mysql_query("SELECT local_net_id FROM mydb.routers ORDER BY local_net_id");
			while ($fop3[] = mysql_fetch_assoc($fop2)){};
			$ipp1 = array_filter($fop3);
			//print_r($ipp1);
			if(empty($ipp1))
			{
				$ad55 = 1;
			}
			else
			{
				foreach($ipp1 as $key => $ss12)
				{
					$key = $key + 1;
					if($key!=$ss12[local_net_id])
					{
						$ad55=$key;
						break;
					}
					else
					{
						$ad55=$key+1;
					}
				}
			}
			//добавили запись о новом роутере
			$fj1 = "INSERT INTO mydb.routers (router_owner, local_net_id) VALUES ($user_id10, $ad55)";
			//Вывести айпи пптп удаленный
			$local_ipp = mysql_query("SELECT local_net FROM local_net WHERE local_net_id=$ad55");
			$local_ippp = mysql_fetch_assoc($local_ipp);
			$local_ip = $local_ippp[local_net];
			$local_ip = str_replace("0/24","254",$local_ip);
			mysql_query($fj1);
			$id23 = mysql_insert_id();
			$user = "pptp".$id23;
			//генератор пароля
			$chars="qazxswedcvfrtgbnhyujmkiolp1234567890";
			$max=8;
			$size=StrLen($chars)-1;
			$password=null;
			while($max--)
			$password.=$chars[rand(0,$size)];
			//Обновили инфу о PPPTP логинах и парлях
			$sf2 = "UPDATE mydb.routers SET pptp_user='$user', pptp_pass='$password', pptp_client_ip='$local_ip' WHERE router_id=$id23 AND router_owner=$user_id10";
			mysql_query($sf2);
		}
		else
		{

				//Обновляет инфу где rputer_id = $_POST[router_id] и где router_owner == COOKIE[user_id]
				//ЗАЩИЩАЕТ ОТ НЕСАНЦИОНИРОВАННОГО ДОСТУПА К ЧУЖИМ ЗАПСИЯМ...
				$ssg1 = "UPDATE mydb.routers SET brand_id=$_POST[brand_id], model='$_POST[model]', router_login='$_POST[router_login]', router_pass='$_POST[router_pass]' WHERE router_id=$_POST[router_id] AND router_owner=$user_id10;";
				mysql_query($ssg1);
		}
        }
	//вывести данные по роутерам
	$ff2 = mysql_query("SELECT * FROM mydb.routers LEFT JOIN mydb.local_net ON routers.local_net_id=local_net.local_net_id WHERE router_owner=$user_id10");
	while ($ff3[] = mysql_fetch_assoc($ff2)){};
	$ff3 = array_filter($ff3);
	//вывести список моделей
	$dd = mysql_query("SELECT * FROM mydb.router_brand_list");
	while ($dd1[] = mysql_fetch_assoc($dd)){};
	$dd = array_filter($dd1);
	//print_r($ff3);
//////////////////////////////////////////////////////////////////////////////
/*\\\\*/echo "<font color=red>Добавить колонку адресс!!!!!!!!! Или широта долгота<br></font>";//////
//////////////////////////////////////////////////////////////////////////////
	echo "<a href=lk.html>Назад</a><br>";
        echo "<form action=routers.php method=post>";
        echo "<input hidden name=add value=1>";
        echo "<br><br><input type=submit value='Добавить роутер'></form>";
	echo "Мои роутеры<br>";
	echo "<table><tr><th>id</th><th>ssh login</th><th>ssh pass</th><th>local network</th><th>brand</th><th>model</th><th>ppp user</th><th>ppp pass</th><th>pptp status</th></tr>";
	foreach($ff3 as $key => $val)
	{
		echo "<form action=routers.php method=post>";
		echo "<tr><td>$val[router_id]<input hidden value=$val[router_id] name=router_id></td>";
		echo "<td><input size=3 value='$val[router_login]' name=router_login></td>";
		echo "<td><input size=5 value='$val[router_pass]' name=router_pass></td>";
		echo "<td>$val[local_net]</td>";
		echo "<td><select name=brand_id>";
		foreach($dd as $vvj => $vvj1)
		{
			if($vvj1[brand_id] == $val[brand_id])
			{
				echo "<option selected value=$vvj1[brand_id]>$vvj1[brand]</option>";
			}
			else
			{
				echo "<option value=$vvj1[brand_id]> $vvj1[brand]</option>";
			}
		}
		echo "</select></td>";
		echo "<td><input size=5 value=$val[model] name=model><br></td>";
		echo "<td>$val[pptp_user]</td>";
		echo "<td>$val[pptp_pass]</td>";
		//echo "<td>$val[pptp_pass]</td>";
		if($val[pptp_status] == 1)
		{
			echo "<td><font color=green>Online</font></td>";
		}
		else
		{
			echo "<td><font color=red>Offline</font></td>";
		}
		echo "<td><input type=submit value=save><a href=routers.php?id=$val[router_id]>remove</a></td></form><form action=routers.php method=post>";
		if($val[pptp_status] == 1)
		{
			echo "<td><input hidden name=check value=1><input hidden name=id value=$val[router_id]><input hidden name=login value='$val[router_login]'><input hidden name=pass value='$val[router_pass]'><input hidden name=ip value='$val[pptp_client_ip]'><input type=submit value='check ssh auth'></form></td>";
			if($_POST[check]==1)
			{
				if($val[router_id]==$_POST[id])
				{
					echo "<td>";
					$conn = ssh2_connect($_POST[ip], 22);
					if (ssh2_auth_password($conn,$_POST[login],$_POST[pass])==true)
					{
						echo "<font color=green>Проверено</font>";
					}
					else
					{
						echo "<font color=red>Ошибка</font>";
					}
					echo "</td>";
					ssh2_exec($conn,'exit');
					unset($conn);
				}
			}
		}
		echo "</tr>";
	}
	echo "</table>";
}
?>
