<?php

namespace App\Controllers;

use App\Models\Usuario;
use PDO;

require_once __DIR__ .  '/../models/Login.php';
require_once __DIR__ . '/../core/Database.php';

class LoginController
{
    public function acessar()
    {

        // Validação inicial (POST)
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return ['success' => false, 'message' => 'Método inválido'];
        }

        // Sanitização das entradas
        $nomeUsuario = trim($_POST['nomeUsuario']);
        $senha = trim($_POST['senhaUsuario']);

        $login = new Usuario([]);

        $autencicacao = $login->autenticar($nomeUsuario, $senha);

        if ($autencicacao['success']) {

            // Inicia a sessão caso ainda não esteja iniciada
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            // Cria a sessão do usuário autenticado
            $_SESSION['usuario'] = [
                'id' => $autencicacao['usuario']['id'],
                'nome' => $autencicacao['usuario']['nomeUsuario'],
                'status' => $autencicacao['usuario']['status'],
                'logado' => true,
                'ultimo_acesso' => date('Y-m-d H:i:s')
            ];

            // Redireciona para o dashboard
            header("Location: " . BASE_URL . "/dashboard");
            exit;
        }

        \header("Location: " . \BASE_URL . "/login");
        exit;
    }

    public function logout()
    {
        // Inicia a sessão se ainda não estiver iniciada
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Remove todas as variáveis da sessão
        $_SESSION = [];

        // Destrói o cookie de sessão (boa prática)
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        // Encerra a sessão
        session_destroy();

        // Redireciona para a tela de login
        \header("Location: " . BASE_URL . "/login");
        exit;
    }


    public static function exigirLogin()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (
            !isset($_SESSION['usuario']) ||
            empty($_SESSION['usuario']['logado']) ||
            $_SESSION['usuario']['logado'] !== true
        ) {
            \header("Location: " . BASE_URL . "/login");
            exit;
        }
    }
}
