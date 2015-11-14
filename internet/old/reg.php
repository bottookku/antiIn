<?php

$sss = mysql_connect("localhost", "root", "356386") or
die("Ошибка соединения: " . mysql_error());
mysql_set_charset('utf8',$sss);
mysql_select_db("mydb");

//$_POST[status]
$result2 = mysql_query("SELECT info3_id,info3_name FROM info3 WHERE info2_id = $_POST[status]");
while ($row1[]=mysql_fetch_array($result2)) {
}
foreach($row1 as $key => $val)
{
if($val === end($row1))
        {
                continue;
        }

$row[$val[0]] = $val[1];
}
echo json_encode($row);

/*
//if(is_null($_POST[info2]) ==! true)
//{
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
print_r($row);
//echo json_encode($row);
//}


*/













?>

