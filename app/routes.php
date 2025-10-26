<?php
// app/routes.php


// (O array que criamos acima fica aqui)
$routes = [
    '/'                     => __DIR__ . '/views/landingpage.php',
    '/inicio'               => __DIR__ . '/views/landingpage.php',
    '/equipes-cadastradas'  => __DIR__ . '/views/equipes-cadastradas.php',
    '/nova-equipe'          => __DIR__ . '/views/cadastro-equipe.php',
    // '/novo-confronto'       => __DIR__ . '/views/cadastro-confronto.php',
    '/nova-equipe/salvar'   => [
        "controller"        => "EquipeController",
        "method"            => "salvar",
    ]
];

// Função que processa a rota
function routeToView($uri, $routes)
{
    // Verifica se a URI existe no nosso mapa de rotas
    if (array_key_exists($uri, $routes)) {
        if (is_array($routes[$uri])) {

            //
            $controllerName     =   $routes[$uri]['controller'];
            $methodName         =   $routes[$uri]['method'];
            $controllerClass    =   "App\\Controllers\\" . $controllerName;
            $controllerFilePath = __DIR__ . '/controllers/' . $controllerName . '.php';

            //
            if (file_exists($controllerFilePath)) {
                require $controllerFilePath;

                //
                if (class_exists($controllerClass) && method_exists($controllerClass, $methodName)) {
                    $controller = new $controllerClass();
                    $controller->$methodName();
                    return;
                }
            }
        } else {
            // Se existir, inclui o arquivo de view correspondente
            require $routes[$uri];
        }
    } else {
        // Se não existir, retorna um código 404 e mostra a página de erro
        http_response_code(404);
        require __DIR__ . '/views/404.php';
    }
}
