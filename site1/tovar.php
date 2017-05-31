<?php
$err=false;
function GUID()
{
    if (function_exists('com_create_guid') === true)
    {
        return trim(com_create_guid(), '{}');
    }

    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}


echo "<html><head><meta charset= 'utf-8' >
    <link href='css/bootstrap.css' rel='stylesheet' />
    <link href='css/bootstrap.min.css' rel='stylesheet' />
    <link href='css/Site.css' rel='stylesheet' />
</head><body><form class='container body-content'>";
require  ('Connection.php');

mysql_select_db($db) or die("Нет соединения с БД!".mysql_error());
mysql_query("SET NAMES utf8");

$sql="SELECT * from firma.tovar where firmid='".$_GET['ID']."'" or die(mysql_error);
require  ('GetFirmName.php');

$data = mysql_query($sql);
echo "<hr/><table align='center' class='jumbotron' cellpadding='7' border='1' cellspacing='5'>";
echo "<tr><td align='center' colspan='4'><p style=".'"'."color: blue;".'"'.">Товары, предлагаемые фирмой   '".GetFirmName($_GET['ID'])."'</p></td></tr>";
while($line=mysql_fetch_array($data, MYSQL_NUM))
{
    echo "<tr align='center'>";
    echo "<td align='center'>";
    echo $line[2];
    echo "</td>";
    echo "<td align='center'>";
    echo "<img src='/uploads/".$line[3]."'/>";
    echo "</td>";
    echo "<td align='center'>";
    echo $line[4]."</td>";
    echo "<td align='center'>";
    echo $line[5]."</td>";
    echo "</tr>";

}

echo "<tr align='center'><td colspan='4'>";
echo "<a href='Index.php'>Назад</a></td></tr>";
echo "</table></form></body></html>";

?>