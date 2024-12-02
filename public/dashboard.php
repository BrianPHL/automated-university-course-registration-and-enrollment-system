<?php

    if (!isset($_SESSION)) { session_start(); }

    $user = (isset($_SESSION['user']) ? $_SESSION['user'] : null);
    $role = (isset($_GET['portal'])) ? $_GET['portal'] : null;
    $page = (isset($_GET['page'])) ? $_GET['page'] : null;

    function getEntriesCount($pConn, $pTable, $pRole = null) {

        $conn = (isset($pConn)) ? $pConn : null;
        $table = (isset($pTable)) ? $pTable : null;
        $role = (isset($pRole)) ? $pRole : null;
        $sql;

        if (empty($conn) || empty($table)) return;

        $sql = (isset($role)) ? "SELECT COUNT(*) AS total_entries FROM $pTable WHERE role = :role" : "SELECT COUNT(*) AS total_entries FROM $pTable";

        $stmt = $conn->prepare($sql);
        if (isset($role)) $stmt->bindParam(":role", $pRole);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $count = $result['total_entries'];

        return $count;

    }

    function getAccountsData($pConn, $pRole = null) {

        $conn = (isset($pConn)) ? $pConn : null;
        $role = (isset($pRole)) ? $pRole : null;
        $sql;

        if (empty($conn)) return;
        
        $sql = (empty($role)) ? "SELECT * FROM accounts" : "SELECT * FROM accounts WHERE role = :role";
        
        $stmt = $pConn->prepare($sql);
        if (isset($role)) { $stmt->bindParam(":role", $role); }
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;

    }

    function getStudentsData($pConn, $pStatus = null) {

        $conn = (isset($pConn)) ? $pConn : null;
        $status = (isset($pStatus)) ? $pRole : null;
        $sql;

        if (empty($conn)) return;
        
        $sql = (empty($status)) ? "SELECT * FROM students" : "SELECT * FROM students WHERE status = :status";
        
        $stmt = $pConn->prepare($sql);
        if (isset($role)) { $stmt->bindParam(":status", $status); }
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