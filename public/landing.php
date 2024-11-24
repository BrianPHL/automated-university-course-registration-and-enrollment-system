<?php

    require_once __DIR__ . '/../src/controllers/LandingController.php';

    use App\Controllers\LandingController;

    if (!isset($_SESSION)) {
        session_start();
    }

    $controller = new LandingController();

    $controller -> displayLandingPage();

?>