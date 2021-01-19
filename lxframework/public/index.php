<?php

require_once __DIR__ . '/../vendor/autoload.php';
include __DIR__ . '/../boot/constant.php';

use app\controllers\AuthController;
use app\controllers\SiteControlller;
use app\core\Application;

$conf = include_once __CONFIG__ . '/app.php';
$app = new Application($conf);

$app->router->get('/', [SiteControlller::class, 'home']);

$app->router->get('/about', [SiteControlller::class, 'about']);

$app->router->get('/contact', [SiteControlller::class, 'contact']);
$app->router->post('/contact', [SiteControlller::class, 'handleContact']);

/**
 * AuthConttroller
 */
$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);

$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);

$app->run();
