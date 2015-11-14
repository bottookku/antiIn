<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>suka</title>
	<link rel="stylesheet" href="../src/jquery-ui.css">
	<script src="../src/jquery-1.10.2.js"></script>
	<script src="../src/jquery-ui.js"></script>
	<style>
	#city { width: 25em; }
	</style>
	<script>
	$(function() {
		$( "#city" ).autocomplete({
			source: function( request, response ) {
				$.ajax({
					url: "http://192.168.0.80/indriver/view/google.php",
					dataType: "json",
					data: {
						add: request.term
					},
					success: function( data ) {
						response( data );
					}
				});

			},
			focus: function(event, ui){
				event.preventDefault();
				$("#city").val(ui.item.label);
			},
			select: function(event, ui){
				event.preventDefault();
				$("#city").val(ui.item.label);
				$.ajax({
					url: "http://192.168.0.80/indriver/view/google.php",
					dataType: "json",
					data:{
						place: ui.item.value
					},
					success: function(data){
						$('#suka').val(data.add);
					}
				});
			},
			minLength: 3,
		});


	$( "#suka" ).autocomplete({
		source: function( request, response ) {
			$.ajax({
				url: "https://geocode-maps.yandex.ru/1.x/?ll=129.720000,62.030000&spn=0.14,0.30&rspn=1&format=json",
				dataType: "json",
				data: {
					geocode: request.term
				},
				success: function(data){
					$.each(data.response.GeoObjectCollection.featureMember, function(index, value){
						//response(value.GeoObject.name);
						response("{'aaaa1','aaaaa2'}");
					});
				}
			})
		},
		minLength: 3,
		});
	});

</script>
</head>
<body>
<div class="ui-widget2">
<input id="city" size="50">
<input id="suka">
<br>
</div>
</body>
</html>

