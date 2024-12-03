<?php

    if (!isset($_SESSION)) { session_start(); }
    
    require_once '../config/db.php';
    require_once './functions.php';
    
    $conn = connect();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $action = (isset($_POST['action'])) ? $_POST['action'] : null;

        if (isset($action) && $action === 'logout') {

            $location = (isset($_POST['location'])) ? $_POST['location'] : null;
            $role = (isset($_SESSION['user']['role'])) ? $_SESSION['user']['role'] : null;

            if (empty($location) || empty($role)) {

                http_response_code(400);
                header("Location: https://localhost/aucres/public/error.php?code=400");
                session_write_close();
                exit();

            };

            if ($location === 'portal') {

                $destination = ($role === 'student') ? "https://localhost/aucres/public/login.php?portal=student&type=login" : "https://localhost/aucres/public/login.php?portal={$role}";

                echo json_encode([ "destination" => $destination ]);

            }

            if ($location === 'homepage') {

                echo json_encode([ "destination" => "https://localhost/aucres/public/index.php" ]);

            }

            session_unset();
            session_destroy();
            session_write_close();
            exit();

        }

        if (isset($action) && $action === 'reject') {

            $table = (isset($_POST['table'])) ? $_POST['table'] : null;
            $id = (isset($_POST['id'])) ? $_POST['id'] : null;

            if (empty($id) || empty($table)) {

                http_response_code(400);
                header("Location: https://localhost/aucres/public/error.php?code=400");
                session_write_close();
                exit();

            }

            deleteData($conn, $table, $id);
            exit();

        }

    }

    error_log("HTTP 400 in api/dashboard.php");
    http_response_code(400);
    header("Location: https://localhost/aucres/public/error.php?code=400");
    session_write_close();
    exit();

?>