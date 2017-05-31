<?php
session_start();
echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>";
echo "<html xmlns='http://www.w3.org/1999/xhtml'>";
echo "<head charset='utf-8'>";
echo "<title>Магазин одежды</title>";
echo "<link rel='stylesheet' type='text/css' href='style.css'/>";
echo "</head>";
echo "<body><form action='price.php' method='POST'>";
echo "<div id='container'>";
echo "<div id='header'> <a href=''>Добро пожаловать в наш магазин</a> </div>";
echo "<div id='menu'>";
echo "<a href='index.php'>ГЛАВНАЯ&nbsp;&nbsp;&nbsp;&nbsp;</a>";
echo "<a href=''>О НАС&nbsp;&nbsp;&nbsp;&nbsp;</a>";
echo "<a href=''>СЕРВИСЫ&nbsp;&nbsp;&nbsp;&nbsp;</a>";
echo "<font color='white'><b>Прайс-лист</b></font>&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<a href='addtovar.php'>Товары нашего магазина</a>";
echo "<a href='korzina.php'>Корзина</a>";
echo "</div>";
echo "<div id='sidebar'>";
echo "<h1>  Товары и цена нашего магазина</h1>";
echo "</div>";
echo "<div id='main'>";
require  ('Connection.php');
mysql_select_db($db) or die("Нет соединения с БД!".mysql_error());
mysql_query("SET NAMES utf8");


require  ('GetCName.php');
$sql="SELECT * from clothes.tovar" or die(mysql_error);
$data = mysql_query($sql);
echo "<hr/><table align='center' class='jumbotron' cellpadding='7' border='0' cellspacing='5'>";
echo "<tr><td align='center' colspan='4'><p style=".'"'."color: blue;".'"'.">Сегодня мы предлагаем следующие товары</p></td></tr>";
while($line=mysql_fetch_array($data, MYSQL_NUM))
{
    echo "<tr align='center'>";
    echo "<td align='center'>";
    echo $line[0];
    echo "</td>";
    echo "<td align='center'>";
    echo "</td>";
    echo "<td>";
    if($line[4]==null)
    {
        echo "<img src='/uploads/nophoto.jpg' height='120' width='160'/>";
    }
    else
    {
        echo "<img src='/uploads/".$line[4]."' height='120' width='160'/>";
    }
    echo "<a href='korzina.php?ID=".$line[0]."'>Добавить в корзину </a>";
    echo "</td>";
    echo "<td align='center'>";
    echo GetCName($line[1])."</td>";
    echo "<td align='center'>";
    echo $line[2]."</td>";
    echo "</tr>";

}

if(isset($_POST['send']))
{

    require  ('Connection.php');
    mysql_select_db($db) or die("Нет соединения с БД!".mysql_error());
    mysql_query("SET NAMES utf8");
    $sql="INSERT INTO clothes.korzina (userid,tovarid,quantity) VALUES
(1,1,1)";
    $data = mysql_query($sql) or die("Нет соединения с БД!<br/>".mysql_error());


}

echo "<tr align='center'><td colspan='4'>";
echo "<a href='Index.php'>Назад</a></td></tr>";
echo "</table></form></body></html>";

echo"</div>
  <div id='footer'> &copy;2011 Cамый простой шаблон &nbsp;<span class='separator'>|</span>&nbsp; <a href=''></a> </div>
</div>
</form>
</body>
</html>";
?>