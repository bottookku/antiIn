<?php
//////////////////////////////////////////
///проверяет логин введенные через куки///
//////////////////////////////////////////
require_once __DIR__."/../function/db.php";
function auth_cookie()
{
	$ss = explode("_",$_COOKIE['id']);
	$req="SELECT user,pass FROM user WHERE user=\"".$ss[0]."\"";
	$row1 = db_req($req);

	if($ss[0]==$row1[0]['user']&&$ss[1]==$row1[0]['pass']&&$row1[0]['user']!==null&&$row1[0]['pass']!==null&&$row1[0]['user']!==''&&$row1[0]['pass']!=='')
	{
		$req="UPDATE user SET date_last_login=null WHERE user='".$row1[0][user]."'";
		db_req_without_resp($req);
		return $row1[0][user];
	}
	else
	{
		return false;
	}
}
?>
