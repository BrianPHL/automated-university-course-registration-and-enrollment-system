<?php

    if (!isset($_SESSION)) { session_start(); }
    
    require_once '../config/db.php';
    require_once './functions.php';
    
    $conn = connect();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (empty($conn)) return;

        $action = (isset($_POST['action'])) ? $_POST['action'] : null;

        if (isset($action) && $action === 'logout') {

            $location = (isset($_POST['location'])) ? $_POST['location'] : null;
            $role = (isset($_SESSION['user']['role'])) ? $_SESSION['user']['role'] : 'student';

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

        if (isset($action) && $action === 'accept') {

            $id = (isset($_POST['id'])) ? $_POST['id'] : null;

            if (empty($id)) {

                http_response_code(400);
                header("Location: https://localhost/aucres/public/error.php?code=400");
                session_write_close();
                exit();

            }

            acceptPendingStudentAccount($conn, $id);
            exit();

        }

        if (isset($action) && $action === 'add-faculty') {

            $username = (isset($_POST['username'])) ? $_POST['username'] : null;
            $role = (isset($_POST['role'])) ? $_POST['role'] : null;
            $email = (isset($_POST['email'])) ? $_POST['email'] : null;
            $first_name = (isset($_POST['first_name'])) ? $_POST['first_name'] : null;
            $last_name = (isset($_POST['last_name'])) ? $_POST['last_name'] : null;
            $password = (isset($_POST['password'])) ? $_POST['password'] : null;

            if (empty($username) || empty($role) || empty($email) || empty($first_name) || empty($last_name) || empty($password)) {

                http_response_code(400);
                header("Location: https://localhost/aucres/public/error.php?code=400");
                session_write_close();
                exit();

            }

            addFaculty($conn, array(
                'username' => $username,
                'role' => $role,
                'email' => $email,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'password' => $password
            ));
            exit();

        }

    }

    error_log("HTTP 400 in api/dashboard.php");
    http_response_code(400);
    header("Location: https://localhost/aucres/public/error.php?code=400");
    session_write_close();
    exit();

?>