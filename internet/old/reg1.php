<?php
$sss = mysql_connect("localhost", "root", "356386") or
die("Ошибка соединения: " . mysql_error());
mysql_set_charset('utf8',$sss);
mysql_select_db("mydb");

$result2 = mysql_query("SELECT * FROM info2");
while ($row1[]=mysql_fetch_array($result2)){
}
foreach($row1 as $key => $val)
{
if($val === end($row1))
        {
                continue;
        }

$row[$val[0]] = $val[1];
}
//print_r($row);
echo json_encode($row);
?>
