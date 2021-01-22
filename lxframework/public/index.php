<?php
require_once __DIR__ . '/../vendor/autoload.php';
include __DIR__ . '/../boot/constant.php';

use app\controllers\AuthController;
use app\controllers\SiteControlller;
use app\core\Application;


$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = include_once __BOOT__ . 'config.php';
$app = new Application($config);

$app->router->get('/', [SiteControlller::class, 'home']);

$app->router->get('/about', [SiteControlller::class, 'about']);

$app->router->get('/contact', [SiteControlller::class, 'contact']);
$app->router->post('/contact', [SiteControlller::class, 'handleContact']);

/**
 * AuthConttroller
 */
$app->router->get('/logout', [AuthController::class, 'logout']);
$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);

$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);

$app->router->get('/profile', [AuthController::class, 'profile']);

$app->run();
