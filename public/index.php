<?php

declare(strict_types=1);

define('ROOT_PATH', dirname(__DIR__));
define('APP_PATH', ROOT_PATH . '/app');
define('PUBLIC_PATH', __DIR__);

$scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
$scriptDir = rtrim(str_replace('\\', '/', dirname($scriptName)), '/');
$isRootFrontController = defined('ROOT_FRONT_CONTROLLER') && ROOT_FRONT_CONTROLLER === true;

define('BASE_PATH', $isRootFrontController ? ($scriptDir === '/' ? '' : $scriptDir) : ($scriptDir === '/' || $scriptDir === '/public' ? '' : preg_replace('#/public$#', '', $scriptDir)));
define('ASSET_BASE_PATH', $isRootFrontController ? BASE_PATH . '/public' : (BASE_PATH === '' ? '' : BASE_PATH . '/public'));

ini_set('session.save_path', ROOT_PATH . '/storage/cache');
ini_set('session.use_strict_mode', '1');
ini_set('session.cookie_httponly', '1');
ini_set('session.cookie_samesite', 'Lax');

session_start();

require ROOT_PATH . '/app/helpers/functions.php';
require ROOT_PATH . '/app/helpers/ImageUpload.php';
require ROOT_PATH . '/core/Router.php';
require ROOT_PATH . '/core/Controller.php';
require ROOT_PATH . '/core/Model.php';
require ROOT_PATH . '/core/Database.php';

$router = require ROOT_PATH . '/config/routes.php';
$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
