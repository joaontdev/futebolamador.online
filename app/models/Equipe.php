<?php

namespace App\Models;

use App\Core\Database;
use PDO;
use PDOException;

/**
 * Entidade (Model) para a tabela 'equipes'.
 * Responsável por gerenciar as operações de persistência de dados.
 */
class Equipe
{
    // Propriedades que mapeiam as colunas do banco de dados (usando camelCase em PHP)
    public ?int $id = null;
    public string $nomeEquipe;
    public string $logradouro;
    public string $cidade;
    public string $estado;
    public int $anoFundacao;
    public string $nomeComandante;
    public string $escudo;


    // Colunas de controle de banco de dados
    public int $status = 1;      // 1 = Ativo, 0 = Inativo (Exemplo)
    public int $isDeleted = 0;   // 0 = Não deletado, 1 = Deletado (Soft Delete)
    // As datas serão definidas na hora da inserção/atualização

    /**
     * Construtor da Equipe (opcional, mas útil para inicialização de dados).
     * @param array $data Dados para preencher o objeto.
     */
    public function __construct(array $data = [])
    {

        // Preenche as propriedades do objeto com os dados fornecidos
        if (!empty($data)) {
            $this->nomeEquipe = $data['nomeEquipe'] ?? '';
            $this->logradouro = $data['logradouro'] ?? '';
            $this->cidade = $data['cidade'] ?? '';
            $this->estado = $data['estado'] ?? '';
            $this->anoFundacao = $data['anoFundacao'] ?? 0;
            $this->nomeComandante = $data['nomeComandante'] ?? '';
            $this->escudo = $data['escudo'] ?? '';
            $this->status = $data['status'] ?? 1;
        }
    }

    /**
     * Insere o registro da equipe no banco de dados.
     * @return bool True em caso de sucesso, false em caso de falha.
     */
    public function insert(): bool
    {
        $pdo = Database::getConnection();

        $sql = "INSERT INTO equipes (
                    nome_equipe, logradouro, cidade, estado, ano_fundacao, 
                    nome_comandante, escudo, status, is_deleted, created_at, updated_at
                ) VALUES (
                    :nome_equipe, :logradouro, :cidade, :estado, :ano_fundacao, 
                    :nome_comandante, :escudo, :status, :is_deleted, NOW(), NOW()
                )";

        try {
            $stmt = $pdo->prepare($sql);

            // Vincula os valores às variáveis da consulta preparada
            $stmt->bindValue(':nome_equipe', $this->nomeEquipe, PDO::PARAM_STR);
            $stmt->bindValue(':logradouro', $this->logradouro, PDO::PARAM_STR);
            $stmt->bindValue(':cidade', $this->cidade, PDO::PARAM_STR);
            $stmt->bindValue(':estado', $this->estado, PDO::PARAM_STR);
            $stmt->bindValue(':ano_fundacao', $this->anoFundacao, PDO::PARAM_INT);
            $stmt->bindValue(':nome_comandante', $this->nomeComandante, PDO::PARAM_STR);
            $stmt->bindValue(':escudo', $this->escudo, PDO::PARAM_STR);

            // Colunas de controle
            $stmt->bindValue(':status', $this->status, PDO::PARAM_INT);
            $stmt->bindValue(':is_deleted', $this->isDeleted, PDO::PARAM_INT);

            // Executa a inserção
            $success = $stmt->execute();

            // Se a inserção foi bem-sucedida, armazena o ID gerado
            if ($success) {
                $this->id = (int) $pdo->lastInsertId();
            }

            return $success;
        } catch (PDOException $e) {
            // Em ambiente de desenvolvimento, logue o erro
            error_log("Erro de inserção da Equipe: " . $e->getMessage());
            // Em ambiente de produção, apenas retorne falso
            return false;
        }
    }


    public function getEquipes(): array
    {
        $pdo = Database::getConnection();
        $equipes = [];


        $sql = "SELECT * FROM equipes";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        while ($equipe = $stmt->fetchObject()) {

            $equipes[] = [
                'id' => $equipe->id,
                'nomeEquipe' => $equipe->nome_equipe,
                'logradouro' => $equipe->logradouro,
                'cidade' => $equipe->cidade,
                'estado' => $equipe->estado,
                'anoFundacao' => $equipe->ano_fundacao,
                'nomeComandante' => $equipe->nome_comandante,
                'status' => $equipe->status,
                'isDeleted' => $equipe->is_deleted,
                'createdAt' => $equipe->created_at,
                'updatedAt' => $equipe->updated_at,
                'escudo' => $equipe->escudo,
            ];
        }

        return $equipes;
    }

    public function getEquipeById($id)
    {
        $pdo = Database::getConnection();

        $sql = "SELECT * FROM equipes WHERE id = " . $id;
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchObject();
    }

    /**
     * Atualiza o registro da equipe no banco de dados.
     * @return bool True em caso de sucesso, false em caso de falha.
     */
    public function update(): bool
    {
        // Garante que existe um ID para atualização
        if (empty($this->id)) {
            return false;
        }

        $pdo = Database::getConnection();

        $sql = "UPDATE equipes SET
                nome_equipe      = :nome_equipe,
                logradouro       = :logradouro,
                cidade           = :cidade,
                estado           = :estado,
                ano_fundacao     = :ano_fundacao,
                nome_comandante  = :nome_comandante,
                escudo           = :escudo,
                status           = :status,
                is_deleted       = :is_deleted,
                updated_at       = NOW()
            WHERE id = :id
              AND is_deleted = 0";

        try {
            $stmt = $pdo->prepare($sql);

            // Dados da equipe
            $stmt->bindValue(':nome_equipe', $this->nomeEquipe, PDO::PARAM_STR);
            $stmt->bindValue(':logradouro', $this->logradouro, PDO::PARAM_STR);
            $stmt->bindValue(':cidade', $this->cidade, PDO::PARAM_STR);
            $stmt->bindValue(':estado', $this->estado, PDO::PARAM_STR);
            $stmt->bindValue(':ano_fundacao', $this->anoFundacao, PDO::PARAM_INT);
            $stmt->bindValue(':nome_comandante', $this->nomeComandante, PDO::PARAM_STR);
            $stmt->bindValue(':escudo', $this->escudo, PDO::PARAM_STR);


            // Colunas de controle
            $stmt->bindValue(':status', $this->status, PDO::PARAM_INT);
            $stmt->bindValue(':is_deleted', $this->isDeleted, PDO::PARAM_INT);

            // Identificador
            $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            // Log em ambiente de desenvolvimento
            error_log("Erro de atualização da Equipe (ID {$this->id}): " . $e->getMessage());
            return false;
        }
    }
}
