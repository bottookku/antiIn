<?php
//////////////////////////////////////////
///проверяет логин введенный через POST///
//////////////////////////////////////////
if($_POST[user]==null)
{
echo "not";
return;
}
require_once __DIR__."/../function/db.php";
$req = "SELECT user,pass FROM user WHERE user=\"".$_POST[user]."\"";
$row1 = db_req($req);
if($_POST[pass] == $row1[0][pass])
{
echo "ok";
setcookie("id" ,$_POST[user]."_".$_POST[pass], time()+(60*60*24*365), "/");
}
else
{
echo "not";
}
return;
?>
