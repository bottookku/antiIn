<!DOCTYPE html>
<html>
<head>
<meta charset=utf8>
<script type="text/javascript" src="/src/jquery-1.11.3.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$.get("/indriver/modules/local.php",{"rem_all": "1"})
$('.ss1').prop("checked",false);


$('#n1').click(function(){
	if($('#n1').prop("checked")==true)
	{
		$('#n').prop("hidden", false);
	}
	else
	{
		$('#n').prop("hidden", true);
		$('.n').prop("checked",false);
		$.get("/indriver/modules/local.php",{"rem": "n"})
	}
});

$('#nw1').click(function(){
	if($('#nw1').prop("checked")==true)
	{
		$('#nw').prop("hidden", false);
	}
	else
	{
		$('#nw').prop("hidden", true);
		$('.nw').prop("checked",false);
		$.get("/indriver/modules/local.php",{"rem": "nw"})
	}
});

$('#ne1').click(function(){
	if($('#ne1').prop("checked")==true)
	{
		$('#ne').prop("hidden", false);
	}
	else
	{
		$('#ne').prop("hidden", true);
		$('.ne').prop("checked",false);
		$.get("/indriver/modules/local.php",{"rem": "ne"})
	}
});

$('#e1').click(function(){
	if($('#e1').prop("checked")==true)
	{
		$('#e').prop("hidden", false);
	}
	else
	{
		$('#e').prop("hidden", true);
		$('.e').prop("checked",false);
		$.get("/indriver/modules/local.php",{"rem": "e"})
	}
});
$('#se1').click(function(){
	if($('#se1').prop("checked")==true)
	{
		$('#se').prop("hidden", false);
	}
	else
	{
		$('#se').prop("hidden", true);
		$('.se').prop("checked",false);
		$.get("/indriver/modules/local.php",{"rem": "se"})
	}
});

$('#s1').click(function(){
	if($('#s1').prop("checked")==true)
	{
		$('#s').prop("hidden", false);
	}
	else
	{
		$('#s').prop("hidden", true);
		$('.s').prop("checked",false);
		$.get("/indriver/modules/local.php",{"rem": "s"})
	}
});

$('#sw1').click(function(){
	if($('#sw1').prop("checked")==true)
	{
		$('#sw').prop("hidden", false);
	}
	else
	{
		$('#sw').prop("hidden", true);
		$('.sw').prop("checked",false);
		$.get("/indriver/modules/local.php",{"rem": "sw"})
	}
});
$('#w1').click(function(){
	if($('#w1').prop("checked")==true)
	{
		$('#w').prop("hidden", false);
	}
	else
	{
		$('#w').prop("hidden", true);
		$('.w').prop("checked",false);
		$.get("/indriver/modules/local.php",{"rem": "w"})
	}
});
$('#nw1').click(function(){
	if($('#nw1').prop("checked")==true)
	{
		$('#nw').prop("hidden", false);
	}
	else
	{
		$('#nw').prop("hidden", true);
		$('.nw').prop("checked",false);
		$.get("/indriver/modules/local.php",{"rem": "nw"})
	}
});
$('#o1').click(function(){
	if($('#o1').prop("checked")==true)
	{
		$('#o').prop("hidden", false);
	}
	else
	{
		$('#o').prop("hidden", true);
		$('.o').prop("checked",false);
		$.get("/indriver/modules/local.php",{"rem": "o"})
	}
});


$.post("/indriver/modules/history.php","",function(data)
{
	$.each(data, function(index, value)
	{
		$('.tabl').append("<tr><td>"+value.from+"</td><td>"+value.to+"</td><td>"+value.price+"</td><td><a href=sip:"+value.phone+">"+value.phone+"</a></td><td>" +value.username+ "</td><td>" +value.priznak+ "</td></tr>");
	}
	);

},"json");



$.get("/indriver/modules/examples/11.php","",function(data)
{
	$.each(data, function(index, value1)
	{
		if(value1[1]=="o")
		{
$('#o').append("<input class=o id='"+value1[0]+"' type='checkbox' value="+value1[0]+">"+index);
$('#'+value1[0]+'').click(function(){

if($('#'+value1[0]+'').prop("checked")==true)
{
$.get("/indriver/modules/local.php",{"loc": value1[0]});
}
else
{
$.get("/indriver/modules/local.php",{"rem": value1[0]});
}
});

		}
		if(value1[1]=="n")
		{
			$('#n').append("<input class=n id='"+value1[0]+"' type='checkbox' value="+value1[0]+">"+index);
$('#'+value1[0]+'').click(function(){
if($('#'+value1[0]+'').prop("checked")==true)
{
$.get("/indriver/modules/local.php",{"loc": value1[0]});
}
else
{
$.get("/indriver/modules/local.php",{"rem": value1[0]});
}
});

		}
		if(value1[1]=="nw")
		{
			$('#nw').append("<input class=nw id='"+value1[0]+"' type='checkbox' value="+value1[0]+">"+index);
$('#'+value1[0]+'').click(function(){
if($('#'+value1[0]+'').prop("checked")==true)
{
$.get("/indriver/modules/local.php",{"loc": value1[0]});
}
else
{
$.get("/indriver/modules/local.php",{"rem": value1[0]});
}
});

		}
		if(value1[1]=="ne")
		{
			$('#ne').append("<input class=ne id='"+value1[0]+"' type='checkbox' value="+value1[0]+">"+index);
$('#'+value1[0]+'').click(function(){
if($('#'+value1[0]+'').prop("checked")==true)
{
$.get("/indriver/modules/local.php",{"loc": value1[0]});
}
else
{
$.get("/indriver/modules/local.php",{"rem": value1[0]});
}
});

		}
		if(value1[1]=="se")
		{
			$('#se').append("<input class=se id='"+value1[0]+"' type='checkbox' value="+value1[0]+">"+index);
$('#'+value1[0]+'').click(function(){
if($('#'+value1[0]+'').prop("checked")==true)
{
$.get("/indriver/modules/local.php",{"loc": value1[0]});
}
else
{
$.get("/indriver/modules/local.php",{"rem": value1[0]});
}
});

		}
		if(value1[1]=="e")
		{
			$('#e').append("<input class=e id='"+value1[0]+"' type='checkbox' value="+value1[0]+">"+index);
$('#'+value1[0]+'').click(function(){
if($('#'+value1[0]+'').prop("checked")==true)
{
$.get("/indriver/modules/local.php",{"loc": value1[0]});
}
else
{
$.get("/indriver/modules/local.php",{"rem": value1[0]});
}
});

		}
		if(value1[1]=="s")
		{
			$('#s').append("<input class=s id='"+value1[0]+"' type='checkbox' value="+value1[0]+">"+index);
$('#'+value1[0]+'').click(function(){
if($('#'+value1[0]+'').prop("checked")==true)
{
$.get("/indriver/modules/local.php",{"loc": value1[0]});
}
else
{
$.get("/indriver/modules/local.php",{"rem": value1[0]});
}
});

		}
		if(value1[1]=="sw")
		{
			$('#sw').append("<input class=sw id='"+value1[0]+"' type='checkbox' value="+value1[0]+">"+index);
$('#'+value1[0]+'').click(function(){
if($('#'+value1[0]+'').prop("checked")==true)
{
$.get("/indriver/modules/local.php",{"loc": value1[0]});
}
else
{
$.get("/indriver/modules/local.php",{"rem": value1[0]});
}
});

		}
		if(value1[1]=="w")
		{
			$('#w').append("<input class=w id='"+value1[0]+"' type='checkbox' value="+value1[0]+">"+index);
$('#'+value1[0]+'').click(function(){
if($('#'+value1[0]+'').prop("checked")==true)
{
$.get("/indriver/modules/local.php",{"loc": value1[0]});
}
else
{
$.get("/indriver/modules/local.php",{"rem": value1[0]});
}
});

		}
	});
}
,"json");





$.post("/indriver/modules/status_get.php","",function(data)
	{
		if(data==1)
		{
			$('#start').prop("disabled", true);
			$('#stop').prop("disabled", false);
		}
		if(data==0)
		{
			$('#stop').prop("disabled", true);
			$('#start').prop("disabled", false);
		}
	});






$('#start').click(function(){
        $.post("/indriver/modules/init.php",{init: "start"},function(data){;
        if(data==1)
        {
                $('#start').prop("disabled", true);
                $('#stop').prop("disabled", false);
		$.post("/indriver/modules/init.php",{ask_start: "1"},function(data)
{
        if(data==1)
        {
			var id = setInterval(function(){
			$.get("/indriver/modules/status_get.php",{'abas': '1'},
			function(data){
				if(data.init==0)
				{
					//alert("0");
					clearInterval(id);
					//break;
				}
			},"json");



                                        $('#status').html("");
                                        $.post("/indriver/modules/read.php","",function(data)
                                        {
                                                $('#from').html(data.from);
                                                $('#to').html(data.to);
                                                $('#dist').html(data.dist);
                                                $('#price').html(data.price);
                                                $('#phone').html(data.phone);},"json");
                                        $.post("/indriver/modules/status_get_from_view.php","",function(data)
                                        {
                                                if(data==88)
                                                {
                                                        $('#status').html("Звоним");
                                                }
                                                if(data==22)
                                               {
                                                        $('#status').html("Абонент занят");
                                                }
                                                if(data==55)
                                                {
                                                        $('#status').html("Ищем клиента");
                                                }
                                                if(data==33)
                                                {
                                                        $('#status').html("Разговор окончен<br>Договорился?");
                                                }
                                                if(data==66)
                                                {
                                                        $('#status').html("Идет разговор<br>Договорился?");
                                                }
                                                if(data==44)
                                                {
                                                        $('#status').html("Звоним самому себе");
                                                }
                                        });
                },1000);
        }
});



        }
        });
});

$('#stop').click(function(){
                $.post("/indriver/modules/init.php",{init: "stop"},function(data){
                if(data==1)
                {
                        $('#stop').prop("disabled", true);
                        $('#start').prop("disabled", false);
                        //location.reload();
                }
	});
});



$.post("/indriver/modules/read.php","",function(data)
        {
                        $('#from').html(data.from);
                        $('#to').html(data.to);
                        $('#dist').html(data.dist);
                        $('#price').html(data.price);
			$('#id_zakaz').val(data.current_taxa_id);
        }
,"json");

$('#accept').click(function()
{
	$.post("/indriver/modules/init.php",{work: "1"},function(data)
	{
		if(data==1)
		{
			$.post("/indriver/modules/pozivnoi.php",{poziv: 1},function(data){
				$('.taxist').remove();
				var suka = $('#id_zakaz').val();
				$.each(data, function(index, value)
					{
						$('#select').append('<button class=taxist value='+value.taxist_id+'>'+value.username+ '</button>');
					});
				$('.taxist').click(function(){
					$.post("/indriver/modules/pozivnoi.php",{id: this.value},function(data){
					if(data == "OK")
					{
						$('#stop').prop("disabled", true);
			                        $('#start').prop("disabled", false);
						$('.taxist').remove();
					}
				});
				});
			},"json");
		}
	});
});

$('#disable').click(function(){
	$.post("/indriver/modules/init.php",{disconnect: "1"},function(data)
	{
		if(data==1)
		{
		}
	});
	$('#status').html("Звонок отменен");
});
});
</script>
</head>
<body>
<table>
<button id="start">START</button>
<button id="stop">STOP</button>&nbsp&nbsp<a href=/indriver/view/taxist.php>ТАКСИСТЫ</a>
<br>

<input class='ss1' type='checkbox' id=n1>Север
<input class='ss1' type='checkbox' id=ne1>Серверо восток
<input class='ss1' type='checkbox' id=e1>Восток
<input class='ss1' type='checkbox' id=se1>Юго восток
<input class='ss1' type='checkbox' id=s1>Юг
<input class='ss1' type='checkbox' id=sw1>Юго запад
<input class='ss1' type='checkbox' id=w1>Запад
<input class='ss1' type='checkbox' id=nw1>Серверо запад
<input class='ss1' type='checkbox' id=o1>Центр

<div id="o" hidden></div>
<div id="n" hidden></div>
<div id="ne" hidden></div>
<div id="nw" hidden></div>
<div id="se" hidden></div>
<div id="e" hidden></div>
<div id="sw" hidden></div>
<div id="w" hidden></div>
<div id="s" hidden></div>

<tr><td>Откуда: </td><td><div id=from></div></td></tr>
<tr><td>Куда: </td><td><div id=to></div></td></tr>
<tr><td>Цена: </td><td><div id=price></div></td></tr>
</table>
<div id="id_zakaz"></div>
<button id="disable">Отменить</button>
<button id="accept">заказ принят</button>
<br><div id=select></div>
<br><font id="status"></font>
<b><br>Фильтры:</b>
<form action=/indriver/modules/filtres.php method=post>
Цена больше чем:<br><input id=price name='price' value='<?php $s=1; include __DIR__."/../modules/filtres.php"?>'>
<br>Растояние меньше чем:<br><input id=dist name='dist' value='<?php $s=0; include __DIR__."/../modules/filtres.php"?>'>
 метров.<br><input type=submit value="Ввести фильтры">
<br><br><br><b>Последние 10 заказов</b>
<table border="1" class=tabl>
<th>Откудa</th><th>Куда</th><th>Цена</th><th>Телефон</th><th>Позывной</th><th>Признак</th>
</table>


<a href=history.php>Вся история</a>
</form>
</body>
</html>
