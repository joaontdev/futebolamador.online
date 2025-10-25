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
                    nome_comandante, status, is_deleted, created_at, updated_at
                ) VALUES (
                    :nome_equipe, :logradouro, :cidade, :estado, :ano_fundacao, 
                    :nome_comandante, :status, :is_deleted, NOW(), NOW()
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
}
