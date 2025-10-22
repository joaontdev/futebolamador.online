<?php
// app/routes.php


$routes = [
    '/' => __DIR__ . '/views/landingpage.php', // rota raiz
    '/inicio' => __DIR__ . '/views/landingpage.php',
    '/nova-equipe' => __DIR__ . '/views/cadastro-equipe.php',
    '/novo-confronto' => __DIR__ . '/views/cadastro-confronto.php',
];


$routesController = [
    // Adicione aqui as rotas que apontam para controladores, se necessário
    'controlador' => __DIR__ . '/controllers/EquipeController.php',
];

// Função que processa a rota
function routeToView($uri, $routes)
{
    // Verifica se a URI existe no nosso mapa de rotas
    if (array_key_exists($uri, $routes)) {
        // Se existir, inclui o arquivo de view correspondente
        require $routes[$uri];
    } else if (array_key_exists($uri, $routesController))
     {

        // Se for uma rota de controlador, inclui o arquivo do controlador
        


    } else {
        // Se não existir, retorna um código 404 e mostra a página de erro
        http_response_code(404);
        require __DIR__ . '/views/404.php';
    }
}
