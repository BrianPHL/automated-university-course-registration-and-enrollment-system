<?php

    if (!isset($_SESSION)) {
        session_start();
    }

    $dashboard = $_GET['dashboard'] ?? null;
    $whitelist = ['admin', 'faculty', 'student'];

    if (!in_array($dashboard, $whitelist))
    {
        require_once __DIR__ . '/../src/views/404.view.php';
        exit();
    }

    $_SESSION['dashboard_type'] = $dashboard;
    
    switch ($dashboard)
    {
        case 'admin';
            require_once __DIR__ . '/../src/views/auth/admin/login.view.php';
            break;

        case 'faculty';
            require_once __DIR__ . '/../src/views/auth/faculty/login.view.php';
            break;

        case 'student';
            require_once __DIR__ . '/../src/views/auth/student/dashboard.view.php';
            break;            

    }

?>