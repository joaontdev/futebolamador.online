<?php

use Dotenv\Dotenv;

require_once __DIR__ . '/vendor/autoload.php';

// Carrega variáveis do .env
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Define BASE_URL
define('BASE_URL', $_ENV['APP_URL'] ?? '');

// Carrega rotas
require __DIR__ . '/app/routes.php';

// Pega URI atual
$requestUri = $_SERVER['REQUEST_URI'] ?? '/';


// Remove querystring
$requestUri = strtok($requestUri, '?');

// Remove /index.php da URI (HostGator e similares)
$requestUri = str_replace('/index.php', '', $requestUri);

// Ajuste de base path (para ambiente local)
$basePath = parse_url(BASE_URL, PHP_URL_PATH);
if (!empty($basePath) && strpos($requestUri, $basePath) === 0) {
    $requestUri = substr($requestUri, strlen($basePath));
}

// Normaliza URI
// $requestUri = trim($requestUri, '/');
// echo '<pre>'; print_r($requestUri);echo '</pre>';exit;

// Garante que tenha um valor padrão
if ($requestUri === '') {
    $requestUri = '/';
}

// Roteia
routeToView($requestUri, $routes);
