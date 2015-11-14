<html>
<head>
<meta charset=utf8>
<script type="text/javascript" src="/src/jquery-1.11.3.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$.post("/indriver/modules/pozivnoi.php",{poziv: 2},function(data)
{
	$.each(data, function (index, value)
	{
		if(value.work==1)
		{var vat = "Работает";}
		if(value.work==0)
		{var vat = "Не работает";}
		$('#table').append("<tr><td>"+value.taxist_id+"</td><td>"+value.username+"</td><td>"+value.priznak+"</td><td><button class='su' value="+value.taxist_id+":"+value.work+">"+vat+"</button></tr>");
	});
	$('.su').click(function(){
	$.post("/indriver/modules/pozivnoi.php",{tax_work: $(this).val()},function(data)
	{
		if(data==1)
		{
			location.reload();
		}
	});
	});
},"json");
});
</script>
</head>
<body>
<a href=/indriver/view/view.php>Назад</a>
<a href=/indriver/view/taxist_admin.php>Управление таксистами</a>
<table id=table border="1">
<th>ID</th><th>Позывной</th><th>Признак</th><th>Состояние</th>
</table>
</form>
</body>
</html>
