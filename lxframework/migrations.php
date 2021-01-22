<?php


use app\core\Application;


require_once __DIR__ . '/vendor/autoload.php';
include __DIR__ . '/boot/constant.php';


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = include_once __BOOT__ . 'config.php';

$app = new Application($config);

$app->db->applyMigrations();
