<?php

    if (!isset($_SESSION)) { session_start(); }

    $dashboard = $_GET['dashboard'] ?? null;
    $whitelist = ['admin', 'faculty', 'student'];

    if (!in_array($dashboard, $whitelist))
    {
        require_once __DIR__ . '/../src/404.view.php';
        session_write_close();
        exit();
    }

    $_SESSION['dashboard_type'] = $dashboard;
    
    switch ($dashboard)
    {
        case 'admin';
            require_once __DIR__ . '/../src/auth/admin/login.view.php';
            break;

        case 'faculty';
            require_once __DIR__ . '/../src/auth/faculty/login.view.php';
            break;

        case 'student';
            require_once __DIR__ . '/../src/auth/student/dashboard.view.php';
            break;            

    }

?>