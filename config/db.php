<?php

    function connect() {

        static $conn = null;

        if ($conn === null) {

            $host = 'localhost';
            $db   = 'aucres';
            $name = 'root';

            try {
    
                $conn = new PDO("mysql:host=$host;dbname=$db", $name);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            } catch (PDOException $e) {
    
                echo "Database connection failed! Error: " . $e->getMessage();
    
            }
    
        }

        return $conn;

    }

?>