<?php
session_start();
$tovar = $_GET['ID'];

if(!$_SESSION['userid'] )
{
    $_SESSION['userid'] = generate_guid();
}



function generate_guid(){
    if (function_exists('com_create_guid')){
        return com_create_guid();
    }else{
        mt_srand((double)microtime()*10000);
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);// "-"
        $uuid = chr(123)//
            .substr($charid, 0, 8).$hyphen
            .substr($charid, 8, 4).$hyphen
            .substr($charid,12, 4).$hyphen
            .substr($charid,16, 4).$hyphen
            .substr($charid,20,12)
            .chr(125);//
        return substr($uuid,1,36);
    }
}
function giveimage($ud){

    $sql="SELECT * from clothes.tovar where id=".$ud or die(mysql_error());


    $data = mysql_query($sql) or die ("error!!!!!!!!!!");


    $line=mysql_fetch_row($data);

    return "<img src='/uploads/". $line[4] ."' widht='25%' height='25%''/>";

}

function givename($ud){

    $sql="SELECT * from clothes.tovar where id=".$ud or die(mysql_error());
    $data = mysql_query($sql) or die ("error!");


    $line=mysql_fetch_row($data);

    return $line[2];
}

function giveprice($ud){

    $sql="SELECT * from clothes.tovar where id=".$ud or die(mysql_error());

    $data = mysql_query($sql) or die ("ошибка запроса!");


    $line=mysql_fetch_row($data) or die ("ошибка получения цены");

    return $line[5];
}

function counter ($ud)

{
    $sql = "select count(*) from clothes.korzina where ((tovarid='".$ud."')
                                  and (userid='".$_SESSION['userid']."'))"
        or die(mysql_error());


    $data = mysql_query($sql);
    $line=mysql_fetch_row($data);
    return $line[0];

}
require  ('Connection.php');


if(counter($tovar)==0)
{
$sql="insert into clothes.korzina (tovarid,userid,quantity)
values('".$tovar."','".$_SESSION['userid']."','1')";
mysql_query($sql) or die(mysql_error());
}
else

{

    $sql= "UPDATE korzina SET quantity = quantity + 1 where tovarid='".$tovar."'";

    mysql_query($sql) or die ("error!");
}


echo "<html><head>
<meta charset='utf-8'>
<title></title>
</head><body>
<form action='zakaz.php' method='POST'><center>";
echo "
<h1 align=center>
<font face='monotype corsiva'>
Корзина покупок

</font></h1>";

$userd =  $_SESSION['userid'];


echo "<table align='center' border='1'>
<tr align='center'><td align='center'>№</td><td>Наименование</td>
<td align='center'>Внешний вид</td>
<td align='center'>Цена</td>
<td align='center'>Количество</td>
<td align='center'>Сумма</td></tr>";
$i=1;

$amount;
require  ('Connection.php');
mysql_query("SET NAMES utf8");
$sql="SELECT * from korzina where userid='".$userd."'" or die(mysql_error());
$data = mysql_query($sql) or die ("error!");

while($line=mysql_fetch_array($data, MYSQL_NUM))
{
    echo "<tr align='center'>";
    echo "<td align='center'>";
    echo $i;
    echo "</td>";
    echo "<td align='center'>";
    echo givename($line[2]);
    echo "</td>";
    echo "<td align='center'>".giveimage($line[2])."</td>";
    echo "<td align='center'>";
    echo giveprice($line[2]);
    echo "</td>";
    echo "<td align='center'>";
    echo $line[3];
    echo "</td><td align='center'>";
    echo $line[3]*giveprice($line[2]);
    echo "</td>";
    $amount =  $amount + $line[3]*giveprice($line[2]);
    $i++;
}
echo "</tr><tr align='center'><td colspan='6' align='center'>";
echo "Итого:".$amount." &#8381;";

echo "</td></tr></table>";





echo "<br/><input type='submit' class='b1' value='Оформить заказ'></center></form></body></html>";
?>
