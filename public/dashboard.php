<?php

    if (!isset($_SESSION)) { session_start(); }

    $user = (isset($_SESSION['user']) ? $_SESSION['user'] : null);
    $role = (isset($user)) ? $user['role'] : null;
    $page = (isset($_GET['page'])) ? $_GET['page'] : null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (empty($user)) {
    
            http_response_code(403);
            header("Location: https://localhost/aucres/src/error.view.php?code=403");
            session_write_close();
            exit();
    
        } else {
        
            require_once __DIR__ . "/../src/dashboard/{$role}.view.php";
            session_write_close();
            exit();
        
        }

    }

    http_response_code(400);
    header("Location: https://localhost/aucres/src/error.view.php?code=400");
    session_write_close();
    exit();

?>