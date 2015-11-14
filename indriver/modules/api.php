<?php
/////////////////////////////////////////////////////
////dial_status					/////
////2 - вызов					/////
////3 - разговор				/////
////4 - занят					/////
////5 - ответ					/////
////6 - пустой					/////
////Work					/////
////1 - ищу работу				/////
////2 - в работе				/////
////3 - на месте (в индрайвере не используется)	/////
////4 - поиск в индрайвере			/////
////5 - кандидат найден				/////
////6 - кандидат не подходит			/////
/////////////////////////////////////////////////////
require_once "/var/www/indriver/function/db_api.php";
$input = $_GET;
//////////////////////////
////запросы с андроида////
//////////////////////////
if($input['action']=="put")
{
	////////ввести фильтры
	if($input['id']=="filt")
	{
		$req = "UPDATE `taxist` SET `filt_dist`='".$input['dist']."', `filt_price`='".$input['price']."' WHERE `username`='".$input['user']."';";
		$ret = db_req_reg($req);
		echo $req;
		//file_put_contents("sss",json_encode($_GET));
	}
	////регистрация...........
	if($input['id']=="reg")
	{
		if($input['name']==""||$input['desk']==""||$input['phone']==""||$input['number']==""||$input['pass']=="")
		{
			$ans = array("ans"=>"error","msg"=>"не должо быть пустым");
			echo json_encode($ans);
			return;
		}
		$req = "INSERT INTO taxist (`username`,`priznak`,`phone_taxist`,`number_taxist`,`pass_taxist`) VALUES ('".$input['name']."','".$input['desk']."','".$input['phone']."','".$input['number']."','".$input['pass']."');";
		$ret = db_req_reg($req);
		///если не пусто значит есть ошибка
		if(!$ret == "")
		{
			$ans = array("ans"=>"error","msg"=>$ret);
			echo json_encode($ans);
			///отправить текс ошибки
		}
		else
		{
			$ans = array("ans"=>"ok");
			echo json_encode($ans);
		}

	}
	////////логин пользователя
	if($input['id']=="login")
	{

		$req = "SELECT * FROM `taxist` WHERE `username`='$input[name]';";
		$ret = db_req($req);
		//если пароль верна
		if($ret[pass_taxist] == $input['pass'])
		{
			///Online
			$req = "UPDATE `taxist` SET `online`=1 WHERE `username`=$input[name];";
			$ret = db_req_reg($req);
			$ans = array("ans"=>"ok","msg"=>$ret);
			setcookie("user", $input['name'],time()+9000000);
			setcookie("pass", $input['pass'],time()+9000000);
                        echo json_encode($ans);
		}
			else
		///иначе
		{
			$ans = array("ans"=>"error","msg"=>$ret);
                        echo json_encode($ans);
		}
	}
	////проверка куков....
	if($input['id']=="cookie")
	{
		$req = "SELECT * FROM `taxist` WHERE `username`='$input[user]';";
                $ret = db_req($req);
                if($ret[pass_taxist] == $input['pass']&&!$input['user']=="")
                {
			$req = "UPDATE `taxist` SET `online`=1 WHERE `username`=$input[user];";
			$ret = db_req_reg($req);
			$ans = array("ans"=>"ok","msg"=>$ret);
			echo json_encode($ans);
                }
                else
                {
			$ans = array("ans"=>"error");
			echo json_encode($ans);
                }

	}
	////////////
	///если нажато кнопка старт
	///////////
	if($input['id']=="start")
	{
	        $req = "SELECT * FROM `taxist` WHERE `username`='$input[user]';";
                $ret = db_req($req);
		/////////
		///зачемто проверяет пароль
		/////////
                if($ret['pass_taxist'] == $input['pass']&&!$input['user']=="")
                {
			if($input['work_status']==1)
			{
				$req = "UPDATE `taxist` SET `work`='1' WHERE `username`='$input[user]';";
				db_req_without_resp($req);
			}
			if($input['work_status']==0)
			{
				$req = "UPDATE `taxist` SET `work`='0' WHERE `username`='$input[user]';";
                                db_req_without_resp($req);
			}
                        $ans = array("ans"=>"ok",$input['user']=>$input['pass'],"work"=>$input['work_status']);
                        echo json_encode($ans);
                }
                else
		/////////////
		////иначе ошибка
		/////////////
                {
                        $ans = array("ans"=>"error");
                        echo json_encode($ans);
                }


	}
	///////////////////
	/////введение геоданных
	//////////////////
	if($input['id']=="geo")
	{

		if($input[long]>=127&&$input[long]<=130&&$input[lat]<=63&&$input[lat]>=60)
		{
			$ans = array("ans"=>"ok");
			echo json_encode($ans);
			$req = "SELECT `taxist_id` FROM `taxist` WHERE `username`='$input[user]';";
			$tax_id = db_req($req);
			$req = "INSERT INTO `geoloc` (`taxist_id`, `long`, `lat`, `prov`) VALUES ('$tax_id[taxist_id]', '$input[long]', '$input[lat]', '$input[prov]');";
			db_req_without_resp($req);
		}
		else
		{
			$ans = array("ans"=>"error");
			echo json_encode($ans);
		}

	}
	//////////////////////
	/////////принялся за работу. Indriver.
	/////////////////////
	if($input['id']=="accept")
	{
		/////////////Записать ЗАКАЗУ ПРИНЯТО ...
		$sql = "UPDATE `current_taxa_android` SET `work`='1' WHERE taxist_id=(SELECT `taxist_id` FROM `taxist` WHERE username='".$input['user']."') order by `id_taxa` Desc limit 1";
		db_req_without_resp($sql);
		///ПОменять состояние таксиста на работает
		$sql = "UPDATE taxist SET work='2' WHERE username='".$input['user']."'";
		db_req($sql);
		$sql = "SELECT `dial_status` FROM `taxist` WHERE username='".$input['user']."'";
		$ssq = db_req($sql);
		/////////////////
		//////если разговор окончен
		////////////////
		if($ssq['dial_status'] == "5")
		{
			$sql27 ="SELECT sip_channel_taxist FROM sip_channel_taxist WHERE `taxist_id`=(SELECT `taxist_id` FROM `taxist` WHERE username='".$input['user']."')";
			$sdd43 = db_req($sql27);
			////////// завершить разговор с таксистом
			$ex = "sudo asterisk -rx 'channel request hangup ".$sdd43['sip_channel_taxist']."'";
			exec($ex);
		}
		///////////////
		/////если разговор идет
		///////////////
		if($ssq['dial_status'] == "3")
		{
			$sql27 ="SELECT sip_channel_taxist FROM sip_channel_taxist WHERE `taxist_id`=(SELECT `taxist_id` FROM `taxist` WHERE username='".$input['user']."')";
			$sdd43 = db_req($sql27);
			//////////завершить разговор с таксистом
			$ex = "sudo asterisk -rx 'channel request hangup ".$sdd43['sip_channel_taxist']."'";
			exec($ex);
			//////////завершить разоговор с клиентом
			$i27 ="SELECT channel_client FROM sip_channel_client WHERE `taxist_id`=(SELECT `taxist_id` FROM `taxist` WHERE username='".$input['user']."')";
			$i28 = db_req($i27);
			$ex1 = "sudo asterisk -rx 'channel request hangup ".$i28['channel_client']."'";
			exec($ex1);
		}
	}
	////////////////
	/////клиент не подходит
	/////////////////
	if($input['id']=="cancel")
	{
		$sql = "UPDATE taxist SET work='6' WHERE username='".$input[user]."'";
		db_req($sql);
		$sql = "SELECT `dial_status` FROM `taxist` WHERE username='".$input['user']."'";
		$ssq = db_req($sql);
		if($ssq['dial_status'] == "3"||$ssq['dial_status'] == "2")
		{
			///////////взять имя канала клиента
			$i27 ="SELECT channel_client FROM sip_channel_client WHERE `taxist_id`=(SELECT `taxist_id` FROM `taxist` WHERE username='".$input['user']."')";
			$i28 = db_req($i27);
			//////////завершить разговор с клиентом
			$ex1 = "sudo asterisk -rx 'channel request hangup ".$i28['channel_client']."'";
			exec($ex1);
		}
	}
}
///////////////////////////
//АРГУМЕНТЫ С АСТЕРИСКА.///
///////////////////////////
if($argv[0]=="/var/www/indriver/modules/api.php")
{
	if($argv[1]=="input")
	{
		//запросить номера таксистов.
		$sql = "SELECT `taxist_id`,`phone_taxist` FROM `taxist`";
		$asd = db_reqss($sql);
		foreach($asd as $dsa)
		{
			if(substr($argv[2],1,10)==$dsa['phone_taxist'])
			{
				///если номер есть обновить статус соеденения таксиста с сервером на 1
				$sql = "UPDATE `taxist` SET `connected`='1' WHERE `taxist_id`=".$dsa['taxist_id'];
				db_req_without_resp($sql);
				///записать имя канал таксиста....
				$sql = "REPLACE INTO `sip_channel_taxist` (`sip_channel_taxist`, `taxist_id`) VALUES ('".$argv[3]."', '".$dsa['taxist_id']."');";
				db_req_without_resp($sql);
				echo "ok";
				return;
			}
		}
		///если среди таксистов нет то ПРОВЕРИТ СРЕДИ КЛИЕНТОВ за последние 2 часа,
		//НЕ среди всех просмотренных клиентов А ОБСЛУЖЕННЫХ
		$x1 = "SELECT `phone`,`taxist_id` FROM indriver.current_taxa_android WHERE `work`='1' AND `data` >= (now() - interval 180 minute)";
		$a1 = db_reqss($x1);
		foreach($a1 as $mko)
		{
			if($argv[2]==$mko['phone'])
			{
				//если этого человека обслужили то возвратить номер таксиста
				//который его обслуживал....
				$sql = "SELECT `phone_taxist` FROM `taxist` WHERE `taxist_id`='".$mko['taxist_id']."'";
				$sssq = db_req($sql);
				echo "7".$sssq['phone_taxist'];//."@android-out";
				return;
			}
		}
	}
	if($argv[1]=="hangup")
	{
		//если таксис положил трубку... поменять статус коннектед.
		$numb = substr($argv[2],1,10);
		$sql = "UPDATE `taxist` SET `connected`='0' WHERE `phone_taxist`=".$numb;
		db_req_without_resp($sql);
	}
////запрос на готовность работать индайвером из астреиска.
	if($argv[1]=="ready")
	{
		$numb = substr($argv[2],1,10);
		$sql = "SELECT * FROM indriver.taxist WHERE `phone_taxist`=".$numb;
		$ss = db_req($sql);
		///поменять диал статус на пустой....
		///если только позвонил...
		$sql23 = "UPDATE `indriver`.`taxist` SET `dial_status`='6' WHERE `taxist_id`='".$ss['taxist_id']."';";
		db_req_without_resp($sql23);
		////если состоние ищет работу, кандидат найден, поиск,ничего не наждо...
		if($ss['work']==1||$ss['work']==6||$ss['work']==5||$ss['work']==4||$ss['work']==0)
		{
			////////////////////////////УБРАТЬ ПОСЛЕ ТЕСТОВ/////////////////////////////
			echo "1";
			return;	//			УБРАТЬ ПОСЛЕ ТЕСТОВ
			///////////////////////////////////////////////////////////////////////////
/*
			//АКТУАЛЬНОСТЬ ГЕО данных 1 минута...
			$req = "SELECT * FROM geoloc WHERE `time` >= (now() - interval 5 minute) AND `taxist_id`='".$ss['taxist_id']."'";
			$geo = db_req($req);
			if($geo==false)
			{
				//geo not actually
				echo "2";
			}
			else
			{
				//geo = act, WORK = 1
				////////////////////////////////
				///ПРОВЕРКА НА ПИНГ ПОНГ     ///
				////////////////////////////////
				if($geo['long']>=127&&$geo['long']<=130&&$geo['lat']<=63&&$geo['lat']>=60)
				{
					//В ГОРОДЕ
					echo "1";
				}
				else
				{
					//ЕБЕНЬЯ
					echo "3";
				}
			}
*/
		}
		else
		{
			////ТОГДА ПОЗВОНИТ КЛИЕНТУ!!!!!!!!!!!
			echo "0";
		}
	}
////////////////////////////
//////елси на вызов ответили
////////////////////////////
	if($argv[1]=="answer")
	{
		$numb = substr($argv[2],1,10);
		$sql = "SELECT * FROM indriver.taxist WHERE `phone_taxist`=".$numb;
		$ss = db_req($sql);
		///обвнолвяет диал статус на разговор закончен
		$sql12 = "UPDATE `taxist` SET `dial_status`='5' WHERE `phone_taxist`='".$numb."'";
		db_req_without_resp($sql12);
		///кандидат не подходит
		if($ss['work']==6)
		{
			echo 6;
		}
		///клиент найден
		if($ss['work']==2)
		{
			echo 2;
		}
		///ищу работу
		if($ss['work']==1)
		{
			echo 1;
		}
	}
//////////////////////////////////
/////если абонент занят
//////////////////////////////////
	if($argv[1]=="BUSY")
	{
		$numb = substr($argv[2],1,10);
		$sql = "UPDATE `taxist` SET `dial_status`='4' WHERE `phone_taxist`='".$numb."'";
		db_req_without_resp($sql);
	}
//////////////////////////////////
////изменить состояние на разговор
////
//////////////////////////////////
	if($argv[1]=="SPEAK")
        {
		///меняет состяние вызова на разговор
		$numb = substr($argv[2],1,10);
		$sql = "UPDATE `taxist` SET `dial_status`='3' WHERE `phone_taxist`='".$numb."'";
		///берет айди таксиста
		db_req_without_resp($sql);
		$sql = "SELECT `taxist_id` FROM indriver.taxist WHERE `phone_taxist`='".$numb."'";
		///сохраняет имя каналла клиента.
		$ss = db_req($sql);
		$sql = "REPLACE INTO `sip_channel_client` (`channel_client`, `taxist_id`) VALUES ('".$argv[3]."', '".$ss['taxist_id']."');";
		db_req_without_resp($sql);
        }
/////////////////////////////////
/////// обновить имя канала клиента НА вызов обновляется на вызов в call_filter-е
/////////////////////////////////
	if($argv[1]=="RING")
	{
		////берет айди таксиста
		$numb = substr($argv[2],1,10);
		$sql = "SELECT `taxist_id` FROM indriver.taxist WHERE `phone_taxist`='".$numb."'";
		///заменеят полсдний канал клиента на текущего клиента
		$ss = db_req($sql);
		$sql = "REPLACE INTO `sip_channel_client` (`channel_client`, `taxist_id`) VALUES ('".$argv[3]."', '".$ss['taxist_id']."');";
		db_req_without_resp($sql);

	}
//////////////////////////////////
//////видимо просто так
//////////////////////////////////
	if($argv[1]=="mynum")
	{
		echo $argv[2];
	}
////////////////////////////////
////запросить телефонный номер последнего клиента таксисита
////////////////////////////////
	if($argv[1]=="work")
	{
		$numb = substr($argv[2],1,10);
		$sql = "SELECT `phone` FROM current_taxa_android WHERE taxist_id=(SELECT `taxist_id` FROM `taxist` WHERE `phone_taxist`='".$numb."') order by `id_taxa` Desc limit 1";
		$ss = db_req($sql);
		echo $ss['phone']."@android-out";
	}
}
///////////////////////////
/////берет филтры
//////////////////////////
if($input['action']=="get")
{
        if($input['id']=="filt")
        {
                $req = "SELECT filt_price,filt_dist FROM `taxist` WHERE `username`='".$input['user']."';";
		//echo $req;
                $ret = db_req($req);
                echo json_encode($ret);
        }
////////////////////////////////////
//////////антииндрайвер ищет клиента
////////////////////////////////////
	if($input['id']=="client")
	{
		$sql = "SELECT * FROM `taxist` WHERE username='".$input['user']."'";
		$ret1 = db_req($sql);
		if($ret1['work']!=0)
		{
			$sql = "SELECT * FROM current_taxa_android WHERE taxist_id=(SELECT `taxist_id` FROM `taxist` WHERE username='".$input['user']."') order by `id_taxa` Desc limit 1";
			$ret = db_req($sql);

			//if($ret['new']==1)
			//{
				$sql = "UPDATE `current_taxa_android` SET `new`='0' WHERE `id_taxa`='".$ret['id_taxa']."'";
				db_req($sql);
				$ret[] = $ret1['work'];
				$ret[] = $ret1['dial_status'];
				$ret[] = $ret1['connected'];
				echo json_encode($ret);
//			}

//			else
//			{
//
//				$ret4[] = $ret1['work'];
//                                $ret4[] = $ret1['dial_status'];
//                                $ret4[] = $ret1['connected'];
//				$ret4['ans'] = "empty";
//				echo json_encode($ret4);
//			}
		}
		else
		{
			$as = array("ans"=>"work_error");
			echo json_encode($as);
		}
	}
}
?>
