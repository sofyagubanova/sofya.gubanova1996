<?php

require('GUID.php');


if (isset($_POST['send']))
{
    $GUID = GUID();
    require('Connection.php');
    $uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';
    $ext = strtolower(substr(strrchr($_FILES['imgfile']['name'],'.'), 1));
    $uploadfile = $uploaddir .$GUID.".$ext";
    $uploadfile;
    $firmname=$_POST['fname'];
    $tovarname=$_POST['tovarname'];
    $tovardescr=$_POST['tovardescr'];
    $tovarprice=$_POST['tovarprice'];
    if($_POST['isman'])
    {
        $isman="true";
    }
    else
    $isman="false";

    mysql_select_db($db) or die("Нет соединения с БД!".mysql_error());
    mysql_query("SET NAMES utf8");
        $sql="INSERT INTO clothes.tovar (idtype,clothesname,isman,photo) VALUES
('".$firmname."','".$tovarname."','".$isman."','".$GUID.'.'.$ext."')";
       $data = mysql_query($sql) or die("Нет соединения с БД!<br/>".mysql_error());
       move_uploaded_file( $_FILES['imgfile']['tmp_name'], $uploadfile );
}


echo "<html><head><meta charset= 'utf-8' >
    <link href='css/bootstrap.css' rel='stylesheet' />
    <link href='css/bootstrap.min.css' rel='stylesheet' />
    <link href='css/Site.css' rel='stylesheet' />
</head><body>";

echo "<form method='POST' action='addtovar.php' enctype='multipart/form-data' name='frmupload' class='container body-content'>";

include('Connection.php');
mysql_query("SET NAMES utf8");
$sql="SELECT * from clothes.types" or die(mysql_error());
$data = mysql_query($sql);
echo "<table align='center' class='jumbotron' cellpadding='7' border='0' cellspacing='5'>
<tr>
<td align='center'>
<select size='1' name='fname'>";
while($line=mysql_fetch_array($data, MYSQL_NUM))
{
    echo "<option value='".$line[0]."'>".$line[1]."</option>";
}
echo "</select><br/>";
echo "<a href='addcateg.php'>Добавить товарную категорию</a><br/>";
echo "Название товара<br/><input id='tovarname' type='text' name='tovarname' autocomplete='off'/><br/>
Цена товара</br><input id='tovarprice' type='text' name='tovarprice' autocomplete='off'/></br>
описание товара<br/><textarea rows='5' cols='40' name='tovardescr' autocomplete='off'/></textarea></br>
<input id='isman' name= 'isman' type='checkbox' />
 <input type='file'
           name='imgfile'
           id='imgfile'
           value='fileupload'><br/>
<input type='submit' id='send' name='send' value='Добавить' />
</td>
</tr>

<tr>

<td align='center'><a href='Index.php'>Назад</a></tr>";

if (isset($_POST['send']))
{
   echo "<tr><td align='center'><p style=".'"'."color: green;".'"'.">Товар добавлен</p></td></tr>";

}
echo "</table></form></body></html>";

?>


