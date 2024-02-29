<?php

namespace App\Models;

use App\Database\Database;
use PDO;
use PDOException;

class Address 
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
        $andCity = isset($params['city_id']) ? " AND city_id = :city_id" : "";
        $andStreet = isset($params['street']) ? " AND street = :street" : "";
        $andNumber = isset($params['number']) ? " AND number = :number" : "";
        $andZipCode = isset($params['zip_code']) ? " AND zip_code = :zip_code" : "";
        
        $bindParams = [];
        if (isset($params['id'])) {
            $bindParams['id'] = $params['id'];
        }
        if (isset($params['city_id'])) {
            $bindParams['city_id'] = $params['city_id'];
        }
        if (isset($params['street'])) {
            $bindParams['street'] = $params['street'];
        }
        if (isset($params['number'])) {
            $bindParams['number'] = $params['number'];
        }
        if (isset($params['zip_code'])) {
            $bindParams['zip_code'] = $params['zip_code'];
        }
        
        try {
            $sql = "SELECT * FROM addresses WHERE 1 = 1 " . $andId . $andCity . $andStreet . $andNumber . $andZipCode;
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
            $stmt = $this->db->getConnection()->prepare("
                INSERT INTO addresses (user_id, city_id, street, `number`, zip_code) 
                VALUES (:user_id, :city_id, :street, :number, :zip_code)"
            );

            $stmt->bindParam(':user_id', $params['user_id']);
            $stmt->bindParam(':city_id', $params['city_id']);
            $stmt->bindParam(':street', $params['street']);
            $stmt->bindParam(':number', $params['number']);
            $stmt->bindParam(':zip_code', $params['zip_code']);
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
            $stmt = $this->db->getConnection()->prepare("
                UPDATE addresses 
                SET user_id = :user_id, city_id = :city_id, street = :street, number = :number, zip_code = :zip_code WHERE id = :id"
            );

            $stmt->bindParam(':id', $params['id']);
            $stmt->bindParam(':user_id', $params['user_id']);
            $stmt->bindParam(':city_id', $params['city_id']);
            $stmt->bindParam(':street', $params['street']);
            $stmt->bindParam(':number', $params['number']);
            $stmt->bindParam(':zip_code', $params['zip_code']);
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
            $stmt = $this->db->getConnection()->prepare("DELETE FROM addresses WHERE id = :id");
            $stmt->bindParam(':id', $params['id']);
            $stmt->execute();
            
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
