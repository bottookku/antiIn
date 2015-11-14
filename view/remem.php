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
                "email": $('#login').val(),
        },
        success: function(res)
        {
                if(res == "1")
                {
			$('#dd').append("<font id=o color=green>Письмо с паролем отправлено на вашу почту</font>");
                }
                if(res == "0")
                {
                        $('#dd').append("<font id=o color=red>Эта электронная почта не зарегистрирована</font>");
                }
		if(res == "2")
		{
			$('#dd').append("<font id=o color=red>По каким то причинам письмо не ушло свяжитесь с администрацией сайта</font>");
		}
        },
        dataType: "json"
});
});
});
</script>



</head>
<body>
Введите email
<input id=login type=email name=email required>
<br><button id=bt>отправить</button>
<div id=dd>
</body>
</html>
<?php
?>
