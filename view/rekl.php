<html>
<head>
<meta charset=utf8>
<script src=src/jquery-2.1.4.min.js></script>
<script>
$(document).ready(function(){
$.ajax({
        url: "/modules/api.php",
        data:
        {
		"rekl": "1",
        },
        success: function(res)
        {
		$.each(JSON.parse(res), function(i,v)
		{
			i = i + 1;
			d = v.exp / 86400 | 0;
			h = (v.exp - d* 86400)/3600|0
			t = v.exp / 3600 | 0
			m = (v.exp-(t * 3600))/60|0
			$('#12').append("<tr>");
			$('#12').append("<td>"+i+"</td>")
			$('#12').append("<td><a href=?rekla=1&id="+v.idrekl+">"+v.name_rekl+"</a></td>");
			$('#12').append("<td><a href=?pay=1&id="+v.idrekl+">оплатить</td>");
			if(v.exp>=0)
			{
				$('#12').append("<td>" +d+ " дней "+h+" часов "+m+" минут</td>")
			}
			else
			{
				$('#12').append("<td>Время вышло</td>");
			}
			$('#12').append(v.name);
			$('#12').append("</tr>");

		});
	},
	datatype: "json",
});

	$('#bt').click(function()
	{
		$.ajax
		({
	        	url: "/modules/api.php",
        		data:
	        	{
        	       		"add": "1",
	        	},
        		success: function(res)
	        	{
				location.reload();
        		},
	        	datatype: "json",
		});
	});

});
</script>
</head>
<body>
<table>
<tbody id=12>
<th>№</th><th>Название</th><th>Оплата</th><th>Осталось времени</th><th>Пакет</th>
<tbody>
</table>
<button id=bt>Добавить</button>
</body>
</html>
