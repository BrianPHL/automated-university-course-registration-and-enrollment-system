<?php

    if (!isset($_SESSION)) { session_start(); }

    $portal = $_GET['portal'];
    $whitelist = ['admin', 'faculty', 'student'];

    if (!$portal) {

        header("Location: https://localhost/aucres/public/portals.php");
        exit();

    }

    if (!in_array($portal, $whitelist)) {

        require_once __DIR__ . '/../src/404.view.php';
        exit();

    }

    switch($portal) {

        case 'student':

            if ($_GET['type'] === 'login') {

                require_once __DIR__ . '/../src/auth/student/login.view.php';
                exit(); 

            } else {

                require_once __DIR__ . '/../src/auth/student/registration.view.php';
                exit(); 

            }

            break;

        case 'faculty':

            require_once __DIR__ . '/../src/auth/faculty/login.view.php';
            break;
            
        case 'admin':

            require_once __DIR__ . '/../src/auth/admin/login.view.php';
            break;

        default:

            require_once __DIR__ . '/../src/404.view.php';
            break;
    }


    // require_once __DIR__ . '/../src/controllers/AuthController.php';

    // use App\Controllers\AuthController;
    
    // if (!isset($_SESSION)) {
    //     session_start();
    // }

    // $controller = new AuthController();

    // $portal = $_GET['portal'] ?? 'student';
    
    // $portalType = ($portal === 'student') ? $_GET['type'] : null;

    // $whitelist = ['admin', 'faculty', 'student'];

    // if (!in_array($portal, $whitelist))
    // {
    //     $controller->display404();
    //     exit();
    // }

    // if (!isset($_GET['portal'])) {
    //     header("Location: /login.php?portal=student");
    //     exit();
    // }

    // $_SESSION['portal_type'] = $portal;
    
    // switch ($portal)
    // {
    //     case 'admin';
    //         $controller->displayAdminLogin();
    //         break;

    //     case 'faculty';
    //         $controller->displayFacultyLogin();
    //         break;

    //     case 'student';
    //         (isset($portalType) && $portalType === 'login')
    //             ? $controller->displayStudentLogin()
    //             : $controller->displayStudentRegistration();
    //         break;
    // }

?>