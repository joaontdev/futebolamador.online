<?php

namespace App\Models;

use App\Core\Database;
use PDO;
use PDOException;

/**
 * Entidade (Model) para a tabela 'confrontos'.
 * Responsável por gerenciar as operações de persistência de dados dos jogos.
 */
class Confronto
{
    // Propriedades que mapeiam as colunas do banco de dados (em camelCase)
    // public ?int $id = null;
    // public int $equipeMandanteId; // Chave estrangeira
    // public int $equipeVisitanteId; // Chave estrangeira
    // public string $tipoConfronto;
    // public string $dataConfronto; // Formato YYYY-MM-DD
    // public string $horaConfronto; // Formato HH:MM:SS
    // public string $statusConfronto;
    // public string $logradouroConfronto;
    // public string $cidadeConfronto;
    // public string $estadoConfronto;
    // public int $golsMandante = 0;
    // public int $golsVisitante = 0;


    public int $id;
    public int $id_equipe_mandante;
    public int $gols_equipe_mandante;
    public int $id_equipe_visitante;
    public int $gols_equipe_visitante;
    public string $resultadoPartida;
    public string $logradouro;
    public string $cidade;
    public string $estado;
    public string $data_partida;
    public string $hora_partida;


    /**
     * Construtor do Confronto.
     * @param array $data Dados para preencher o objeto.
     */
    public function __construct(array $data = [])
    {
        if (!empty($data)) {
            $this->id_equipe_mandante       = (int) $data['equipeMandante'];
            $this->gols_equipe_mandante     = (int) $data['golsEquipeVitoriosa'];
            $this->id_equipe_visitante      = (int) $data['equipeVisitante'];
            $this->gols_equipe_visitante    = (int) $data['golsEquipePerdedora'];
            $this->resultadoPartida         = $data['equipeVitoriosa'];
            $this->logradouro               = $data['logradouro'];
            $this->cidade                   = $data['cidade'];
            $this->estado                   = $data['estado'];
            $this->data_partida             = $data['dataPartida'];
            $this->hora_partida             = $data['horaPartida'];
        }
    }

    /**
     * Insere o registro do confronto no banco de dados.
     * @return bool True em caso de sucesso, false em caso de falha.
     */
    public function insert(): bool
    {
        // Garante que a classe Database seja carregada (Contorno do Autoloader)
        if (!class_exists('App\Core\Database')) {
            require_once __DIR__ . '/../core/Database.php';
        }

        $pdo = \App\Core\Database::getConnection();

        $sql = "INSERT INTO confrontos (
            id_equipe_mandante, 
            gols_equipe_mandante, 
            id_equipe_visitante, 
            gols_equipe_visitante, 
            resultadoPartida, 
            logradouro, 
            cidade, 
            estado, 
            data_partida, 
            hora_partida
                ) VALUES (
            :id_equipe_mandante, 
            :gols_equipe_mandante, 
            :id_equipe_visitante, 
            :gols_equipe_visitante, 
            :resultadoPartida, 
            :logradouro, 
            :cidade, 
            :estado, 
            :data_partida, 
            :hora_partida
                )";

        try {
            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(':id_equipe_mandante', $this->id_equipe_mandante, PDO::PARAM_INT);
            $stmt->bindValue(':gols_equipe_mandante', $this->gols_equipe_mandante, PDO::PARAM_INT);
            $stmt->bindValue(':id_equipe_visitante', $this->id_equipe_visitante, PDO::PARAM_INT);
            $stmt->bindValue(':gols_equipe_visitante', $this->gols_equipe_visitante, PDO::PARAM_INT);
            $stmt->bindValue(':resultadoPartida', $this->resultadoPartida, PDO::PARAM_STR);
            $stmt->bindValue(':logradouro', $this->logradouro, PDO::PARAM_STR);
            $stmt->bindValue(':cidade', $this->cidade, PDO::PARAM_STR);
            $stmt->bindValue(':estado', $this->estado, PDO::PARAM_STR);
            $stmt->bindValue(':data_partida', $this->data_partida, PDO::PARAM_STR);
            $stmt->bindValue(':hora_partida', $this->hora_partida, PDO::PARAM_STR);

            $success = $stmt->execute();

            if ($success) {
                $this->id = (int) $pdo->lastInsertId();
            }

            return $success;
        } catch (PDOException $e) {
            error_log("Erro de inserção do Confronto: " . $e->getMessage());
            return false;
        }
    }



    public function getConfrontos(): array
    {
        $pdo        =   Database::getConnection();
        $confrontos =   [];

        $sql    =   "SELECT * FROM confrontos ORDER BY id DESC";
        $stmt   =   $pdo->prepare($sql);
        $stmt->execute();

        while ($confronto = $stmt->fetchObject()) {

            $equipeMandante     =   (new Equipe([]))->getById($confronto->id_equipe_mandante);
            $equipeVisitante    =   (new Equipe([]))->getById($confronto->id_equipe_visitante);

            $confrontos[] = [
                'id_equipe_mandante'    =>  $confronto->id_equipe_mandante,
                'gols_equipe_mandante'  =>  $confronto->gols_equipe_mandante,
                'id_equipe_visitante'   =>  $confronto->id_equipe_visitante,
                'gols_equipe_visitante' =>  $confronto->gols_equipe_visitante,
                'resultadoPartida'      =>  $confronto->resultadoPartida,
                'logradouro'            =>  $confronto->logradouro,
                'cidade'                =>  $confronto->cidade,
                'estado'                =>  $confronto->estado,
                'data_partida'          =>  $confronto->data_partida,
                'hora_partida'          =>  $confronto->hora_partida,
                'equipe_mandante'       =>  $equipeMandante,
                'equipe_visitante'      =>  $equipeVisitante,
            ];
        }

        return $confrontos;
    }
}
