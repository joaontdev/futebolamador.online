<?php

// public/index.php

// --- CARREGAMENTO E CONFIGURAÇÃO ---

// 1. Carrega o autoloader do Composer para usar bibliotecas de terceiros.
use Dotenv\Dotenv;
require_once __DIR__ . '/vendor/autoload.php';

// 2. Carrega as variáveis de ambiente do arquivo .env.
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// 3. Define a constante BASE_URL a partir do valor em .env.
define('BASE_URL', $_ENV['APP_URL']);

// 4. Carrega o arquivo de rotas.
require __DIR__ . '/app/routes.php';

// --- ROTEAMENTO ---

// 5. Pega a URI da requisição.
$requestUri = $_SERVER['REQUEST_URI'];

// 6. Remove a querystring (tudo após o '?').
$requestUri = strtok($requestUri, '?');

// 7. Adiciona uma lógica condicional para ambientes diferentes
if ($_ENV['APP_ENV'] === 'local') {
    // Remove a parte da URI referente ao diretório do projeto local.
    // Usamos parse_url para pegar o caminho de APP_URL
    $basePath = parse_url(BASE_URL, PHP_URL_PATH);
    if (!empty($basePath) && strpos($requestUri, $basePath) === 0) {
        $requestUri = substr($requestUri, strlen($basePath));
    }
}


// 8. Garante que a URI seja "/" se estiver vazia.
if (empty($requestUri) || $requestUri === false) {
    $requestUri = '/';
}

// 9. Chama a função de roteamento com a URI limpa.
routeToView($requestUri, $routes);