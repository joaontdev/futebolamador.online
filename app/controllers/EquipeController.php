<?php

// Define o namespace para organizar melhor as classes (prática recomendada)
namespace App\Controllers;

use App\Models\Equipe;

/**
 * Classe responsável por lidar com a lógica de negócio das Equipes.
 */
class EquipeController
{

    public function salvar()
    {


        // 1. Coleta e sanitiza os dados do formulário (usando o $_POST)
        $data = [
            'nomeEquipe' => $_POST['nomeEquipe'] ?? '',
            'logradouro' => $_POST['logradouro'] ?? '',
            'cidade' => $_POST['cidade'] ?? '',
            'estado' => $_POST['estado'] ?? '',
            'anoFundacao' => (int) ($_POST['anoFundacao'] ?? 0),
            'nomeComandante' => $_POST['nomeComandante'] ?? '',
        ];

        // 2. Cria uma nova instância da Equipe

        $equipe = new Equipe($data);

        // 3. Tenta inserir no banco de dados
        if ($equipe->insert()) {
            // Sucesso: Redireciona o usuário para a página inicial
            echo \json_encode([
                'success' => true,
                'message' => 'Equipe salva com sucesso!',
            ]);
            exit;
        } else {
            // Falha: Pode redirecionar de volta para o formulário com uma mensagem de erro
            // header('Location: /nova-equipe?error=db_fail');
            // exit;
            echo \json_encode([
                'success' => false,
                'message' => 'Erro ao salvar a equipe no banco de dados.',
            ]);
            exit;
        }
    }
}
