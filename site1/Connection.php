<?php
$sqlhost="77.221.146.64";
$sqluser="clothes";
$sqlpass="Myie69@3";
$db="clothes";
    $user_name =$_POST['user_name'];
    $message =$_POST['message'];
    mysql_connect($sqlhost,$sqluser,$sqlpass)
       or die("MySQL ����������!".mysql_error());

mysql_select_db($db) or die("��� ���������� � ��!".mysql_error());
?>