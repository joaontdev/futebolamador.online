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
        // --- 1. CONFIGURAÇÃO DE SAÍDA (Obrigatorio no início) ---
        // Indica ao navegador que a resposta é JSON.
        header('Content-Type: application/json');

        // --- 2. COLETA DE DADOS ---
        $data = [
            // Usa o operador de coalescência null (??) para evitar "Undefined index"
            'nomeEquipe'        =>  $_POST['nomeEquipe']        ?? '',
            'logradouro'        =>  $_POST['logradouro']        ?? '',
            'cidade'            =>  $_POST['cidade']            ?? '',
            'estado'            =>  $_POST['estado']            ?? '',
            // O cast (int) garante que o valor seja um número, evitando erros de tipo
            'anoFundacao'       =>  (int) ($_POST['anoFundacao'] ?? 0),
            'nomeComandante'    =>  $_POST['nomeComandante']    ?? '',
        ];

        try {
            // 3. Tenta Criar e Inserir
            
            // Cria uma nova instância da Equipe.
            // Se o Autoloader falhar AQUI, o erro Fatal ainda acontecerá, 
            // mas assumimos que o Autoloader está funcionando após as correções no composer.json.
            $equipe = new Equipe($data);

            // 4. Tenta inserir no banco de dados.
            if ($equipe->insert()) {
                // Sucesso
                echo json_encode([
                    'success' => true,
                    'message' => 'Equipe salva com sucesso!',
                ]);
            } else {
                // Falha na inserção (se o método insert retornar false por algum motivo)
                http_response_code(500); 
                echo json_encode([
                    'success' => false,
                    'message' => 'Erro ao salvar a equipe no banco de dados (Insert retornou false).',
                ]);
            }

        } catch (\PDOException $e) {
            // 5. CAPTURA ERROS DE BANCO DE DADOS (Ex: Falha na conexão, Query SQL inválida)
            http_response_code(500);
            error_log("Erro de PDO: " . $e->getMessage()); // Loga o erro internamente
            echo json_encode([
                'success' => false,
                'message' => 'Erro de conexão ou query no banco de dados.',
                // Não é seguro expor a mensagem exata do banco para o usuário final
            ]);
            
        } catch (\Exception $e) {
             // 6. CAPTURA OUTROS ERROS (Ex: Classes não encontradas, erros de código)
            http_response_code(500);
            error_log("Erro geral: " . $e->getMessage()); // Loga o erro internamente
            echo json_encode([
                'success' => false,
                'message' => 'Ocorreu um erro interno inesperado.',
            ]);
        }
        
        // Finaliza a execução para garantir que nada mais seja impresso no corpo JSON.
        exit;
    }
}