<?php
/**
 * Created by PhpStorm.
 * User: bar0metr
 * Date: 18.03.18
 * Time: 16:56
 */
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="en"/>
    <link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/main.css"/>

    <title>Работа с транзакциями</title>

</head>

<body>
<?php
session_start();
if (isset($_SESSION['login'])): ?>
    <div class="admmenu">
        <ul>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">Привет, <?= $_SESSION['login']; ?></a>
                <div class="dropdown-content">
                    <a href="/auth/logout">Выход</a>
                </div>
            </li>
        </ul>
    </div>
    <div id="infopanel"></div>
<?php endif; ?>
<div class="header">
    <?php if (isset($_SESSION['balance'])): ?>
        Баланс:     <?php echo $_SESSION['balance']; ?>
    <?php endif; ?>
</div>

<div class="mainmenu">
    <ul>
        <li><a class="button button2" href="/">Главная</a></li>
        <li><a class="button button2" href="/auth">Личный кабинет</a></li>
    </ul>
</div>

<div class="main_conteiner">
    <?php
    include($contentPage);
    ?>


</div>
<div id="footer">
    <div>&copy; bar0metr</div>
</div>

</body>
</html>