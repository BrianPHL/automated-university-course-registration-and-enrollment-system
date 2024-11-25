<?php

    if (!isset($_SESSION)) { session_start(); }

    require_once '../config/db.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $role = $_POST['role'] ?? 'student';
        $username = $_POST['username'] ?? null;
        $password = $_POST['password'] ?? null;

        function unsuccessfulRedirect() {
            
            ($role === 'student')
                ? header("Location: https://localhost/aucres/public/login.php?portal=student&type=login")
                : header("Location: https://localhost/aucres/public/login.php?portal={$role}");
            exit();

        }
    
        if (empty($username) || empty($password)) {

            $_SESSION['error'] = 'All fields are required.';
            unsuccessfulRedirect();

        }
    
        $stmt = $pdo->prepare("SELECT * FROM users WHERE role = :role AND username = :username");
        $stmt->bindParam(":role", $role, PDO::PARAM_STR);
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($user && password_verify($password, $user['password'])) {

            $_SESSION['user'] = $user;

            header("Location: https://localhost/aucres/public/dashboard.php?portal=${role}");
            exit();

        } else {

            $_SESSION['error'] = 'Invalid username or password.';
            unsuccessfulRedirect();

        }
    }

?>