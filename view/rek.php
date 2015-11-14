<html>
<head>
<meta charset=utf8>
<script src=src/jquery-2.1.4.min.js></script>
<script type="text/javascript" src="http://doska.ykt.ru/catsjson.jsjsp?outVar=CATS_JSON&region=yakutsk"
        charset="utf-8"></script>
<script>
$(document).ready(function(){
	var get_time = function(){
		var b = "";
		var a = "";
		var arr = [];
		$("input[class='dd']:checked").each(function (k,v) {
			a = this.value;
			b = $(this).attr('id');
			arr[k] = [b];
			arr[k][1]=a;
		});
		var ss = JSON.stringify(arr);
		$('#time').val(ss);
	}

	var get_day = function (){
		var a = [];
		$("input[class='day']:checked").each(function (k,v)
		{
			a.push(this.value);
		});
	var ss = JSON.stringify(a);
	$('#day').val(ss);
	}

	$(CATS_JSON).each(function(k,v)
	{
		if(v.needPhoneVerify==1)
		{
			$("#cats").append("<option disabled class=cci suka="+v.id+" value="+k+">"+v.name+"</option>")
		}
		else
		{
			$("#cats").append("<option class=cci suka="+v.id+" value="+k+">"+v.name+"</option>")
		}
	});

	$("#cats").click(function(){
		$(".ccu").remove();
		$("#pre_del_rek").prop("checked",false);
		if(CATS_JSON[this.value].hasLimitation==1)
		{
			$("#pre_del_rek").prop("checked",true);
		}
		$(CATS_JSON[this.value].subcats).each(function(k,v)
		{
			if(v.needPhoneVerify==1)
			{
				$("#subcats").append("<option disabled class=ccu suka="+v.id+" value="+k+">"+v.name+"</option>")
			}
			else
			{
				$("#subcats").append("<option class=ccu suka="+v.id+" value="+k+">"+v.name+"</option>")
			}
		});
	});

	$("#subcats").click(function(){
		$(".ccj").remove();
		var sst = $("[class='cci']:selected").val();
		var sse = $("[class='ccu']:selected").val();
		if(CATS_JSON[sst].subcats[sse].hasLimitation==1)
		{
			///
		}
		$(CATS_JSON[sst].subcats[sse].rubrics).each(function(k,v)
		{
			if(v.needPhoneVerify==1)
			{
				$("#rubrics").append("<option disabled class=ccj suka="+v.id+" value="+k+">"+v.name+"</option>");
			}
			else
			{
				$("#rubrics").append("<option class=ccj suka="+v.id+" value="+k+">"+v.name+"</option>")
			}
		});
	});




	$.ajax({
		url: "/modules/api.php",
		data: {"gg": "<?php echo $_GET['id'] ?>"},
		success: function(data)
		{
			var ss1 = jQuery.parseJSON(data);
			for (var i = 7; i < 23; i++)
			{
				$('#tab').append("<tr class="+i+"><td>"+i+"</td>");
				for (var r = 0; r < 4; r++)
				{
					var rr = parseInt(ss1.rand);
					$("."+i).append("<td><input class=dd id='"+i+"' type=checkbox value="+((15*r)+rr)+">"+((15*r)+rr)+"</td>");
				}
				$('#tab').append("</tr>");
			}
			$('.dd').click(function(){
			$('.rem').remove();
			var countChecked = function() {
			var n = $("input[class='dd']:checked").length;
			var p = $("#pack").val();
			if(n==p)
			{
				$(".dd").prop("disable",true)
			}
			if(n>p)
			{
				$('#message').append("<font class=rem color=red>Вы превысили лимит показов в день на вашем тарифе "+p+" показов</font>")
			}
			else
			{
				$('#message').append("<font class=rem color=green>Вам осталось выбрать еще "+(p-n)+"</font>");
			}
			};
			countChecked();
			});
		},
		datatype: "json"
	});


	$.ajax({
		url: "/modules/api.php",
		data: {"time": "<?php echo $_GET['id'] ?>"},
		success: function(res)
		{
			var asd = $.parseJSON(res);
			$(asd).each(function(k,v){
				$("."+v.hour+" [value='"+v.min+"']").prop("checked", true);
			});
		},
		datatype: "json",
	});

	$.ajax({
		url: "/modules/api.php",
		data: {"d_day": "<?php echo $_GET['id'] ?>"},
		success: function(res)
		{
			var asd = $.parseJSON(res);
			$(asd).each(function(k,v){
				$(".day[value='"+v.day+"']").prop("checked",true);
			});
		},
		datatype: "json"
	});
	$.ajax({
		url: "/modules/api.php",
		data: {"get": "<?php echo $_GET['id'] ?>"},
		success: function(res)
		{
			var obj = jQuery.parseJSON(res);
			$('#pack').val(obj[0].pcs)
			$('#name_rek').val(obj[0].name_rekl)
			$('#text_rek').val(obj[0].text);
			$('#body_rek').val(obj[0].body);
			$('#tel_rek').val(obj[0].tel);
			$('#email_rek').val(obj[0].email);
			$('#price_rek').val(obj[0].price);
			if(obj[0].allow_comment==1)
			{
				$('#allow_comment_rek').prop('checked', true)
				$('#allow_comment_rek').val(1)
			}
			if(obj[0].allow_comment==0)
			{
				$('#allow_comment_rek').prop('checked', false)
				$('#allow_comment_rek').val(0)
			}
			if(obj[0].email_notif_comment==1)
			{
				$('#send_mail_rek').prop('checked',true)
				$('#send_mail_rek').val(1)
			}

			if(obj[0].email_notif_comment==0)
			{
				$('#send_mail_rek').prop('checked',false)
				$('#send_mail_rek').val(0)
			}

			if(obj[0].pre_delete==1)
			{
				$('#pre_del_rek').prop('checked',true)
				$('#pre_del_rek').val(1)
			}
			if(obj[0].pre_delete==0)
			{
				$('#pre_del_rek').prop('checked',false)
				$('#pre_del_rek').val(0)
			}
			if(obj[0].random_tel==1)
			{
				$('#rand_rek').prop('checked',true)
				$('#rand_rek').val(1)
				$('#tel_rek').attr("maxlength", 13)
			}
			if(obj[0].random_tel==0)
			{
				$('#rand_rek').prop('checked',false)
				$('#rand_rek').val(0)
				$('#tel_rek').attr("maxlength", 16)
			}

			$('#login_rek').val(obj[0].login);
			$('#pass_rek').val(obj[0].pass);

			$(CATS_JSON).each(function(k,v)
			{
				if(v.id==obj[0].cid)
				{
					$("[suka="+v.id+"]").prop("selected", true);
				}
			});
			$(CATS_JSON[$("[class='cci']:selected").val()].subcats).each(function(k,v)
			{
				if(v.needPhoneVerify==1)
				{
					$("#subcats").append("<option disabled class=ccu suka="+v.id+" value="+k+">"+v.name+"</option>")
				}
				else
				{
					$("#subcats").append("<option class=ccu suka="+v.id+" value="+k+">"+v.name+"</option>")
				}
				if(v.id==obj[0].sid)
				{
					$("[suka="+v.id+"]").prop("selected", true);
				}
			});

			var sst = $("[class='cci']:selected").val();
			var sse = $("[class='ccu']:selected").val();
			$(CATS_JSON[sst].subcats[sse].rubrics).each(function(k,v)
			{
				if(v.needPhoneVerify==1)
				{
					$("#rubrics").append("<option disabled class=ccj suka="+v.id+" value="+k+">"+v.name+"</option>")

				}
				else
				{
					$("#rubrics").append("<option class=ccj suka="+v.id+" value="+k+">"+v.name+"</option>")
				}

				if(v.id==obj[0].rid)
				{
					$("[suka="+v.id+"]").prop("selected", true);
				}
			});
		},
		datatype: "json"
	});


	$('#rand_rek').click(function(){
		$('.rem').remove()
		if(rand_rek.checked)
		{
			if($('#tel_rek').val()>=9999999999999)
			{
				$('#message').append("<font class=rem color=red>Слишком длинный номер телефона</font>")
			}
		        $('#tel_rek').attr("maxlength", 13)
		}
		else
		{
	        	$('#tel_rek').attr("maxlength", 16)
		}
	});


	$('#bt').click(function(){
		$('.rem').remove();
		if($("[class='cci']:selected").attr("suka")<0||$("[class='ccu']:selected").attr("suka")<0||$("[class='ccj']:selected").attr("suka")<0)
		{
			$('#message').append("<font class=rem color=red>Выберите категорию</font>")
			return;
		}
		$("[required]").each(function()
		{
			if(this.value=="")
			{
				$('#message').append("<font class=rem color=red>Заполните обязательные поля</font>")
				return outer;
			}
		});
		if($("input[class='day']:checked").length==0)
		{
			$('#message').append("<font class=rem color=red>Выберите хотябы один день недели</font>")
			return;
		}
		if($("input[class='dd']:checked").length==0)
		{
			$('#message').append("<font class=rem color=red>Выберите хотябы одно время показа</font>")
			return;
		}
		var p = $("#pack").val();
		if($("input[class='dd']:checked").length>p)
		{
			$('#message').append("<font class=rem color=red>Превышен лимит показов в день на вашем тарифном плане их всего "+p+"</font>")
			return;
		}

		get_time();
		get_day();

		if(send_mail_rek.checked)
		{
			$('#send_mail_rek').val(1)
		}
		else
		{
			$('#send_mail_rek').val(0)
		}
		if(rand_rek.checked)
		{
			$('#rand_rek').val(1)
		}
		else
		{
			$('#rand_rek').val(0)
		}
		if(pre_del_rek.checked)
		{
			$('#pre_del_rek').val(1)
		}
		else
		{
			$('#pre_del_rek').val(0)
		}
		if(allow_comment_rek.checked)
		{
			$('#allow_comment_rek').val(1)
		}
		else
		{
			$('#allow_comment_rek').val(0)
		}
		if(rand_rek.checked)
		{
			if($('#tel_rek').val()>=9999999999999)
		        {
				$('#message').append("<font class=rem color=red>Слишком длинный номер телефона</font>")
				return;
			}
		}
		$.ajax
		({
		        url: "/modules/api.php",
		        data:
		        {
				"cid": $("[class='cci']:selected").attr("suka"),
				"sid": $("[class='ccu']:selected").attr("suka"),
				"rid": $("[class='ccj']:selected").attr("suka"),
		                "name_rek": $('#name_rek').val(),
		                "text_rek": $('#text_rek').val(),
		                "body_rek": $('#body_rek').val(),
				"tel_rek":$('#tel_rek').val(),
				"email_rek": $('#email_rek').val(),
				"price_rek": $('#price_rek').val(),
				"allow_comment_rek": $('#allow_comment_rek').val(),
				"send_mail_rek": $('#send_mail_rek').val(),
				"pre_del_rek": $('#pre_del_rek').val(),
				"rand_rek": $('#rand_rek').val(),
				"login_rek": $('#login_rek').val(),
				"pass_rek": $('#pass_rek').val(),
				"id":$('#id').val(),
				"dd":$('#ss').val(),
				"time":$('#time').val(),
				"day":$('#day').val(),
		        },
		        success: function(res)
		        {
				if(res==0)
				{
					$('#message').append("<font class=rem color=red>Не все поля заполнены</font>")
				}
				else
				{
					$('#message').append("<font class=rem color=green>Изменения приняты</font>")
				}
			},
			datatype: "json",
		});
	});


	document.forms.upload.onsubmit = function() {
		var input = this.elements.myfile;
		$('.logs').remove();
		$(input.files).each(function(k,v){
			$('.logi').append("<div class=logs id=log"+k+">")
			var file = v;
			if (file) {
				upload(file, k);
			}
		});
		return false;
	}


	function upload(file, k) {
		var xhr = new XMLHttpRequest();
		// обработчик для закачки
		xhr.upload.onprogress = function(event) {
			log(parseInt(event.loaded/event.total*100)+"%", k);
		}
		// обработчики успеха и ошибки
		// если status == 200, то это успех, иначе ошибка
		xhr.onload = xhr.onerror = function() {
			if (this.status == 200) {
				log("100%", k);
				$('#log'+k).append("<img src=/upload/"+$('#id').val()+"/"+k+".jpg?"+Math.random()+" width=100 height=80>");
				$('#log'+k).append("<button id=juk"+k+" id=pol value="+k+">Удалить</button><br>--------------------------------------------------------------------------------------------")
				$('#juk'+k).click(function(){
					$.ajax({
						url: "modules/api.php?remove="+$('#id').val()+"&id_img="+this.value,
						success: function(res){
						},
						datatype: "json"
					});
				});

			}
			else
			{
				log("error " + this.status, k);
			}
		};
		var formData = new FormData(document.forms.person);
		formData.append(k, file);
		xhr.open("POST", "modules/api.php?upload=<?php echo $_GET['id'] ?>", true);
		xhr.send(formData);
	}

	function log(html,k) {
		document.getElementById('log'+k).innerHTML = html;
	}

});
</script>
</head>
<body>
<a href=/>Назад</a>
<br>--------------------------------параметры требуемые doska.YKT.ru------------------------------
<br>
<select id=cats name=cid class=sss></select>
<select id=subcats name=sid></select>
<select id=rubrics name=rid></select>
<br>К сожалению если желаемая вами категория не доступна это значит что нужно подтверждение по СМС. Впринципе можно сделать обход этой проблемы за отдельную плату, но минус в том что номер могут заблокировать, и каждый раз нужна будет отдельная симка что делает услугу не дешевой.
<br><textarea required rows="10" cols="45" maxlength="300" id=text_rek></textarea>
текст до 300 симоволов
<br><textarea rows="10" cols="45" maxlength="2000" id=body_rek></textarea>
тело до 2000 символов
<br><input id=tel_rek>
телефон максимум 16 знаков
<br><input type=email maxlength="42" id=email_rek>
e-mail
<br><input maxlength=12 id=price_rek>
цена только цифры
<br><input type=checkbox id=allow_comment_rek>
разрешить комменты
<br><input type=checkbox id=send_mail_rek>
разрешить отправку комментариев на e-mail
<br>
<br>---------------------------------ВНУТРИСИСТЕМНЫЕ ПАРАМЕТРЫ------------------------------------
<br><input required maxlength=42 id=name_rek>
название объявления
<br><input type=checkbox id=pre_del_rek>
Сначала удалить потом добавить. Применять в том случае если в данной категории требуют ограниченное количество объявлений за единицу времени. Минус в том что невозможно можно будет оставить последнее объявление если будут какие либо проблемы с добавлением нового.
<br><input type=checkbox id=rand_rek>
Добавить в конце телефона 3 случайных числа. добавлять в тех категориях где ограничивающая идентификация идет по номеру телефона, (Желательно при этом номер <br>должен быть похож на 0000000 максимально 16 знаков минус эти три, чтобы человек догадался позвонить не по этому псевдо номеру а по номеру находящемуся в тексте объявления)
<br><input required maxlength="42" id=login_rek>
Логин (Существующий аккаунт в системе ykt.ru)
<br><input required maxlength="42" id=pass_rek>
Пароль
<br>выбрите время показа объявлений...
<br>
<input class=day type=checkbox value=1>пн
<input class=day type=checkbox value=2>вт
<input class=day type=checkbox value=3>ср
<input class=day type=checkbox value=4>чт
<input class=day type=checkbox value=5>пт
<input class=day type=checkbox value=6>сб
<input class=day type=checkbox value=7>вс

<table border=1 id=tab>
<th>Час</th><th>0-14 мин</th><th>15-29 мин</th><th>30-44 мин</th><th>45-59 мин</th>
<tbody>
</tbody>
</table>
<div id=message></div>
<br><input type=submit id=bt value="Внести изменения">
<input id="time" hidden>
<input id="day" hidden>
<input id="pack" hidden>
<br>------------------------------загрузить фото--------------------------------------

<form name="upload" method="POST">
<input type="file" name="myfile" multiple accept="image/*,image/jpeg">
<input type="submit" value="Загрузить">
</form>
<div class=logi></div>
</body>
</html>
<?php
echo "<input hidden id=id value='".$_GET['id']."'>";
?>
