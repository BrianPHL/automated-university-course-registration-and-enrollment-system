<?php

    if (!isset($_SESSION)) { session_start(); }

    $whitelist = ['admin', 'faculty', 'student'];
    $portal = (isset($_GET['portal'])) ? $_GET['portal'] : null;
    $user = (isset($_SESSION['user'])) ? $_SESSION['user'] : null;

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        if (isset($_GET['action']) && $_GET['action'] === 'switch') {

            header('Location: https://localhost/aucres/public/portals.php');
            session_write_close();
            exit();
    
        }

        if (empty($portal)) {

            header("Location: https://localhost/aucres/public/portals.php");
            session_write_close();
            exit();
    
        }
    
        if (!in_array($portal, $whitelist)) {
    
            require_once __DIR__ . '/../src/404.view.php';
            session_write_close();
            exit();
    
        }
    
        if (isset($user)) {
    
            header("Location: https://localhost/aucres/public/dashboard.php?portal=" . $user['role']);
            session_write_close();
            exit();
    
        }


        switch($portal) {

            case 'student':
    
                if ($_GET['type'] === 'login') {
    
                    require_once __DIR__ . '/../src/auth/student/login.view.php';
                    session_write_close();
                    exit(); 
    
                } else {
    
                    require_once __DIR__ . '/../src/auth/student/registration.view.php';
                    session_write_close();
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

    }

?>