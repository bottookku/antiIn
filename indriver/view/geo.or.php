<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>jQuery UI Autocomplete - Remote JSONP datasource</title>
//	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
//	<link rel="stylesheet" href="/resources/demos/style.css">
	<style>
	.ui-autocomplete-loading {
		background: white url("images/ui-anim_basic_16x16.gif") right center no-repeat;
	}
	#city { width: 25em; }
	</style>
	<script>
	$(function() {
		function log( message ) {
			$( "<div>" ).text( message ).prependTo( "#log" );
			$( "#log" ).scrollTop( 0 );
		}

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
			minLength: 3,
		});
	});



$(function() {
function log( message ) {
                        $( "<div>" ).text( message ).prependTo( "#log" );
                       $( "#log" ).scrollTop( 0 );
               }

                $( "#city2" ).autocomplete({
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
                        minLength: 3,
                });
        });


	</script>
</head>
<body>
<div class="ui-widget2">
<input id="city" size="50">
<br>
<br><br><br><br><br>
<div class="ui-widget1">
<input id="city2" size="36">

</div>
</body>
</html>

