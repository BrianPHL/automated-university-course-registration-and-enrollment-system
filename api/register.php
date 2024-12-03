<?php
    if (!isset($_SESSION)) { session_start(); }

    require_once '../config/db.php'; 
    require_once './functions.php';

    $conn = connect();

    unset($_SESSION['error']['auth']);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $data = array(
            "username" => (isset($_POST['username'])) ? $_POST['username'] : null,
            "program" => (isset($_POST['program'])) ? $_POST['program'] : null,
            "first_name" => (isset($_POST['first_name'])) ? $_POST['first_name'] : null,
            "last_name" => (isset($_POST['last_name'])) ? $_POST['last_name'] : null,
            "password" => (isset($_POST['password'])) ? $_POST['password'] : null,
            "confirm_password" => (isset($_POST['confirm_password'])) ? $_POST['confirm_password'] : null
        );

        if ($data['password'] !== $data['confirm_password']) {
            $_SESSION['error']['auth'] = "Passwords does not match!";
            header("Location: https://localhost/aucres/public/register.php");
            exit();
        }
       
        //Register the user
        if (registerStudent($conn, $data)) {
            // Redirect to login page after successful registration
            header("Location: https://localhost/aucres/public/login.php?portal=student&type=login");
            exit();
        } else {
            // Redirect back to the registration page on failure
            header("Location: https://localhost/aucres/public/register.php");
            exit();
        }

    
    }

    error_log("HTTP 400 in api/register.php");
    http_response_code(400);
    header("Location: https://localhost/aucres/public/error.php?code=400");
    session_write_close();
    exit();

?>