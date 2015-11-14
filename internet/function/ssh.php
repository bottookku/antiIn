<?php
//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
function ssh_exec($ip,$user,$pass,$exec)
{
	//$user = "asd";
	//$exec = "ls";
	$conn = ssh2_connect($ip, 22);
	if (!ssh2_auth_password($conn,$user,$pass)==true)
	{
		return false;
	}
	$stream = ssh2_exec($conn, $exec);
/*
	$errorStream = ssh2_fetch_stream($stream, SSH2_STREAM_STDERR);
	if(stream_set_blocking($errorStream, true))
	{
		echo "11";
	}
*/
	stream_set_blocking($stream, true);
	$ret = stream_get_contents($stream);
	//Закрыть
	fclose($stream);
	ssh2_exec($conn,'exit');
	unset($conn);
	return $ret;
}
function ssh_exec_without_ret($ip,$user,$pass,$exec)
{
        $conn = ssh2_connect($ip, 22);
        if(!ssh2_auth_password($conn,$user,$pass)==true)
        {
                return false;
        }
        $stream = ssh2_exec($conn, $exec);
        // $errorStream = ssh2_fetch_stream($stream, SSH2_STREAM_STDERR);
        // stream_set_blocking($errorStream, true);
        //заккрть соединение с роутером
        fclose($stream);
        ssh2_exec($conn,'exit');
        unset($conn);
        return true;
}

//ssh_exec('192.168.93.254','root','356386','ls');
?>
