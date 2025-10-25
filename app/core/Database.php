<?php

namespace App\Core;

use PDO;
use PDOException;

/**
 * Classe responsável pela conexão com o banco de dados.
 * Utiliza o padrão PDO para conexões seguras e flexíveis.
 */
class Database
{
    // --- Credenciais de Conexão ---
    // ATENÇÃO: Substitua estes valores pelos seus dados reais!
    private const DB_HOST = DB_HOST;
    private const DB_NAME = DB_NAME; // Nome sugerido anteriormente
    private const DB_USER = DB_USER;
    private const DB_PASS = DB_PASS;

    // Variável estática para armazenar a instância da conexão PDO
    private static ?PDO $connection = null;

    /**
     * Obtém uma instância da conexão PDO. 
     * Retorna a conexão existente ou cria uma nova se ainda não existir.
     * * @return PDO A instância da conexão com o banco de dados.
     * @throws PDOException Se a conexão falhar.
     */
    public static function getConnection(): PDO
    {
        // Verifica se a conexão já foi estabelecida
        if (self::$connection === null) {
            // Data Source Name (DSN) para conexão MySQL
            $dsn = 'mysql:host=' . self::DB_HOST . ';dbname=' . self::DB_NAME . ';charset=utf8mb4';

            // Opções de configuração do PDO
            $options = [
                // Configura o PDO para lançar exceções em caso de erro SQL
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                // Define o modo de busca padrão para retornar arrays associativos
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                // Desabilita a emulação de prepared statements para segurança
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            try {
                // Tenta criar a conexão
                self::$connection = new PDO($dsn, self::DB_USER, self::DB_PASS, $options);
            } catch (PDOException $e) {
                // Em caso de falha, encerra a execução e mostra uma mensagem de erro
                // Em produção, você deve logar o erro em vez de exibi-lo.
                die("Erro de Conexão com o Banco de Dados: " . $e->getMessage());
            }
        }

        return self::$connection;
    }

    /**
     * Impede a instanciação direta desta classe (deve ser usada estaticamente).
     */
    private function __construct() {}

    /**
     * Impede a clonagem da instância de conexão.
     */
    private function __clone() {}
}
