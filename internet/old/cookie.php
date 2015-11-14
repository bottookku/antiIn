<?php
setcookie ("id", "", 1);
setcookie("id" ,$_POST[user]."_".$_POST[pass], time()+(60*60*24*365));
?>
