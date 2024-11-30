<?php

    if (!isset($_SESSION)) { session_start(); }

    $user = (isset($_SESSION['user']) ? $_SESSION['user'] : null);
    $role = (isset($user)) ? $user['role'] : null;
    $page = (isset($_GET['page'])) ? $_GET['page'] : null;

    function getEntriesCount($conn, $table, $role) {

        $stmt = $conn->prepare("SELECT COUNT(*) AS total_entries FROM $table WHERE role = :role");
        $stmt->bindParam(":role", $role);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $count = $result['total_entries'];

        return $count;

    }

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        if (empty($user)) {
    
            http_response_code(401);
            header("Location: https://localhost/aucres/public/error.php?code=401");
            session_write_close();
            exit();
    
        } else {
        
            require_once __DIR__ . "/../src/dashboard/{$role}.view.php";
            session_write_close();
            exit();
        
        }

    }

    http_response_code(400);
    header("Location: https://localhost/aucres/public/error.php?code=400");
    session_write_close();
    exit();

?>