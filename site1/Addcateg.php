<?php
require  ('Connection.php');

if (isset($_POST['send']))
{

    $fname = $_POST['fname'];
    mysql_connect($sqlhost,$sqluser,$sqlpass)
       or die("MySQL недоступна!".mysql_error());

    mysql_select_db($db) or die("Нет соединения с БД!".mysql_error());
    mysql_query("SET NAMES utf8");
        $sql="INSERT INTO clothes.types (type) VALUES  ('".$fname."')";
        mysql_query($sql) or die("Ошибка добавления данных");
}


echo "<html><head><meta charset= 'utf-8' >
    <link href='css/bootstrap.css' rel='stylesheet' />
    <link href='css/bootstrap.min.css' rel='stylesheet' />
    <link href='css/Site.css' rel='stylesheet' />
</head><body>
<form method='POST' action='addcateg.php' enctype='multipart/form-data' name='frmupload' class='container body-content'>
<table align='center' class='jumbotron' cellpadding='7' border='0' cellspacing='5'>
<tr><td align='center'>Введите наименование товарной категории<br/>
<input id='fname' type='text' name='fname' autocomplete='off'/>
<input type='submit' id='send' name='send' value='Добавить' />
</td></tr>
<tr><td align='center'><a href='Addtovar.php'>Назад</a>";
if (isset($_POST['send']))
{
       echo "<tr><td align='center'><p style=".'"'."color: green;".'"'.">Товарная категория добавлена</p></td></tr>";

}
echo "</table></form></body></html>";

?>