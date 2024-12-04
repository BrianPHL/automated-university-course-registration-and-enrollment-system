<?php

    if (!isset($_SESSION)) { session_start(); }

    $user = (isset($_SESSION['user']) ? $_SESSION['user'] : null);
    $role = (isset($_GET['portal'])) ? $_GET['portal'] : null;
    $page = (isset($_GET['page'])) ? $_GET['page'] : null; 

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

    error_log("HTTP 400 in public/dashboard.php");
    http_response_code(400);
    header("Location: https://localhost/aucres/public/error.php?code=400");
    session_write_close();
    exit();

?>