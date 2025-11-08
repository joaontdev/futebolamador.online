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
    public ?int $id = null;
    public int $equipeMandanteId; // Chave estrangeira
    public int $equipeVisitanteId; // Chave estrangeira
    public string $tipoConfronto;
    public string $dataConfronto; // Formato YYYY-MM-DD
    public string $horaConfronto; // Formato HH:MM:SS
    public string $statusConfronto;
    public string $logradouroConfronto;
    public string $cidadeConfronto;
    public string $estadoConfronto;
    public int $golsMandante = 0;
    public int $golsVisitante = 0;

    // Colunas de controle
    public int $isDeleted = 0;

    /**
     * Construtor do Confronto.
     * @param array $data Dados para preencher o objeto.
     */
    public function __construct(array $data = [])
    {
        if (!empty($data)) {
            $this->equipeMandanteId = (int) ($data['equipeMandante'] ?? 0);
            $this->equipeVisitanteId = (int) ($data['equipeVisitante'] ?? 0);
            $this->tipoConfronto = $data['tipoConfronto'] ?? '';
            $this->dataConfronto = $data['dataConfronto'] ?? '';
            $this->horaConfronto = $data['horaConfronto'] ?? '';
            $this->statusConfronto = $data['statusConfronto'] ?? 'Agendado'; // Default status
            $this->logradouroConfronto = $data['logradouroConfronto'] ?? '';
            $this->cidadeConfronto = $data['cidadeConfronto'] ?? '';
            $this->estadoConfronto = $data['estadoConfronto'] ?? '';
            $this->golsMandante = (int) ($data['golsMandante'] ?? 0);
            $this->golsVisitante = (int) ($data['golsVisitante'] ?? 0);
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
                    equipe_mandante_id, equipe_visitante_id, tipo_confronto, 
                    data_confronto, hora_confronto, status_confronto, 
                    logradouro_confronto, cidade_confronto, estado_confronto, 
                    gols_mandante, gols_visitante, is_deleted, created_at, updated_at
                ) VALUES (
                    :mandante_id, :visitante_id, :tipo, 
                    :data, :hora, :status, 
                    :logradouro, :cidade, :estado, 
                    :gols_m, :gols_v, :is_deleted, NOW(), NOW()
                )";

        try {
            $stmt = $pdo->prepare($sql);

            // Vincula os valores
            $stmt->bindValue(':mandante_id', $this->equipeMandanteId, PDO::PARAM_INT);
            $stmt->bindValue(':visitante_id', $this->equipeVisitanteId, PDO::PARAM_INT);
            $stmt->bindValue(':tipo', $this->tipoConfronto, PDO::PARAM_STR);
            $stmt->bindValue(':data', $this->dataConfronto, PDO::PARAM_STR);
            $stmt->bindValue(':hora', $this->horaConfronto, PDO::PARAM_STR);
            $stmt->bindValue(':status', $this->statusConfronto, PDO::PARAM_STR);
            $stmt->bindValue(':logradouro', $this->logradouroConfronto, PDO::PARAM_STR);
            $stmt->bindValue(':cidade', $this->cidadeConfronto, PDO::PARAM_STR);
            $stmt->bindValue(':estado', $this->estadoConfronto, PDO::PARAM_STR);
            $stmt->bindValue(':gols_m', $this->golsMandante, PDO::PARAM_INT);
            $stmt->bindValue(':gols_v', $this->golsVisitante, PDO::PARAM_INT);
            $stmt->bindValue(':is_deleted', $this->isDeleted, PDO::PARAM_INT);

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
}
