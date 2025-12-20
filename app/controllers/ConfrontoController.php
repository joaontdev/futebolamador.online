<?php

namespace App\Controllers;

// --- Contorno do Autoloader: Incluindo dependências manualmente ---
// Garante que o Modelo Confronto e a Conexão Database estejam carregados.
require_once __DIR__ . '/../models/Equipe.php';
require_once __DIR__ . '/../models/Confronto.php';
require_once __DIR__ . '/../core/Database.php';

use App\Models\Confronto;


class ConfrontoController
{

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
        } catch (\Exception $e) {
            \header("Location: " . BASE_URL . "/erro-no-cadastro-de-confronto");
            exit;
        }
    }

    public static function todosOsConfrontos()
    {

        $confronto = new Confronto([]);
        $confrontos = $confronto->getConfrontos();

        $list = "";
        foreach ($confrontos as $key => $confronto) {
            # code...

            $local = $confronto['logradouro'] . ' ' . $confronto['cidade'] . ' ' . $confronto['estado'];
            $data = \date_format(\date_create($confronto['data_partida']), 'd/m');
            $hora = \date_format(\date_create($confronto['hora_partida']), 'H:i');

            $resultadoConfronto = "";
            $styleResultado = "";
            if ($confronto['resultadoPartida'] === 'Aguardando') {
                $resultadoConfronto = 'Aguardando';
                $styleResultado = "color: #6c757d;";
            } else if ($confronto['resultadoPartida'] === 'Empate') {
                $resultadoConfronto = "Empate";
                $styleResultado = "color: #ffc107;";
            } else {
                $resultadoConfronto = "Vitória da Equipe " . $confronto['resultadoPartida'];
                $styleResultado = "color: #28a745;";
            }

            $escudoMandante = "";
            if (!empty($confronto['equipe_mandante']->escudo)) {
                $escudoMandante = '<img src="' . BASE_URL . '/public/assets/images/escudos/' . $confronto['equipe_mandante']->escudo . '" style="width: 45px; height: 45px; object-fit: contain;" alt="">';
            }

            $escudoVisitante = "";
            if (!empty($confronto['equipe_visitante']->escudo)) {
                $escudoVisitante = '<img src="' . BASE_URL . '/public/assets/images/escudos/' . $confronto['equipe_visitante']->escudo . '" style="width: 45px; height: 45px; object-fit: contain;" alt="">';
            }


            $nomeEquipeMandante = $confronto['equipe_mandante']->nome_equipe;
            if (!empty($escudoMandante)) {
                $nomeEquipeMandante = $escudoMandante;
            }

            $nomeEquipeVisitante = $confronto['equipe_visitante']->nome_equipe;
            if (!empty($escudoVisitante)) {
                $nomeEquipeVisitante = $escudoVisitante;
            }

            // 
            $list .= '<li class="list-group-item rounded-4 mb-3 shadow p-3 bg-body-tertiary rounded">
                            <p class="text-center mt-3 mb-3 fw-light" style="font-size: 0.9rem;">
                            <i class="bi bi-geo-alt"></i>
                            ' . $local . '
                            <i class="bi bi-dot"></i> <strong>
                            ' . $data . ' as ' . $hora . '
                            </strong></p>
                            <div class="justify-content-evenly w-100">
                                <div class="row">
                                    <div class="col-4 d-flex justify-content-center align-items-center text-center fw-light">
                                        ' . $nomeEquipeMandante . '
                                    </div>
                                    <div class="col-1 fw-bold d-flex justify-content-center align-items-center text-center">
                                       ' . $confronto['gols_equipe_mandante'] . '
                                    </div>
                                    <div class="col-2 d-flex justify-content-center align-items-center text-center">
                                        <i class="bi bi-x-lg m-0"></i>
                                    </div>
                                    <div class="col-1 fw-bold d-flex justify-content-center align-items-center text-center">
                                       ' . $confronto['gols_equipe_visitante'] . '
                                    </div>
                                    <div class="col-4 d-flex justify-content-center align-items-center text-center fw-light">
                                         ' . $nomeEquipeVisitante . '
                                    </div>
                                </div>
                            </div>
                            <p class="text-center mt-3" style="' . $styleResultado . ' font-size: 0.9rem;"><strong>' . $resultadoConfronto . '</strong></p>
                            <p class="text-start mt-3 mb-0" style="font-size: 0.7rem;"><i class="bi bi-dot"></i>' . $confronto['equipe_mandante']->nome_equipe . '</p>
                            <p class="text-start" style="font-size: 0.7rem;"><i class="bi bi-dot"></i>' . $confronto['equipe_visitante']->nome_equipe . '</p>
                            </li>';



            //     $list .= '<li class="list-group-item">
            // <p class="text-center mt-3"> ' . $confronto['logradouro'] . ' ' . $confronto['cidade'] . ' ' . $confronto['estado'] . ' <strong>' . $confronto['data_partida'] . ' as ' . $confronto['hora_partida'] . '</strong> </p>

            // <div class="justify-content-evenly w-100">
            // <div class="row">
            // <div class="col-4 text-center">
            // ' . ($confronto['equipe_mandante']->nome_equipe ?? "") . '
            // </div>
            // <div class="col-1 fw-bold d-flex justify-content-center align-items-center text-center">
            // ' . $confronto['gols_equipe_mandante'] . '
            // </div>
            // <div class="col-2 d-flex justify-content-center align-items-center text-center">
            // <i class="bi bi-x-lg m-0"></i>
            // </div>
            // <div class="col-1 fw-bold d-flex justify-content-center align-items-center text-center">
            // ' . $confronto['gols_equipe_visitante'] . '
            // </div>
            // <div class="col-4 text-center">
            // ' . ($confronto['equipe_visitante']->nome_equipe ?? "") . '
            // </div>
            // </div>
            // </div>

            // <p class="text-center text-success mt-3"><strong>' . $confronto['resultadoPartida'] . '</strong></p>
            // </li>';
        }

        if (empty($list)) {
            $list = "Nenhum confronto encontrado.";
        }

        return $list;
    }


    public static function listarConfrontosDashboard()
    {

        $confronto = new Confronto([]);
        $confrontos = $confronto->getConfrontos();

        $list = "";
        foreach ($confrontos as $key => $confronto) {
            # code...

            $list .=   '<tr class="row-success">
                    <td>' . $confronto['id'] . '</td>
                    <td>' . $confronto['equipe_mandante']->nome_equipe . '</td>
                    <td>' . $confronto['gols_equipe_mandante'] . '</td>
                    <td>' . $confronto['equipe_visitante']->nome_equipe . '</td>
                    <td>' . $confronto['gols_equipe_visitante'] . '</td>
                    <td>' . $confronto['resultadoPartida'] . '</td>
                    <td>' . $confronto['logradouro'] . '</td>
                    <td>' . $confronto['cidade'] . '</td>
                    <td>' . $confronto['estado'] . '</td>
                    <td>' . $confronto['data_partida'] . '</td>
                    <td>' . $confronto['hora_partida'] . '</td>
                    <td class="text-end">
                    <a role="button" href="' . BASE_URL . '/edicao-de-confronto?id=' . $confronto['id'] . '" class="btn btn-sm btn-outline-success btn-edit"><i class="bi bi-pencil"></i> Editar</a>
                    </td>
                    </tr>';
        }

        if (empty($list)) {
            $list = '<tr><td colspan="8" class="text-center">Nenhum confronto encontrado.</td></tr>';
        }

        return $list;
    }


    public function getConfrontoById($id)
    {
        // Lógica para editar um confronto
        $confrontoModel = new Confronto([]);
        return $confrontoModel->getConfrontoById($id);
    }

    /**
     * Gera options numéricos de 0 a 10.
     *
     * @param int|null $selected Valor que deve ficar selecionado (0–10). Opcional.
     * @return string HTML das options
     */
    public static function gerarOptionsZeroADez(int $selected = null): string
    {
        $html = "";

        for ($i = 0; $i <= 10; $i++) {
            $isSelected = ($selected !== null && $selected == $i) ? " selected" : "";
            $html .= "<option value=\"{$i}\"{$isSelected}>{$i}</option>\n";
        }

        return $html;
    }

    /**
     * Gera opções de resultado de partida.
     *
     * @param string|null $selected Valor que deve ficar selecionado. Opcional.
     * @return string HTML das options
     */
    public static function gerarOptionsResultado(?string $selected = null): string
    {
        $opcoes = [
            "Aguardando" => "Aguardando",
            "Empate"     => "Empate",
            "mandante"   => "Mandante",
            "visitante"  => "Visitante",
        ];

        $html = "";

        foreach ($opcoes as $valor => $label) {
            $isSelected = ($selected !== null && $selected === $valor) ? " selected" : "";
            $html .= "<option value=\"{$valor}\"{$isSelected}>{$label}</option>\n";
        }

        return $html;
    }

    /**
     * Gera options de estados brasileiros.
     *
     * @param string|null $selected Sigla do estado que deve ficar selecionado. Opcional.
     * @return string HTML das options
     */
    public static function gerarOptionsEstados(?string $selected = null): string
    {
        $estados = [
            ""  => "Selecione",
            "AC" => "Acre",
            "AL" => "Alagoas",
            "AP" => "Amapá",
            "AM" => "Amazonas",
            "BA" => "Bahia",
            "CE" => "Ceará",
            "DF" => "Distrito Federal",
            "ES" => "Espírito Santo",
            "GO" => "Goiás",
            "MA" => "Maranhão",
            "MT" => "Mato Grosso",
            "MS" => "Mato Grosso do Sul",
            "MG" => "Minas Gerais",
            "PA" => "Pará",
            "PB" => "Paraíba",
            "PR" => "Paraná",
            "PE" => "Pernambuco",
            "PI" => "Piauí",
            "RJ" => "Rio de Janeiro",
            "RN" => "Rio Grande do Norte",
            "RS" => "Rio Grande do Sul",
            "RO" => "Rondônia",
            "RR" => "Roraima",
            "SC" => "Santa Catarina",
            "SP" => "São Paulo",
            "SE" => "Sergipe",
            "TO" => "Tocantins"
        ];

        $html = "";

        foreach ($estados as $sigla => $nome) {
            $isSelected = ($selected !== null && $selected === $sigla) ? " selected" : "";
            $html .= "<option value=\"{$sigla}\"{$isSelected}>{$nome}</option>\n";
        }

        return $html;
    }




    public function atualizar()
    {
        // Dados vindos do formulário
        $data = $_POST; // ou $_REQUEST

        // Validação simples
        if (empty($data['id_confronto'])) {
            // die("ID do confronto não informado.");
            \header("Location: " . BASE_URL . "/erro-no-cadastro-de-confronto");
            exit;
        }

        // Busca o confronto existente
        $confrontoModel = new Confronto();
        $confrontoExistente = $confrontoModel->getConfrontoById($data['id_confronto']);

        if (!$confrontoExistente) {
            // die("Confronto não encontrado.");
            \header("Location: " . BASE_URL . "/erro-no-cadastro-de-confronto");
            exit;
        }

        // Cria um novo objeto Confronto com os dados do formulário
        $confronto = new Confronto($data);

        // Define o ID para atualizar
        $confronto->id = (int) $data['id_confronto'];

        // Chama a função de atualização
        if ($confronto->update()) {
            \header("Location: " . BASE_URL . "/sucesso-no-cadastro-de-confronto");
            exit;
        } else {
            \header("Location: " . BASE_URL . "/erro-no-cadastro-de-confronto");
            exit;
        }
    }
}
