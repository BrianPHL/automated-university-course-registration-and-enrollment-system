<?php

    if (!isset($_SESSION)) { session_start(); }

    $user = (isset($_SESSION['user']) ? $_SESSION['user'] : null);
    $role = (isset($_GET['portal'])) ? $_GET['portal'] : null;
    $page = (isset($_GET['page'])) ? $_GET['page'] : null;

    function getEntriesCount($pConn, $pTable, $pRole) {

        $stmt = $pConn->prepare("SELECT COUNT(*) AS total_entries FROM $pTable WHERE role = :role");
        $stmt->bindParam(":role", $pRole);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $count = $result['total_entries'];

        return $count;

    }

    function getTableData($pConn, $pTable, $pRole = null) {

        $sql = (empty($pRole)) ? "SELECT * FROM $pTable" : "SELECT * FROM $pTable WHERE role = $pRole";

        $stmt = $pConn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;

    }

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        if (empty($user)) {
    
            http_response_code(401);
            header("Location: https://localhost/aucres/public/error.php?code=401");
        
        } else {

            require_once __DIR__ . "/../src/dashboard/{$role}.view.php";
        
        }

        session_write_close();
        exit();

    }

    http_response_code(400);
    header("Location: https://localhost/aucres/public/error.php?code=400");
    session_write_close();
    exit();

?>