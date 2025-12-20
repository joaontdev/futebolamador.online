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


        $escudo = null;
        if (!empty($_FILES['escudo'])) {
            $escudo = self::salvarEscudo($_FILES['escudo']);
        }

        $data = [
            'nomeEquipe'        =>  $_POST['nomeEquipe']            ?? '',
            'logradouro'        =>  $_POST['logradouro']            ?? '',
            'cidade'            =>  $_POST['cidade']                ?? '',
            'estado'            =>  $_POST['estado']                ?? '',
            'anoFundacao'       =>  (int) ($_POST['anoFundacao']    ?? 0),
            'nomeComandante'    =>  $_POST['nomeComandante']        ?? '',
            'escudo'            =>  empty($escudo) ? null : $escudo,
        ];

        try {
            $equipe = new Equipe($data);

            if ($equipe->insert()) {
                \header("Location: " . BASE_URL . "/sucesso-no-cadastro-de-confronto");
                exit;
            } else {

                \header("Location: " . BASE_URL . "/erro-no-cadastro-de-confronto?=Erro ao tentar inserir");
                exit;
            }
        } catch (\PDOException $e) {
            \header("Location: " . BASE_URL . "/erro-no-cadastro-de-confronto");
            exit;
        } catch (\Exception $e) {
            \header("Location: " . BASE_URL . "/erro-no-cadastro-de-confronto");
            exit;
        }
    }


    /**
     * Faz upload do escudo (PNG) e salva no projeto
     *
     * @param array  $file   $_FILES['escudo']
     * @param string $pasta  Pasta de destino (ex: 'uploads/escudos')
     * @return string        Nome do arquivo salvo
     * @throws Exception
     */
    private static function salvarEscudo(array $file): string
    {

        // Caminho absoluto da pasta
        $pasta = __DIR__ . '../../../public/assets/images/escudos';

        // 1. Verifica erro de upload
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return "";
        }

        // 2. Valida MIME type (mais seguro)
        $mime = mime_content_type($file['tmp_name']);
        if ($mime !== 'image/png') {
            return "";
        }

        // 3. Cria a pasta se não existir
        if (!is_dir($pasta)) {
            mkdir($pasta, 0755, true);
        }

        // 4. Gera nome único
        $nomeArquivo = uniqid('escudo_', false) . '.png';

        // 5. Caminho final
        $caminhoFinal = rtrim($pasta, '/') . '/' . $nomeArquivo;

        // 6. Move o arquivo
        if (!move_uploaded_file($file['tmp_name'], $caminhoFinal)) {
            return "";
        }

        return $nomeArquivo;
    }


    /**
     * Remove uma imagem da pasta de escudos
     *
     * @param string $nomeArquivo Nome do arquivo (ex: escudo_xxxxx.png)
     * @return bool
     * @throws Exception
     */
    private static function apagarEscudo(string $nomeArquivo): bool
    {
        $pasta = __DIR__ . '../../../public/assets/images/escudos';

        // Normaliza o caminho
        $pasta = rtrim($pasta, '/');

        // Caminho completo do arquivo
        $caminhoArquivo = $pasta . '/' . $nomeArquivo;

        // Segurança: evita apagar caminhos inválidos
        if (!file_exists($caminhoArquivo)) {
            return false;
        }

        if (!is_file($caminhoArquivo)) {
            return false;
        }

        // Apaga o arquivo
        if (!unlink($caminhoArquivo)) {
            return false;
        }

        return true;
    }



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

            if ($equipe->status == 0) {
                continue;
            }

            $color = "";
            if ($indice != 1) {
                $color = "bg-light";
                $indice = 1;
            } else {
                $indice = 0;
            }

            $lista .= "<a href=\"#\" class=\"list-group-item list-group-item-action $color \">";
            $lista .= "<div class=\"d-flex w-100 justify-content-between pt-2 pb-2\">";
            $lista .= "<h6 class=\"mb-1 text-dark\">" . $equipe['nomeEquipe'] . "</h6>";
            $lista .= "<small class=\"text-body-secondary\"></small>";
            $lista .= "</div>";
            // $lista .= "<p class=\"mb-1\"><i class=\"bi bi-person\"></i> Representante: " . $equipe['nomeComandante'] . "</p>";
            $lista .= "<small class=\"text-body-secondary\"> ";
            $lista .= $equipe['logradouro'] . ", ";
            $lista .= $equipe['cidade'] . ", ";
            $lista .= $equipe['estado'] . ", ";
            $lista .= $equipe['anoFundacao'] . "</small>";
            $lista .= "</a>";
        }

        return $lista;
    }


    // Função que retornará uma string de <option> com as equipes cadastradas.
    // Se $idSelecionado for informado, deixa a opção correspondente selecionada.
    public static function getEquipesOptions(int $idSelecionado = null)
    {
        $lista = "";

        // Instância da classe Equipe
        $equipe = new Equipe([]);
        $equipes = $equipe->getEquipes();

        foreach ($equipes as $e) {

            if ($e->status == 0) {
                continue;
            }

            // Verifica se é a equipe selecionada
            $selected = ($idSelecionado !== null && $idSelecionado == $e['id']) ? " selected" : "";

            // Cria a option HTML
            $lista .= "<option value=\"{$e['id']}\"{$selected}>{$e['nomeEquipe']}</option>";
        }

        return $lista;
    }



    public static function listarEquipesDashboard()
    {

        $tr = "";

        $equipe = new Equipe([]);
        $equipes = $equipe->getEquipes();

        foreach ($equipes as $equipe) {

            $tr .=  '<tr>
                <td>' . $equipe['id'] . '</td>
                <td>' . $equipe['nomeEquipe'] . '</td>
                <td>' . $equipe['logradouro'] . '</td>
                <td>' . $equipe['cidade'] . '</td>
                <td>' . $equipe['estado'] . '</td>
                <td>' . $equipe['anoFundacao'] . '</td>
                <td>' . $equipe['nomeComandante'] . '</td>
                <td><span class="badge bg-warning text-dark">' . $equipe['status'] . '</span></td>
                <td><span class="badge bg-danger-light" style="background-color: rgba(220,53,69,0.08); color:#dc3545; border:1px solid rgba(220,53,69,0.12);">' . $equipe['isDeleted'] . '</span></td>
                <td>' . $equipe['createdAt'] . '</td>
                <td>' . $equipe['updatedAt'] . '</td>
                <td class="text-end">
                <a role="button" href="' . BASE_URL . '/edicao-equipe?id=' . $equipe['id'] . '" class="btn btn-sm btn-outline-success btn-edit"><i class="bi bi-pencil"></i> Editar</button>
                </td>
                </tr>';
        }

        return $tr;
    }

    public static function buscarPorId($id)
    {
        // Cria uma nova instância da Equipe.
        // Se o Autoloader falhar AQUI, o erro Fatal ainda acontecerá, 
        // mas assumimos que o Autoloader está funcionando após as correções no composer.json.
        $equipe = new Equipe([]);
        return $equipe->getEquipeById($id);
    }

    public function editar()
    {

        $escudo = null;
        $equipeSelecionada = self::buscarPorId($_POST['idEquipe']);
        if (!empty($_FILES['escudo'])) {

            if (!empty($equipeSelecionada->escudo)) {
                self::apagarEscudo($equipeSelecionada->escudo);
            }

            $escudo = self::salvarEscudo($_FILES['escudo']);
        } else {
            $escudo = $equipeSelecionada->escudo;
        }


        $data = [
            // Usa o operador de coalescência null (??) para evitar "Undefined index"
            'nomeEquipe'        =>  $_POST['nomeEquipe']        ?? '',
            'logradouro'        =>  $_POST['logradouro']        ?? '',
            'cidade'            =>  $_POST['cidade']            ?? '',
            'estado'            =>  $_POST['estado']            ?? '',
            // O cast (int) garante que o valor seja um número, evitando erros de tipo
            'anoFundacao'       =>  (int) ($_POST['anoFundacao'] ?? 0),
            'nomeComandante'    =>  $_POST['nomeComandante']    ?? '',
            'escudo'            =>  empty($escudo) ? null : $escudo,
            'status'            =>  $_POST['status']            ?? 'Ativo',
        ];

        $equipe = new Equipe($data);
        $equipe->id = (int) ($_POST['idEquipe'] ?? 0);


        if ($equipe->update()) {
            \header("Location: " . BASE_URL . "/dashboard");
            exit;
        }

        header("Location: " . BASE_URL . "/edicao-equipe?id=" . $equipe->id . "");
        exit;
    }
}
