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
        mysql_query("DELETE FROM mydb.rekl_page WHERE rekl_id=".$_GET[id]);
        mysql_query("DELETE FROM mydb.rekl_id WHERE rekl_id=".$_GET[id]);
        echo "<meta charset=utf-8>";
        echo "Удалено<br><a href=rekl_add.html>Назад</a>";
}
else
{
        echo "<meta charset=utf-8>";
        echo "<br><a href=login.html>Атворизироваться</a>";

}
?>
