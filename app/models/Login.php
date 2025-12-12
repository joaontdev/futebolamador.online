<?php

namespace App\Models;

use App\Core\Database;
use PDO;
use PDOException;

/**
 * Entidade (Model) para a tabela 'usuarios'.
 * Responsável por gerenciar as operações de persistência de dados.
 */
class Usuario
{
    // Propriedades que mapeiam as colunas da tabela
    public ?int $id = null;
    public string $nomeUsuario;
    public string $senha;
    public string $status = 'ativo'; // ativo | inativo

    // Datas do banco
    public ?string $dataCriacao = null;
    public ?string $dataAtualizacao = null;

    /**
     * Construtor do Usuário
     * @param array $data Dados para preencher o objeto.
     */
    public function __construct(array $data = [])
    {
        if (!empty($data)) {
            $this->nomeUsuario = $data['nomeUsuario'] ?? '';
            $this->senha = $data['senha'] ?? '';
            $this->status = $data['status'] ?? 'ativo';
        }
    }

    /**
     * Insere o registro na tabela usuarios.
     * @return bool
     */
    public function insert(): bool
    {
        $pdo = Database::getConnection();

        $sql = "INSERT INTO usuarios (
                    nome_usuario, senha, status, data_criacao, data_atualizacao
                ) VALUES (
                    :nome_usuario, :senha, :status, NOW(), NOW()
                )";

        try {
            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(':nome_usuario', $this->nomeUsuario, PDO::PARAM_STR);
            $stmt->bindValue(':senha', $this->senha, PDO::PARAM_STR);
            $stmt->bindValue(':status', $this->status, PDO::PARAM_STR);

            $success = $stmt->execute();

            if ($success) {
                $this->id = (int) $pdo->lastInsertId();
            }

            return $success;
        } catch (PDOException $e) {
            error_log("Erro ao inserir usuário: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Retorna todos os usuários cadastrados.
     * @return array
     */
    public function getUsuarios(): array
    {
        $pdo = Database::getConnection();
        $usuarios = [];

        $sql = "SELECT * FROM usuarios";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        while ($u = $stmt->fetchObject()) {
            $usuarios[] = [
                'id' => $u->id,
                'nomeUsuario' => $u->nome_usuario,
                'status' => $u->status,
                'dataCriacao' => $u->data_criacao,
                'dataAtualizacao' => $u->data_atualizacao
            ];
        }

        return $usuarios;
    }

    /**
     * Retorna um único usuário por ID.
     * @param int $id
     * @return mixed
     */
    public function getById(int $id)
    {
        $pdo = Database::getConnection();

        $sql = "SELECT * FROM usuarios WHERE id = :id LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchObject();
    }


    public function autenticar($nomeUsuario, $senha)
    {

        if (empty($nomeUsuario) || empty($senha)) {
            return ['success' => false, 'message' => 'Informe usuário e senha'];
        }

        // Conexão
        $pdo = Database::getConnection();

        // Busca o usuário pelo nome
        $sql = "SELECT * FROM usuarios WHERE nome_usuario = :nome_usuario LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':nome_usuario', $nomeUsuario, PDO::PARAM_STR);
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_OBJ);

        // Verifica se existe
        if (!$usuario) {
            return ['success' => false, 'message' => 'Usuário não encontrado'];
        }


        // Verifica a senha (hash)
        if (!password_verify($senha, $usuario->senha)) {
            return ['success' => false, 'message' => 'Senha incorreta'];
        }

        // Login bem sucedido
        return [
            'success' => true,
            'message' => 'Autenticação realizada com sucesso',
            'usuario' => [
                'id' => $usuario->id,
                'nomeUsuario' => $usuario->nome_usuario,
                'status' => $usuario->status,
            ]
        ];
    }
}
