<?php


use app\core\Application;


require_once __DIR__ . '/vendor/autoload.php';
include __DIR__ . '/boot/constant.php';


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ],
];
$app = new Application($config);

$app->db->applyMigrations();
