<?php
include "module/auth_cookie.php";
if(auth_cookie())
{
	include "view/rest.php";
}
else
{
	if($_GET[page] == "reg")
	{
		include "view/reg.php";
	}
	else
	{
		include "view/login.php";
	}
}
?>
