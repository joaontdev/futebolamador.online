<?php
// public/index.php

// 1. Carrega o arquivo que contém o mapa de rotas e a função de roteamento
require __DIR__ . '/../app/routes.php';

// 2. Pega a URI da requisição (ex: "/login", "/cadastro-equipe")
$requestUri = $_SERVER['REQUEST_URI'];

// Remove o nome do projeto da URI se estiver rodando em um subdiretório
// Ex: transforma "/futplay-v2/login" em "/login"

$baseDir = '/futplay-v2';
if (strpos($requestUri, $baseDir) === 0) {
    $requestUri = substr($requestUri, strlen($baseDir));
}

// Garante que a URI seja "/" se estiver vazia (para a página inicial)
if (empty($requestUri)) {
    $requestUri = '/';
}


// 3. Chama a função de roteamento para exibir a view correta
routeToView($requestUri, $routes);