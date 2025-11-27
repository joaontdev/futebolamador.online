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

        $data = [
            'equipeMandante'            => $_POST['equipeMandante'],
            'golsEquipeVitoriosa'       => $_POST['golsEquipeVitoriosa'],
            'equipeVisitante'           => $_POST['equipeVisitante'],
            'golsEquipePerdedora'       => $_POST['golsEquipePerdedora'],
            'equipeVitoriosa'           => $_POST['equipeVitoriosa'],
            'logradouro'                => $_POST['logradouro'],
            'cidade'                    => $_POST['cidade'],
            'estado'                    => $_POST['estado'],
            'dataPartida'               => $_POST['dataPartida'],
            'horaPartida'               => $_POST['horaPartida']
        ];



        try {
            $confronto = new Confronto($data);
            if ($confronto->insert()) {
                \header("Location: " . BASE_URL . "/sucesso-no-cadastro-de-confronto");
                exit;
            } else {
                \header("Location: " . BASE_URL . "/erro-no-cadastro-de-confronto");
                exit;
            }
        } catch (\PDOException $e) {

            \header("Location: " . BASE_URL . "/erro-no-cadastro-de-confronto");
            exit;
            // 5. CAPTURA ERROS DE BANCO DE DADOS (Ex: Chave estrangeira inválida)
            // http_response_code(500);
            // error_log("Erro de PDO no Confronto: " . $e->getMessage());
            // echo json_encode([
            //     'success' => false,
            //     'message' => 'Erro no banco de dados. Certifique-se de que as equipes selecionadas existem.',
            // ]);
        } catch (\Exception $e) {
            \header("Location: " . BASE_URL . "/erro-no-cadastro-de-confronto");
            exit;
            // 6. CAPTURA OUTROS ERROS
            // http_response_code(500);
            // error_log("Erro geral no Confronto: " . $e->getMessage());
            // echo json_encode([
            //     'success' => false,
            //     'message' => 'Ocorreu um erro interno inesperado ao agendar o confronto.',
            // ]);
        }

        // Finaliza a execução
        // exit;
    }
}
