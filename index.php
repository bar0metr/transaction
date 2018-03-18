<?php
/**
 * Created by PhpStorm.
 * User: bar0metr
 * Date: 18.03.18
 * Time: 14:25
 */
error_reporting(E_ALL);

// подключаем конфиг
include('config.php');

// Соединяемся с БД
$dbObject = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$dbObject->exec('SET CHARACTER SET utf8');

// подключаем ядро сайта
include(SITE_PATH . DS . 'core' . DS . 'core.php');

// Загружаем router
$router = new Router();
// задаем путь до папки контроллеров.
$router->setPath(SITE_PATH . 'controllers');
// запускаем маршрутизатор
$router->start();
