<?php

echo '<html><head><meta charset=utf-8><titel>asdsad</title><script type="text/javascript" src="//code.jquery.com/jquery-1.11.3.min.js"></script><script type="text/javascript">';
echo '$(document).ready(function(){$("#button").mouseup(function(){var info3 = $(\'#info3\').val();$.post("reg.php",{info3: info3},function(data){$(\'.abas\').remove();$.each(data, function(i, val) $(\'#sss\').append("<option class=\'abas\' value=i>"+val+"</option>"));}, "json");});});';


echo '</script></head><body><input type="text" id="info3"></input><button id="button">PUSH!</button><select id="sss" name=status2></select></body></html>';

?>






