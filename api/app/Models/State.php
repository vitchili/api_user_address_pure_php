<?php

namespace App\Models;

use App\Database\Database;
use PDO;
use PDOException;

class State 
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
        
        $bindParams = [];
        if (isset($params['id'])) {
            $bindParams['id'] = $params['id'];
        }
        
        try {
            $sql = "SELECT id, name FROM states WHERE 1 = 1 " . $andId;
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->execute($bindParams);
        
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return false;
        }
    }

}
