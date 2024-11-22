<!DOCTYPE html>

<html lang="en" data-theme="dark">

    <head>
    
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css" integrity="sha512-rt/SrQ4UNIaGfDyEXZtNcyWvQeOq0QLygHluFQcSjaGB04IxWhal71tKuzP6K8eYXYB6vJV4pHkXcmFGGQ1/0w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link id="favicon" rel="shortcut icon" href="../../../public/favicon-light.ico" type="image/x-icon">
        <link rel="stylesheet" href="./styles.css">
        <title>student registration | aucres</title>
    
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

                    <h4>Hey there!</h4>
                    <h4>Register your student account to get started.</h4>

                </div>

                <form action="POST">

                    <div class="wrapper">

                        <div class="form-row">

                            <div class="form-group">

                                <label for="first_name">First name</label>
                                <input class="form-control" type="text" placeholder="Your first name...">
        
                            </div>

                            <div class="form-group">

                                <label for="last_name">Last name</label>
                                <input class="form-control" type="text" placeholder="Your last name...">
        
                            </div>
                        
                        </div>

                        <!-- <div class="form-group">

                            <label for="first_name">First name</label>
                            <input class="form-control" type="text" placeholder="Your first name...">
    
                        </div> -->

                        <div class="form-group">

                            <label for="username">Username</label>
                            <input class="form-control" type="text" placeholder="Your username...">
    
                        </div>
    
                        <div class="form-group">
    
                            <label for="password">Password</label>
    
                            <div class="input-group">
    
                                <input class="form-control" type="password" placeholder="Your password...">
    
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <i class="togglePassword fa-solid fa-eye-slash"></i>
                                    </div>
                                </div>
    
                            </div>
    
                        </div>

                        <div class="form-group">
    
                            <label for="password">Confirm Password</label>
    
                            <div class="input-group">
    
                                <input class="form-control" type="password" placeholder="Confirm your password...">
    
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <i class="togglePassword fa-solid fa-eye-slash"></i>
                                    </div>
                                </div>
    
                            </div>
    
                        </div>

                    </div>

                    <div class="cta">

                        <button data-type="primary">
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