<!DOCTYPE html>
<html>
<head>
<meta charset=utf8>
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){


$('#disable').click(function(){


$.post("/indriver/modules/pozivnoi.php","",function(data){
$.each(data, function(index, value)
{
$('#select').append('<button class=taxist value='+value.taxist_id+':'++'>'+value.username+ '</button>');
});
$('.taxist').click(function(){
$.post("/indriver/modules/pozivnoi.php",{id: this.value},function(data){
alert(data);});
});
},"json");
});



});





</script>
</head>
<body>
<table>
<button id="start">START</button><button id="stop">STOP</button>
<tr><td>Откуда: </td><td><div id=from></div></td></tr>
<tr><td>Куда: </td><td><div id=to></div></td></tr>
<tr><td>Цена: </td><td><div id=price></div></td></tr>
<tr><td>Растояние: </td><td><div id=dist></div></td></tr>
<tr><td>Телефон: </td><td><a id=phone href="tel:"></a></div></td></tr>
</table>
</form>
<br><button id="disable">Отменить</button>
<br>
<br><button id="accept">заказ принят</button>

<div id=select></div>






<br><font id="status"></font>
<b><br>Фильтры:</b>
<form action=/indriver/modules/filtres.php method=post>
Цена больше чем:<br><input id=price name='price' value='<?php $s=1; include __DIR__."/../modules/filtres.php"?>'>
<br>Растояние меньше чем:<br><input id=dist name='dist' value='<?php $s=0; include __DIR__."/../modules/filtres.php"?>'>
 метров.<br><input type=submit value="Ввести фильтры">

<br><br><br><b>Последние 10 заказов</b>
<table border="1" class=tabl>
<th>Откудa</th><th>Куда</th><th>Цена</th><th>Телефон</th><th>Позывной</th>
</table>
</form>
</body>
</html>
