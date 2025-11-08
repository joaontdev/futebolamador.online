<?php

namespace App\Controllers;

// --- Contorno do Autoloader: Incluindo dependências manualmente ---
// Garante que o Modelo Confronto e a Conexão Database estejam carregados.
require_once __DIR__ . '/../models/Confronto.php';
require_once __DIR__ . '/../core/Database.php';

use App\Models\Confronto;

/**
 * Classe responsável por lidar com a lógica de negócio dos Confrontos (Jogos).
 */
class ConfrontoController
{
    /**
     * Processa a submissão de dados do formulário de confronto (POST)
     * e insere o registro no banco de dados.
     */
    public function salvar()
    {
        // --- 1. CONFIGURAÇÃO DE SAÍDA ---
        header('Content-Type: application/json');

        // --- 2. COLETA DE DADOS ---
        $data = [
            'equipeMandante'        => (int) ($_POST['equipeMandante'] ?? 0),
            'equipeVisitante'       => (int) ($_POST['equipeVisitante'] ?? 0),
            'tipoConfronto'         => $_POST['tipoConfronto'] ?? '',
            'dataConfronto'         => $_POST['dataConfronto'] ?? '',
            'horaConfronto'         => $_POST['horaConfronto'] ?? '',
            'statusConfronto'       => $_POST['statusConfronto'] ?? 'Agendado', // Define 'Agendado' como padrão
            'logradouroConfronto'   => $_POST['logradouroConfronto'] ?? '',
            'cidadeConfronto'       => $_POST['cidadeConfronto'] ?? '',
            'estadoConfronto'       => $_POST['estadoConfronto'] ?? '',
            'golsMandante'          => (int) ($_POST['golsMandante'] ?? 0),
            'golsVisitante'         => (int) ($_POST['golsVisitante'] ?? 0),
        ];

        try {
            // 3. Tenta Criar e Inserir

            // Cria uma nova instância do Confronto.
            $confronto = new Confronto($data);

            // 4. Tenta inserir no banco de dados.
            if ($confronto->insert()) {
                // Sucesso
                echo json_encode([
                    'success' => true,
                    'message' => 'Confronto agendado com sucesso!',
                ]);
            } else {
                // Falha na inserção (insert() retornou false)
                http_response_code(500);
                echo json_encode([
                    'success' => false,
                    'message' => 'Erro ao agendar o confronto. Verifique as IDs das equipes.',
                ]);
            }
        } catch (\PDOException $e) {
            // 5. CAPTURA ERROS DE BANCO DE DADOS (Ex: Chave estrangeira inválida)
            http_response_code(500);
            error_log("Erro de PDO no Confronto: " . $e->getMessage());
            echo json_encode([
                'success' => false,
                'message' => 'Erro no banco de dados. Certifique-se de que as equipes selecionadas existem.',
            ]);
        } catch (\Exception $e) {
            // 6. CAPTURA OUTROS ERROS
            http_response_code(500);
            error_log("Erro geral no Confronto: " . $e->getMessage());
            echo json_encode([
                'success' => false,
                'message' => 'Ocorreu um erro interno inesperado ao agendar o confronto.',
            ]);
        }

        // Finaliza a execução
        exit;
    }
}
