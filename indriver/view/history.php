<html>
<header>
<meta charset=utf8>
<script type="text/javascript" src="/src/jquery-1.11.3.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){

$.post("/indriver/modules/history_all.php","",function(data)
{
	i = 1;
        $.each(data, function(index, value)
        {
		$('.tabl').append("<tr><td>"+i+"</td><td>"+value.from+"</td><td>"+value.to+"</td><td>"+value.price+"</td><td><a href=sip:"+value.phone+">"+value.phone+"</a></td><td>" +value.username+ "</td><td>" +value.priznak+ "</td><td>" +value.date+ "</td></tr>");
		i++;
        }
        );

},"json");
});
</script>
</header>
<body>
<a href=view.php>НАЗАД</a>
<table border="1" class=tabl>
<th>№</th><th>Откудa</th><th>Куда</th><th>Цена</th><th>Телефон</th><th>Позывной</th><th>Признак</th><th>Дата</th>
</table>

</body>
</html>
