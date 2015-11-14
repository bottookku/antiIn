<?php
echo "<meta charset=utf8>";
if($g3==1)
{//код принят
	header("Referer: 111");
	header("Location: /?co=ok");
}
else
{//код не принят
	echo "Код не принят";
}
?>
