<html>
<head>
<meta charset=utf-8>
<script type="text/javascript" src="/src/jquery-1.11.3.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
        $('#ok').click(function(){
	$('#ss').remove();
        var user = $('#user').val();
        var pass = $('#pass').val();
	$.post("module/check_login.php",{user: user, pass: pass},function(data)
        {
	if (data == "ok")
	{
	$(document).ready(function(){
	//window.location.href = /page=;
	location.reload();
	});
	}
	else
	{
	$('#bott').fadeIn();
	$('#bott').append("<font color=red id=ss>пароль или логин не верны</font>").delay(1000).fadeOut("slow");
	}
	});
	});


});

</script>
</head>
<body>
<center>Авторизация</center>
Введите имя пользователья:<br><input type='text' id='user' size='10'>
<br>Введите пароль:<br><input type='password' id='pass' size='10'>
<br><button id="ok">ACCEPT</button>
<br>если у вас нет логина <a href=?page=reg>зарегистрируйтесь</a>
<div id="bott"></div>
</body>
</html>
