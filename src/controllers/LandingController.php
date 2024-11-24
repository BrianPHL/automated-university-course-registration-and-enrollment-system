<?php

    namespace App\Controllers;

    class LandingController
    {

        public function displayLandingPage()
        {
            require_once __DIR__ . '/../views/landing.view.php';
        }

    }

?>