<?php
$link = mysql_connect('localhost', 'root', '356386');
if (!$link) {
    die('Ошибка соединения: ' . mysql_error());
}
echo 'Успешно соединились';







mysql_db_query();





mysql_close($link);
?>

