<?php
// Форкаем процесс
$pid = pcntl_fork();
if ($pid == -1) {
        // Ошибка
        die('could not fork'.PHP_EOL);
} else if ($pid) {
        // Родительский процесс, убиваем
        die('die parent process'.PHP_EOL);
} else {
        // Новый процесс, запускаем главный цикл
require_once "/var/www/indriver/function/db_api.php";
while(true)
{
	$req = "SELECT taxist_id FROM geoloc WHERE `time` >= (now() - interval 5 minute) group by taxist_id";
	$geo = db_reqss($req);
	$req = "SELECT `taxist_id` FROM `taxist` WHERE `online`='1';";
	$online = db_reqss($req);
	foreach($online as $gg)
	{
		$i=0;
		foreach($geo as $on)
		{
			if($on['taxist_id']==$gg['taxist_id'])
			{
				$i=1;
			}
		}

		if($i==0)
		{
			//echo $gg['taxist_id']." turn offline\n";
			$req = "UPDATE `taxist` SET `online`=0 WHERE `taxist_id`=$gg[taxist_id];";
			db_req_without_resp($req);
                        $req = "UPDATE `taxist` SET `work`=0 WHERE `taxist_id`=$gg[taxist_id];";
                        db_req_without_resp($req);
		}
	}
//break;
sleep(5);
}

}
// Отцепляемся от терминала
posix_setsid()
?>
