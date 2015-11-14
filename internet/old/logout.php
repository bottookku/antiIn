<?php
setcookie("id" ,$_POST[user]."_".$_POST[pass], 1);
header("Location: login.html");
?>
