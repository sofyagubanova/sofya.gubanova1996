<?php
session_start();
session_destroy();
echo "ВЫ вышли!<br />";
echo "<a href='index.php'>Перейти главную страницу</a>";
?>