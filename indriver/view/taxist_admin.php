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
                $('#table').append("<tr><td><div name=id>"+value.taxist_id+"</div></td><td><div name=name id=name-"+value.taxist_id+">"+value.username+"</div></td><td><div id=priz-"+value.taxist_id+">"+value.priznak+"</div></td><td><button class=edit id='edit-"+value.taxist_id+"' value="+value.taxist_id+">Редактировать</button><button class=subb hidden id=sub-"+value.taxist_id+" value="+value.taxist_id+">Готово</button></td><td><button class=remove id=remove-"+value.taxist_id+" value="+value.taxist_id+">Удалить</button><div id=remove-1-"+value.taxist_id+"></div></td></tr>")
        });
	$('.edit').click(function(){
		var x = '#name-'+$(this).val();
		var y = $(this).val();
		var d = '#priz-'+$(this).val();
		var f = '#edit-'+$(this).val();
		var g = '#sub-'+$(this).val();
		$.post("/indriver/modules/pozivnoi.php",{poziv: 2},function(data){
			$(x).html("<input id=na-"+y+" value='"+data[y].username+"'>");
			$(d).html("<input id=pr-"+y+" value='"+data[y].priznak+"'>");
			$(f).remove();
			$(g).prop("hidden", false);
			},"json");
	});
	$('.subb').click(function(){
	var d = '#pr-'+$(this).val();
	var x = '#na-'+$(this).val();
	var y = $(this).val();
	var j = $(d).val();
	var k = $(x).val();
	$.post("/indriver/modules/pozivnoi.php",{zimba: 1, taxist_id: y, username: k, priznak: j},function(data)
		{
			if(data==99)
			{
				location.reload();
			}
		});
	});

	$('.remove').click(function()
	{
	var y = $(this).val();
	var d = '#remove-'+$(this).val();
	var g = '#remove-1-'+$(this).val();
	$(d).remove();
	$(g).html("<button id=remove-ok value="+y+">Yes</button><button class=remove-no>No</button>");
		$('#remove-ok').click(function(){
		var y = $(this).val();
		$.post("/indriver/modules/pozivnoi.php",{remove: 2, taxist_id: y},function(data){
			if(data==75)
			{
				location.reload();
			}
		});
	});
});
},"json");
$('#add').click(function()
{
	$.post("/indriver/modules/pozivnoi.php",{add: 1},function(data){
	if(data==45)
	{
		location.reload();
	}
	});
});
});
</script>
</head>
<body>
<a href=/indriver/view/taxist.php>Назад</a>
<table id=table border="1">
<th>ID</th><th>Позывной</th><th>Признак</th><th>Редактировать</th><th>Удалить</th>
</table>
<br><button id=add>добавить таксиста</button>
</body>
</html>

