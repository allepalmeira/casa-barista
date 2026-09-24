<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Pasta do projeto Laravel (app, vendor, storage...).
// Normalmente é a pasta de cima. Se no servidor esta pasta "public" for COPIADA
// para dentro do site (ex.: httpdocs/barista), troque pelo caminho do projeto,
// por exemplo: $projeto = __DIR__.'/../../casa-barista';
$projeto = __DIR__.'/..';

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = $projeto.'/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require $projeto.'/vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once $projeto.'/bootstrap/app.php';

// Uploads (banner, galeria, produtos...) sempre na pasta que o navegador acessa
$app->usePublicPath(__DIR__);

$app->handleRequest(Request::capture());
