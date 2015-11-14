<?php
//если переходит в редактор рекламы
if(isset($_GET['rekla']))
{
        include("/var/www/view/rek.php");
        return;
}

//востановить пароль
if(isset($_GET['rem']))
{
	require_once("/var/www/view/remem.php");
	return;
}
//регистрация
if(isset($_GET['reg']))
{
	require_once("/var/www/view/reg.php");
	return;
}
//Письмо с кодом отправлено
if(isset($_GET['reg_act']))
{
	require_once("/var/www/view/reg_act.php");
	return;
}
//Верен ли код активации
if(isset($_GET['code']))
{
	require_once("/var/www/modules/api.php");
	require_once("/var/www/view/code.php");
	return;
}
$suka = "12";
//Проверка кукисов
if(require_once("/var/www/modules/api.php"))
{
	$_GET['acc']="1";
	if(include("/var/www/modules/api.php"))
	{
		include("/var/www/view/rekl.php");
	}
	else
	{
		include("/var/www/view/not_acc.php");
	}
}
else
{//если кукисы не верны
	require_once("/var/www/view/login.php");
}
?>
