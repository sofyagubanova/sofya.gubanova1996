<?php
function GetCName($ID)
{


require  ('Connection.php');

$sql="SELECT Type from Clothes.types where id='".$ID."'" or die(mysql_error);
$data = mysql_query($sql);

while($line=mysql_fetch_array($data, MYSQL_NUM))
{
   $b =  $line[0];

}

return $b;

}

?>