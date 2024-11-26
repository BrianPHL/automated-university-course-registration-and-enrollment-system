<?php

    if (!isset($_SESSION)) { session_start(); }
    
    require_once '../config/db.php'; 
    
    $conn = connect();
    $action = (isset($_GET['action'])) ? $_GET['action'] : null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if ($action === 'logout') {

            $role = (isset($_SESSION['user'])) ? $_SESSION['user']['role'] : null; 

            session_unset();
            session_destroy();

            $location = ($role === 'student')
                ? "https://localhost/aucres/public/login.php?portal=student&type=login"
                : "https://localhost/aucres/public/login.php?portal={$role}";
            header("Location: $location");  
            exit();      

        }

    }

    http_response_code(400);
    error_log('Invalid request made to api/dashboard.php');

?>