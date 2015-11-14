<?php
		$ip = "10.1.0.2";
                $mm = file_get_contents("/etc/dhcp/dhcpd.conf");
                $datt = "/host $ip(.*)\n/";
                preg_replace($datt,"",$mm);
                file_put_contents("/etc/dhcp/dhcpd.conf",preg_replace($datt,"",$mm));








?>

