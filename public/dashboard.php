<?php

    if (!isset($_SESSION)) { session_start(); }

    $user = (isset($_SESSION['user']) ? $_SESSION['user'] : null);
    $role = (isset($user)) ? $user['role'] : null;

    if (empty($user)) {
    
        http_response_code(403);
        exit();

    } else {
    
        require_once __DIR__ . "/../src/dashboard/{$role}.view.php";
        session_write_close();
        exit();
    
    }

?>