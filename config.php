<?php
/**
 * Created by PhpStorm.
 * User: bar0metr
 * Date: 18.03.18
 * Time: 14:25
 */
// Задаем константы:
define('DS', DIRECTORY_SEPARATOR); // разделитель для путей к файлам
$sitePath = realpath(dirname(__FILE__) . DS) . DS;
define('SITE_PATH', $sitePath); // путь к корневой папке сайта

// для подключения к бд
define('DB_USER', 'root');
define('DB_PASS', '1');
define('DB_HOST', 'localhost');
define('DB_NAME', 'bit');
