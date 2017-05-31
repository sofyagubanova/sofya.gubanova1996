<?php

require('GUID.php');


if (isset($_POST['send']))
{
    $GUID = GUID();
    require('Connection.php');
    $newstext=$_POST['newstext'];
    mysql_select_db($db) or die("Нет соединения с БД!".mysql_error());
    mysql_query("SET NAMES utf8");
    $sql="INSERT INTO clothes.news (Text) VALUES ('".$newstext."')";
    $data = mysql_query($sql) or die("Нет соединения с БД!<br/>".mysql_error());
}


echo "<html><head><meta charset= 'utf-8' >
    <link href='css/bootstrap.css' rel='stylesheet' />
    <link href='css/bootstrap.min.css' rel='stylesheet' />
    <link href='css/Site.css' rel='stylesheet' />
</head><body>";

echo "<form method='POST' action='News.php' enctype='multipart/form-data' name='frmupload' class='container body-content'>";

include('Connection.php');
mysql_query("SET NAMES utf8");
$sql="SELECT * from clothes.types" or die(mysql_error());
$data = mysql_query($sql);
echo "<table align='center' class='jumbotron' cellpadding='7' border='0' cellspacing='5'>
<tr>
<td align='center'>";
echo "<a href='addcateg.php'>Добавить товарную категорию</a><br/>";
echo "Название товара<br/><input id='newstext' type='text' name='newstext' autocomplete='off'/><br/>
<input type='submit' id='send' name='send' value='Добавить' />
</td>
</tr>
<tr>
<td align='center'><a href='Index.php'>Назад</a></tr>";
echo "</table></form></body></html>";

?>


