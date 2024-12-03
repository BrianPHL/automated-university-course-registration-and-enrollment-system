<?php if (!isset($_SESSION)) { session_start(); } ?>

<!DOCTYPE html>

<html lang="en" data-theme="dark">

    <head>
    
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css" integrity="sha512-rt/SrQ4UNIaGfDyEXZtNcyWvQeOq0QLygHluFQcSjaGB04IxWhal71tKuzP6K8eYXYB6vJV4pHkXcmFGGQ1/0w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link id="favicon" rel="shortcut icon" href="../../../public/favicon-light.ico" type="image/x-icon">
        <link rel="stylesheet" href="./css/auth.css">
        <title>student login | aucres</title>
    
    </head>

    <body>

        <div class="container-fluid">

            <div class="heading">

                <a class="brand">
                    <img src="./assets/logo/light.svg" alt="aucres logo in light mode">
                    <h2>aucres.</h2>
                </a>

                <i class="theme-toggle fa-solid fa-moon"></i>

            </div>

            <div class="info">

                <h4>REGISTRATION FORM</h4>
                <h5>Fill out the following to register.</h5>

            </div>

            <form method="POST" action="https://localhost/aucres/api/register.php">

                <div class="wrapper">

                    <?php if (isset($_SESSION['error']['auth'])) { echo "<h6 class='error'> " . $_SESSION['error']['auth'] . "</h6>"; } ?>

                    <input type="hidden" name="role" value="student"> 

                    <div class="inputs">

                        <div class="form-group">
                    
                            <label for="username">Username</label>
                            <input class="form-control single" type="text" name="username" placeholder="Your username...">
    
                        </div>

                        <div class="form-group">

                            <label for="program"> Program </label>
                            <select class="form-control single" name="program" required>
                                <option value="" disabled selected> Select your program </option>
                                <option value="Information Technology"> Information Technology </option>
                                <option value="Computer Science"> Computer Science </option>
                                <option value="Computer Engineering"> Computer Engineering </option>
                            </select>
                        </div>

                        <div class="form-group">
                    
                            <label for="first_name">First Name</label>
                            <input class="form-control single" type="text" name="first_name" placeholder="Your first name...">
    
                        </div>

                        <div class="form-group">
                    
                            <label for="last_name">Last Name</label>
                            <input class="form-control single" type="text" name="last_name" placeholder="Your last name...">
    
                        </div>
    
                        <div class="form-group">
    
                            <label for="password">Password</label>
    
                            <div class="input-group">
    
                                <input class="form-control stacked" type="password" name="password" placeholder="Your password...">
    
                                <div class="input-group-append">
                                    <div class="input-group-text" data-contains="icon">
                                        <i class="togglePassword fa-solid fa-eye-slash"></i>
                                    </div>
                                </div>
    
                            </div>
    
                        </div>

                        <div class="form-group">

                            <label for="confirm_password"> Confirm Password </label>

                            <div class="input-group">

                                <input class="form-control stacked" type="password" name="confirm_password" placeholder="Please re-enter your password..." required>

                                <div class="input-group-append">

                                    <div class="input-group-text" data-contains="icon">

                                        <i class="togglePassword fa-solid fa-eye-slash"></i>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="cta">

                        <button type="submit" data-type="primary">
                            Register
                            <i class="fa-solid fa-arrow-right-to-bracket"></i>
                        </button>

                        <button type="button" class="portalSwitcher" onclick="event.preventDefault(); location.href='https://localhost/aucres/public/login.php?portal=student&type=login'">
                            Already have an account? Login here!
                            <i class="fa-solid fa-square-arrow-up-right"></i>
                        </button>

                    </div>

                </div>

            </form>

        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.min.js" integrity="sha512-7rusk8kGPFynZWu26OKbTeI+QPoYchtxsmPeBqkHIEXJxeun4yJ4ISYe7C6sz9wdxeE1Gk3VxsIWgCZTc+vX3g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script type="module" src="./js/globals.js"></script>
        <script type="module" src="./js/auth.js"></script>

    </body>

</html>