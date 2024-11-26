<?php

    if (!isset($_SESSION)) { session_start(); }

    $user = (isset($_SESSION['user']) ? $_SESSION['user'] : null);
    $role = $user['role'];

    if (empty($user)) {
    
        http_response_code(403);
        exit();

    } else {
    
        require_once __DIR__ . "/../src/dashboard/{$role}.view.php";
        session_write_close();
        exit();
    
    }

?>