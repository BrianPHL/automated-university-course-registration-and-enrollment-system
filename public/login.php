<?php

    require_once __DIR__ . '/../src/controllers/AuthController.php';

    use App\Controllers\AuthController;
    
    if (!isset($_SESSION)) {
        session_start();
    }

    $controller = new AuthController();

    $portal = $_GET['portal'] ?? 'student';
    
    $portalType = ($portal === 'student') ? $_GET['type'] : null;

    $whitelist = ['admin', 'faculty', 'student'];

    if (!in_array($portal, $whitelist))
    {
        $controller->display404();
        exit();
    }

    if (!isset($_GET['portal'])) {
        header("Location: /login.php?portal=student");
        exit();
    }

    $_SESSION['portal_type'] = $portal;
    
    switch ($portal)
    {
        case 'admin';
            $controller->displayAdminLogin();
            break;

        case 'faculty';
            $controller->displayFacultyLogin();
            break;

        case 'student';
            (isset($portalType) && $portalType === 'login')
                ? $controller->displayStudentLogin()
                : $controller->displayStudentRegistration();
            break;
    }

?>