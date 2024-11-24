<?php

    namespace App\Controllers;

    class AuthController
    {

        public function displayAdminLogin()
        {
            require_once __DIR__ . '/../views/auth/admin/login.view.php';
        }

        public function displayFacultyLogin()
        {
            require_once __DIR__ . '/../views/auth/faculty/login.view.php';
        }

        public function displayStudentLogin()
        {
            require_once __DIR__ . '/../views/auth/student/login.view.php';
        }

        public function displayStudentRegistration()
        {
            require_once __DIR__ . '/../views/auth/student/registration.view.php';
        }

        public function display404()
        {
            require_once __DIR__ . '/../views/404.view.php';
        }

    }

?>