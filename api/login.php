<?php

    if (!isset($_SESSION)) { session_start(); }

    require_once '../config/db.php'; 

    $conn = connect();

    unset($_SESSION['error']['auth']);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $username = (isset($_POST['username'])) ? $_POST['username'] : null;
        $password = (isset($_POST['password'])) ? $_POST['password'] : null;
        $role = (isset($_POST['role'])) ? $_POST['role'] : null;

        if (empty($username) || empty($password) || empty($role)) {
        
            $_SESSION['error']['auth'] = 'All fields are required.';
            unsuccessfulRedirect($role);
        
        }

        function unsuccessfulRedirect($role) {

            $location = ($role === 'student')
                ? "https://localhost/aucres/public/login.php?portal=student&type=login"
                : "https://localhost/aucres/public/login.php?portal={$role}";
            header("Location: $location");
            exit();

        }

        if (isset($role) && $role === 'student') {

            $stmt = $conn->prepare("SELECT * FROM students WHERE username = :username");
            $stmt->bindParam(":username", $username, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($user && $password === $user['password']) {
    
                if (!isset($_SESSION['csrf_token'])) {
                    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                }
    
                $_SESSION['user'] = $user;
    
                header("Location: https://localhost/aucres/public/dashboard.php?portal=student");
                session_write_close();
                exit();
    
            } else {
    
                $_SESSION['error']['auth'] = 'Invalid username or password.';
                unsuccessfulRedirect($role);
    
            }

        }

        if (isset($role) && $role === 'admin') {

            $stmt = $conn->prepare("SELECT * FROM accounts WHERE role = :role AND username = :username");
            $stmt->bindParam(":role", $role, PDO::PARAM_STR);
            $stmt->bindParam(":username", $username, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($user && $password === $user['password']) {
    
                if (!isset($_SESSION['csrf_token'])) {
                    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                }
    
                $_SESSION['user'] = $user;
    
                header("Location: https://localhost/aucres/public/dashboard.php?portal=" . $user['role']);
                session_write_close();
                exit();
    
            } else {
    
                $_SESSION['error']['auth'] = 'Invalid username or password.';
                unsuccessfulRedirect($role);
    
            }

        }
    
    }

    error_log("HTTP 400 in api/login.php");
    http_response_code(400);
    header("Location: https://localhost/aucres/public/error.php?code=400");
    session_write_close();
    exit();

?>