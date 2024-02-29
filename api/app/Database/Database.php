<?php
namespace App\Database;

use PDO;
use PDOException;

class Database {

    private string $host = 'mysql-db';
    private string $user = 'root';
    private string $password = 'root';
    private string $database = 'mentes-notaveis';
    private PDO $pdo;

    public function __construct() {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->database}";
            $this->pdo = new PDO($dsn, $this->user, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erro na conexão com o banco de dados: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->pdo;
    }

}