<?php

    session_start();
    require '../../../config/database.php';

    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        if (!empty($username) && !empty($password)) {

            $stmt = $pdo->prepare("SELECT * FROM accounts WHERE username = :username AND role = 'admin'");
            $stmt->execute(['username' => $username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && $password === $user['password']) {
                
                $_SESSION['username'] = $username;
                header("Location: ../../dashboard/admin/dashboard.php");
                exit();

            } else {
                $error = "Invalid credentials. Please try again.";
            }

        } else {

            $error = "Please fill in all fields.";

        }

    }

?>

<!DOCTYPE html>

<html lang="en" data-theme="dark">

    <head>
    
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css" integrity="sha512-rt/SrQ4UNIaGfDyEXZtNcyWvQeOq0QLygHluFQcSjaGB04IxWhal71tKuzP6K8eYXYB6vJV4pHkXcmFGGQ1/0w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link id="favicon" rel="shortcut icon" href="../../../public/favicon-light.ico" type="image/x-icon">
        <link rel="stylesheet" href="./styles.css">
        <title>admin login | aucres</title>
    
    </head>

    <body>

        <section id="forms">

            <div class="container">

                <div class="heading">

                    <a class="brand" href="#home">
                        <img src="../../../public/assets/logo/light-512.svg" alt="aucres logo in light mode">
                        <h2>aucres</h2>
                    </a>
    
                    <i class="theme-toggle fa-solid fa-moon"></i>

                </div>

                <div class="info">

                    <h4>Welcome back!</h4>
                    <h4>Sign in to your admin account.</h4>

                </div>

                <form method="POST" action="login.php">

                    <div class="wrapper">

                        <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>

                        <div class="form-group">

                            <label for="username">Username</label>
                            <input class="form-control" type="text" name="username" placeholder="Your username...">
    
                        </div>
    
                        <div class="form-group">
    
                            <label for="password">Password</label>
    
                            <div class="input-group">
    
                                <input class="form-control" type="password" name="password" placeholder="Your password...">
    
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <i class="togglePassword fa-solid fa-eye-slash"></i>
                                    </div>
                                </div>
    
                            </div>
    
                        </div>

                    </div>

                    <div class="cta">

                        <button type="submit" data-type="primary">
                            Log in
                            <i class="fa-solid fa-arrow-right-to-bracket"></i>
                        </button>

                    </div>

                </form>

            </div>

        </section>

        <section id="background">

            <img src="../../../public/assets/bg/library.jpg" alt="An image of a library">

        </section>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.min.js" integrity="sha512-7rusk8kGPFynZWu26OKbTeI+QPoYchtxsmPeBqkHIEXJxeun4yJ4ISYe7C6sz9wdxeE1Gk3VxsIWgCZTc+vX3g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script type="module" src="../../main.js"></script>
        <script type="module" src="./module.js"></script>

    </body>

</html>