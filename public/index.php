<?php

// public/index.php

// --- CARREGAMENTO E CONFIGURAÇÃO ---

// 1. Carrega o autoloader do Composer para usar bibliotecas de terceiros.
// O __DIR__ aponta para /public, então usamos '/../' para subir um nível.

use Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';


// 2. Carrega as variáveis de ambiente do arquivo .env que está na raiz do projeto.
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// 3. Define a constante BASE_URL a partir do valor em .env.
// Agora seus links nas views funcionarão dinamicamente.
define('BASE_URL', $_ENV['APP_URL']);

// 4. Carrega o arquivo de rotas.
require __DIR__ . '/../app/routes.php';


// --- ROTEAMENTO ---

// 5. Pega a URI da requisição (ex: "/futplay-v2/login").
$requestUri = $_SERVER['REQUEST_URI'];


// 6. Extrai o caminho da URL base (ex: "/futplay-v2") para poder limpá-lo da URI.
// Isso torna o sistema portátil para qualquer domínio ou subdiretório.
$basePath = parse_url(BASE_URL, PHP_URL_PATH) ?? '';

if (!empty($basePath) && strpos($requestUri, $basePath) === 0) {
    $requestUri = substr($requestUri, strlen($basePath));
}

// 7. Garante que a URI seja "/" se estiver vazia (para a página inicial).
if (empty($requestUri) || $requestUri === false) {
    $requestUri = '/';
}

// 8. Chama a função de roteamento para exibir a view correta.
routeToView($requestUri, $routes);
