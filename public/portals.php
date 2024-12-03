<?php

    if (!isset($_SESSION)) { session_start(); }

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        $user = (isset($_SESSION['user'])) ? $_SESSION['user'] : null;

        if (empty($user)) {

            require_once __DIR__ . '/../src/portals.view.html';
            session_write_close();
            exit();
            
        } else {

            header("Location: https://localhost/aucres/public/dashboard.php?portal=" . $user['role']);
            session_write_close();
            exit();

        }

    }

    error_log("HTTP 400 in public/portals.php");
    http_response_code(400);
    header("Location: https://localhost/aucres/public/error.php?code=400");
    session_write_close();
    exit();

?>