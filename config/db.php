<?php

    $host = 'localhost';
    $db   = 'aucres';
    $user = 'root';

    try {

        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {

        die("Database connection failed: " . $e->getMessage());

    }

?>