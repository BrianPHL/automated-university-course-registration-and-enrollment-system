<?php

    require_once __DIR__ . '/../src/controllers/AuthController.php';

    use App\Controllers\AuthController;

    if (!isset($_SESSION)) {
        session_start();
    }

    $controller = new AuthController();

    $controller -> displayStudentRegistration();

?>