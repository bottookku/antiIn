<?php
$ss1 = 79841016941;
$ss = "asterisk -rx 'sip show channels' | grep -i '^.*".$ss1.".*INVITE.*$' | grep -o '[a-z0-9][a-z0-9][a-z0-9][a-z0-9][a-z0-9][a-z0-9][a-z0-9][a-z0-9][a-z0-9][a-z0-9][a-z0-9][a-z0-9][a-z0-9][a-z0-9][a-z0-9]'";
$ss = exec($ss);
$ss = "asterisk -rx 'sip show channel ".$ss."' | grep Owner";
$ss = exec($ss);
echo substr($ss,26,24);
?>
