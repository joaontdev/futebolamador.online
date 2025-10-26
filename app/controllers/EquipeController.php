<?php

// Define o namespace para organizar melhor as classes (prática recomendada)
namespace App\Controllers;


// --- Contorno do Autoloader: Incluindo dependências manualmente ---
// Usamos __DIR__ (diretório atual) e ../ (voltar um nível) para garantir 
// que o caminho seja sempre correto, independentemente de onde o script seja chamado.

// Inclui o modelo Equipe: (app/controllers/../models/Equipe.php)
require_once __DIR__ . '/../models/Equipe.php';

// Inclui a classe de Conexão Database: (app/controllers/../core/Database.php)
require_once __DIR__ . '/../core/Database.php';
// ----------------------------------------------------------------

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


    // Função que cria uma list group de todas as equipes registradas no banco de dados.
    // Essa é a lista:<a href="#" class="list-group-item list-group-item-action">
    //     <div class="d-flex w-100 justify-content-between">
    //         <h5 class="mb-1">NOME DA EQUIPE</h5>
    //         <small class="text-body-secondary">-</small>
    //     </div>
    //     <p class="mb-1">Representante: Nome do representante</p>
    //     <small class="text-body-secondary">Localizcao e ano de fundação</small>
    // </a>
    public static function listarEquipes()
    {

        $lista = "";

        // Cria uma nova instância da Equipe.
        // Se o Autoloader falhar AQUI, o erro Fatal ainda acontecerá, 
        // mas assumimos que o Autoloader está funcionando após as correções no composer.json.
        $equipe = new Equipe([]);
        $equipes = $equipe->getEquipes();



        $indice = 1;
        foreach ($equipes as $equipe) {

            $color = "";
            if ($indice != 1) {
                $color = "bg-light";
                $indice = 1;
            } else {
                $indice = 0;
            }

            $lista .= "<a href=\"#\" class=\"list-group-item list-group-item-action $color \">";
            $lista .= "<div class=\"d-flex w-100 justify-content-between\">";
            $lista .= "<h6 class=\"mb-1 text-success\"><i class=\"bi bi-people\"></i> " . $equipe['nomeEquipe'] . "</h6>";
            $lista .= "<small class=\"text-body-secondary\"></small>";
            $lista .= "</div>";
            $lista .= "<p class=\"mb-1\"><i class=\"bi bi-person\"></i> Representante: " . $equipe['nomeComandante'] . "</p>";
            $lista .= "<small class=\"text-body-secondary\"><i class=\"bi bi-geo-alt\"></i> ";
            $lista .= $equipe['logradouro'] . ", ";
            $lista .= $equipe['cidade'] . ", ";
            $lista .= $equipe['estado'] . ", ";
            $lista .= $equipe['anoFundacao'] . "</small>";
            $lista .= "</a>";
        }

        return $lista;
    }
}
