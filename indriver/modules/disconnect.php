<?php
exec("sudo asterisk -rx \"channel request hangup $(sudo asterisk -rx 'core show channels concise' | grep -o 'SIP/suka-\w*')\"");
?>
