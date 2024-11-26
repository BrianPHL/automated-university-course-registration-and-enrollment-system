<?php

    if (!isset($_SESSION)) { session_start(); }

    require_once '../config/db.php'; 

    $conn = connect();

    if (isset($_GET['action']) && $_GET['action'] === 'switch') {

        header('Location: https://localhost/aucres/public/portals.php');
        exit();

    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $_SESSION['error'] = '';

        $role = $_POST['role'] ?? 'student';
        $username = $_POST['username'] ?? null;
        $password = $_POST['password'] ?? null;

        function unsuccessfulRedirect($role) {

            $location = ($role === 'student')
                ? "https://localhost/aucres/public/login.php?portal=student&type=login"
                : "https://localhost/aucres/public/login.php?portal={$role}";
            header("Location: $location");
            exit();

        }

        if (empty($username) || empty($password)) {
        
            $_SESSION['error'] = 'All fields are required.';
            unsuccessfulRedirect($role);
        
        }
    
        $stmt = $conn->prepare("SELECT * FROM accounts WHERE role = :role AND username = :username");
        $stmt->bindParam(":role", $role, PDO::PARAM_STR);
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $password === $user['password']) { // TODO: Use password_verify on PROD.

            $_SESSION['user'] = $user;
            unset($_SESSION['error']);

            header("Location: https://localhost/aucres/public/dashboard.php?portal=${role}");
            exit();

        } else {

            $_SESSION['error'] = 'Invalid username or password.';
            unsuccessfulRedirect($role);

        }
    
    }

    http_response_code(400);
    error_log('Invalid request made to login.php');

?>