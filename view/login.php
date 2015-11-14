<html>
<head>
<meta charset=utf8>
<script src=src/jquery-2.1.4.min.js></script>
<script>
$(document).ready(function(){

var lo = window.location.search.substr(1);
if(lo=="co=ok")
{
	$('#dd').append("<font id=o color=green>Код принят, теперь можете заходить по своему логину и паролю</font>");
}

$('#bt').click(function(){
$('#o').remove();
$.ajax({
        url: "/modules/api.php",
        data:
        {
                "login": $('#login').val(),
                "pass": $('#pass').val(),
        },
        success: function(res)
        {
                if(res == "1")
                {
                        window.location.href = "/"
                }
		if(res == "0")
		{
			$('#dd').append("<font id=o color=red>Пароль или логин не верны</font>");
		}
	},
	dataType: "json"
});
});
});
</script>
</head>
<body>
Введите e-mail
<br><input id=login name=login>
<br>Введите пароль
<br><input id=pass type=password name=pass>
<br><button id=bt>Залогиниться</button>
<br><a href=?rem=1>Забыл пароль</a> <a href=?reg=1>Зарегистрироваться</a>
<div id=dd></div>
</body>
</html>

<?php
?>
