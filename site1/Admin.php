<?php
echo "<html><head></head><body><form action='admin.php' method='POST'>";
session_start();
if($_POST['pass'] == '111')
{
    $_SESSION['log'] = "OK";
}
if ($_SESSION['log'] == "OK")
{
    echo "<a href='addtovar.php'>Добавить товар</a><br />";
    echo "<a href='news.php'>Добавить новости</a><br />";
    echo "<a href='exit.php'>Выйти</a>";
}
else
{
    echo "Введите пароль для доступа к странице администратора<br/>";
    echo "<input id='pass' type='text' name='pass' autocomplete='off'/><br/>";
    echo "<input id='send' type='submit' value='Войти' name='send'/><br/>";
    echo "<a href='index.php'>На главную</a><br />";
}

echo "</form></body></html>";
?>