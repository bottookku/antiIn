<?php
require_once "/var/www/indriver/function/db.php";

if(!is_null($_POST['id']))
{
	include "/var/www/indriver/modules/stop.php";
	$req = "INSERT INTO history (`from`,`to`,`price`,`phone`,`taxist_id`, `indriver_id`) SELECT `from`,`to`,`price`,`phone`,$_POST[id],`id_tax` FROM current_taxa ORDER BY current_taxa_id DESC LIMIT 1";
	db_req_without_resp($req);
	$req = "UPDATE `status` SET `init`='0' WHERE `status_id`='0';";
	db_req_without_resp($req);

	echo "OK";
}

if($_POST['poziv']==1)
{
	$ast = db_reqs("SELECT * FROM taxist WHERE work=1;");
	echo json_encode($ast);
}
if($_POST['poziv']==2)
{
        $ast = db_reqs("SELECT * FROM taxist;");
	foreach($ast as $key => $val)
	{
	$ast1[$val['taxist_id']]=
        array(
                'taxist_id' => $val['taxist_id'],
                'username'=>$val['username'],
                'priznak'=>$val['priznak'],
                'work'=>$val['work']
                );
	}
        echo json_encode($ast1);
}
if(!is_null($_POST['tax_work']))
{
	$ss = explode(":",$_POST['tax_work']);
	if($ss[1]==1)
	{$w = 0;}
	if($ss[1]==0)
	{$w = 1;}
	$req = "UPDATE `taxist` SET `work`=$w WHERE `taxist_id`=$ss[0];";
	db_req_without_resp($req);
	echo 1;
}


if($_POST[zimba]==1)
{
	$req = "UPDATE `taxist` SET `username`='$_POST[username]',`priznak`='$_POST[priznak]' WHERE `taxist_id`=$_POST[taxist_id];";
	db_req_without_resp($req);
	echo "99";
}
if($_POST[remove]==2)
{

	$req = "DELETE FROM `indriver`.`taxist` WHERE `taxist_id`=$_POST[taxist_id];";
	db_req_without_resp($req);
        echo 75;
}
if($_POST[add]==1)
{
	$req = "INSERT INTO `indriver`.`taxist` (`username`, `priznak`, `work`) VALUES ('Отрекдактируйте только потом продолжить', '****', '');";
        $ss = db_req($req);
	echo 45;
}








?>
