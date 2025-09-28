<?php
// app/routes.php


// (O array que criamos acima fica aqui)
$routes = [
    '/' => __DIR__ . '/views/landingpage.php',
    '/inicio' => __DIR__ . '/views/landingpage.php',
    '/nova-equipe' => __DIR__ . '/views/cadastro-equipe.html',
    '/novo-confronto' => __DIR__ . '/views/cadastro-confronto.html',
];

// Função que processa a rota
function routeToView($uri, $routes)
{
    // Verifica se a URI existe no nosso mapa de rotas
    if (array_key_exists($uri, $routes)) {
        // Se existir, inclui o arquivo de view correspondente
        require $routes[$uri];
    } else {
        // Se não existir, retorna um código 404 e mostra a página de erro
        http_response_code(404);
        require __DIR__ . '/views/404.html';
    }
}
