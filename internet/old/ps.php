<?php

$secret = 'W2xs42rV6n3x2g16nfpvtp6m'; // секрет, который мы получили в первом шаге от яндекс.
// получение данных.
$r = array(
    'notification_type' => $_POST['notification_type'], // p2p-incoming / card-incoming - с кошелька / с карты
    'operation_id'      => $_POST['operation_id'],      // Идентификатор операции в истории счета получателя.
    'amount'            => $_POST['amount'],            // Сумма, которая зачислена на счет получателя.
    'withdraw_amount'   => $_POST['withdraw_amount'],   // Сумма, которая списана со счета отправителя.
    'currency'          => $_POST['currency'],            // Код валюты — всегда 643 (рубль РФ согласно ISO 4217).
    'datetime'          => $_POST['datetime'],          // Дата и время совершения перевода.
    'sender'            => $_POST['sender'],            // Для переводов из кошелька — номер счета отправителя. Для переводов с произвольной карты — параметр содержит пустую строку.
    'codepro'           => $_POST['codepro'],           // Для переводов из кошелька — перевод защищен кодом протекции. Для переводов с произвольной карты — всегда false.
    'label'             => $_POST['label'],             // Метка платежа. Если ее нет, параметр содержит пустую строку.
    'sha1_hash'         => $_POST['sha1_hash']          // SHA-1 hash параметров уведомления.
);
// проверка хеш
if (sha1($r['notification_type'].'&'.
         $r['operation_id'].'&'.
         $r['amount'].'&'.
         $r['currency'].'&'.
         $r['datetime'].'&'.
         $r['sender'].'&'.
         $r['codepro'].'&'.
         $secret.'&'.
         $r['label']) != $r['sha1_hash']) 
{
	exit('ZNACHIT PIZDEC'); // останавливаем скрипт. у вас тут может быть свой код.
}
file_put_contents('sex.txt','222');
// обработаем данные. нас интересует основной параметр label и withdraw_amount для получения денег без комиссии для пользователя.
// либо если вы хотите обременить пользователя комиссией - amount, но при этом надо учесть, что яндекс на странице платежа будет писать "без комиссии".
$r['amount']          = floatval($r['amount']);
$r['withdraw_amount'] = floatval($r['withdraw_amount']);
$r['label']           = intval($r['label']); // здесь я у себя передаю id юзера, который пополняет счет на моем сайте. поэтому обрабатываю его intval
// дальше ваш код для обновления баланса пользователя / для вставки полученного платежа в историю платежей, например:

$sss = mysql_connect("localhost", "root", "356386") or
die("Ошибка соединения: " . mysql_error());
mysql_set_charset('utf8',$sss);
mysql_select_db("mydb");
$coin_summ = mysql_query("SELECT coin_summ FROM mydb.coin_summ WHERE user_id=".$r['label']);
$coin_summ = mysql_fetch_assoc($coin_summ);
if (is_array($coin_summ))
//Есть ли у этого пользователя платеж...
{
	//если есть
	//$coin_summ[coin_summ] сумма которая есть
	//$r['label'] id пользоваетля
	$add = $coin_summ[coin_summ] + $r['withdraw_amount'];
	mysql_query("UPDATE `mydb`.`coin_summ` SET `coin_summ`=".$add." WHERE `user_id`=".$r['label']);
}
else
{
	//если нет
	mysql_query("INSERT INTO coin_summ (user_id, coin_summ) VALUES('".$r['label']."', '".$r['withdraw_amount']."')");
}
//ВВЕСТИ В ИСТОРИЮ ПЛАТЕЖЕЙ
mysql_query("INSERT INTO coin (user_id, coin, real_coin) VALUES('".$r['label']."', '".$r['withdraw_amount']."', '".$r['amount']."')");
$sss = $_POST;
foreach($sss as $ss1 => $ss2)
{
        $dd = $ss1.": ".$ss2."\n";
        file_put_contents('sex.txt',$dd, FILE_APPEND);
}
?>
