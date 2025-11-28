<?php

namespace App\Controllers;

// --- Contorno do Autoloader: Incluindo dependências manualmente ---
// Garante que o Modelo Confronto e a Conexão Database estejam carregados.
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

            $list .= '<li class="list-group-item">
        <p class="text-center mt-3"> ' . $confronto['logradouro'] . ' ' . $confronto['cidade'] . ' ' . $confronto['estado'] . ' <strong>' . $confronto['data_partida'] . ' as ' . $confronto['hora_partida'] . '</strong> </p>

        <div class="justify-content-evenly w-100">
        <div class="row">
        <div class="col-4 text-center">
        ' . ($confronto['equipe_mandante']->nome_equipe ?? "") . '
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
        <div class="col-4 text-center">
        ' . ($confronto['equipe_visitante']->nome_equipe ?? "") . '
        </div>
        </div>
        </div>

        <p class="text-center text-success mt-3"><strong>' . $confronto['resultadoPartida'] . '</strong></p>
        </li>';
        }

        if (empty($list)) {
            $list = "Nenhum confronto encontrado.";
        }

        return $list;
    }
}
