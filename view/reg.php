<html>
<head>
<meta charset=utf8>
<script src=src/jquery-2.1.4.min.js></script>

<script>
$(document).ready(function(){

$('#bt').click(function(){
$('#o').remove();
$.ajax({
	url: "/modules/api.php",
	data:
	{
		"e-mail": $('#email').val(),
		"pass1": $('#pass1').val(),
		"pass2": $('#pass2').val(),
	},
	success: function(res)
	{
		if(res == "ok")
		{
			  window.location.href = "?reg_act"
			//$('#h').append("<font color=green id=o>ВСЕ ОК</font>");
		}
		if(res == "pass_n_e")
		{
			$('#h').append("<font color=red id=o>пароли не совпадают</font>")
		}
		if(res == "pass_n")
		{
			$('#h').append("<font color=red id=o>пароль пустой</font>")
		}
		if(res == "email_n")
		{
			$('#h').append("<font color=red id=o>e-mail путсой</font>")
		}
		if(res == "n_uq")
		{
			$('#h').append("<font color=red id=o>Такой email уже зарегистрирован</font>")
		}
		if(res == "3")
		{
			$('#h').append("<font color=red id=o>Извините но письмо с кодом по каким то причинам не ушло на вашу почту. Свяжитесь с администрацией сайта</font>")
		}
	},
	dataType: "json"
});

});
});
</script>
</head>
<body>
Регистрация
<br><input id=email type=email required maxlenght=42 name=e-mail> e-mail
<br><input id=pass1 type=password required maxlength=42 name=pass1> Пароль
<br><input id=pass2 type=password required maxlength=42 name=pass2> Повтор пароля
<br><button id=bt>отправить</button>
<br><div id=h></div>
</body>
</html>

<?php
?>
