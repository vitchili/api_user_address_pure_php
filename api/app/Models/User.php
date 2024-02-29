<?php

namespace App\Models;

use App\Database\Database;
use PDO;
use PDOException;

class User 
{

    public Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    /**
     * @params ...$params
     * 
     * @return array
     */
    public function read($params): mixed
    {
        
        $andId = isset($params['id']) ? " AND id = :id" : "";
        $andAge = isset($params['age']) ? " AND age = :age" : "";
        $andEmail = isset($params['email']) ? " AND email = :email" : "";
        
        $bindParams = [];
        if (isset($params['id'])) {
            $bindParams['id'] = $params['id'];
        }
        if (isset($params['age'])) {
            $bindParams['age'] = $params['age'];
        }
        if (isset($params['email'])) {
            $bindParams['email'] = $params['email'];
        }
        
        try {
            $sql = "SELECT * FROM users 
            JOIN addresses ON users.id = addresses.user_id
            WHERE 1 = 1 " . $andId . $andAge . $andEmail;
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->execute($bindParams);
        
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * @params ...$params
     * 
     * @return array
     */
    public function create(...$params): array
    {
        if (isset($params[0])){
            $params = $params[0];
        }

        try {
            $stmt = $this->db->getConnection()->prepare("INSERT INTO users (`name`, age, email) VALUES (:name, :age, :email)");
            $stmt->bindParam(':name', $params['name']);
            $stmt->bindParam(':age', $params['age']);
            $stmt->bindParam(':email', $params['email']);
            $stmt->execute();
            
            return $this->read($params);
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * @params ...$params
     * 
     * @return array
     */
    public function update(...$params): array
    {
        if (isset($params[0])){
            $params = $params[0];
        }

        try {
            $stmt = $this->db->getConnection()->prepare("UPDATE users SET name = :name, age = :age, email = :email WHERE id = :id");
            $stmt->bindParam(':id', $params['id']);
            $stmt->bindParam(':name', $params['name']);
            $stmt->bindParam(':age', $params['age']);
            $stmt->bindParam(':email', $params['email']);
            $stmt->execute();
            
            return $this->read($params);
        } catch (PDOException $e) {
            return false;
        }
    }
    
    /**
     * @params ...$params
     * 
     * @return bool
     */
    public function delete(...$params): bool
    {
        if (isset($params[0])){
            $params = $params[0];
        }

        try {
            $stmt = $this->db->getConnection()->prepare("DELETE FROM users WHERE id = :id");
            $stmt->bindParam(':id', $params['id']);
            $stmt->execute();
            
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    
}
