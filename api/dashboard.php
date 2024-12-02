<?php

    if (!isset($_SESSION)) { session_start(); }
    
    require_once '../config/db.php'; 
    
    $conn = connect();
    $where = (isset($_GET['where'])) ? $_GET['where'] : null;

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        $action = (isset($_GET['action'])) ? $_GET['action'] : null;

        if (isset($action) && $action === 'logout') {

            $role = (isset($_SESSION['user'])) ? $_SESSION['user']['role'] : null; 

            session_unset();
            session_destroy();

            if (isset($where) && $where === 'portal') {

                $location = ($role === 'student')
                    ? "https://localhost/aucres/public/login.php?portal=student&type=login"
                    : "https://localhost/aucres/public/login.php?portal={$role}";
                header("Location: $location");

            } elseif (isset($where) && $where === 'homepage') {

                header("Location: https://localhost/aucres/public/index.php");

            }

            session_write_close();
            exit();      

        }

    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $action = (isset($_POST['action'])) ? $_POST['action'] : null;

        if (isset($action) && $action === 'reject') {

            $id = (isset($_POST['id'])) ? $_POST['id'] : null;

            if (empty($id)) {

                http_response_code(400);
                header("Location: https://localhost/aucres/public/error.php?code=400");
                session_write_close();
                exit();

            }

            echo 'success';
            exit();

        }

    }

    http_response_code(400);
    header("Location: https://localhost/aucres/public/error.php?code=400");
    session_write_close();
    exit();

?>