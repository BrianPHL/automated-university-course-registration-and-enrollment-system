<?php

    namespace App\Config;

    use PDO;
    use PDOException;

    class Database {

        private $host = 'localhost';
        private $db   = 'aucres';
        private $name = 'root';
        private $conn;

        public function connect() {
            $this->conn = null;

            try {

                $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db", $this->name);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch (PDOException $e) {
                
                echo "Database connection failed! Error: " . $e->getMessage();
            
            }

            return $this->conn;

        }

    }

?>