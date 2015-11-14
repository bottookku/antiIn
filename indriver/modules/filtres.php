<?php
require_once __DIR__."/../function/db.php";
$req = "SELECT * FROM filtres;";
$ret = db_req($req);
if($s==1)
{echo $ret['price'];}
if($s==0)
{
echo $ret['dist'];
}
if(!is_null($_POST[price]))
{
	$req = "UPDATE filtres SET `price`='$_POST[price]' WHERE `filtres_id`='1';";
	echo $req;
	db_req($req);
	header("Location: ".$_SERVER['HTTP_REFERER']);
}



?>
