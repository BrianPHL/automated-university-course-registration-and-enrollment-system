<?php

    $loginUrl = "https://localhost/aucres/public/login.php";
    $registerUrl = "https://localhost/aucres/public/register.php";
    $encodedLoginUrl = $loginUrl . '?' . http_build_query([
        'portal' => 'student',
        'type' => 'login'
    ]);
    $encodedRegisterUrl = $registerUrl . '?' . http_build_query([
        'portal' => 'student',
        'type' => 'register'
    ]);

    $sanitizedLoginUrl = htmlspecialchars($encodedLoginUrl, ENT_QUOTES, 'UTF-8');
    $sanitizedRegisterUrl = htmlspecialchars($encodedRegisterUrl, ENT_QUOTES, 'UTF-8');

?>

<!DOCTYPE html>

<html lang="en" data-theme="dark">

    <head>
    
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css" integrity="sha512-rt/SrQ4UNIaGfDyEXZtNcyWvQeOq0QLygHluFQcSjaGB04IxWhal71tKuzP6K8eYXYB6vJV4pHkXcmFGGQ1/0w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link id="favicon" rel="shortcut icon" href="./assets/favicon-light.ico" type="image/x-icon">
        <link rel="stylesheet" href="./css/landing.css">
        <title>homepage | aucres</title>
    
    </head>
    
    <body data-spy="scroll" data-target=".navbar" data-offset="100">

        <nav class="navbar navbar-expand-lg fixed-top navbar-dark">

            <div class="container">

                <a class="navbar-brand brand" href="#home">
                    <img src="./assets/logo/light.svg" alt="aucres logo in light mode">
                    <h2>aucres</h2>
                </a>
    
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa-solid fa-bars"></i>
                </button>
    
                <div class="collapse navbar-collapse" id="navbarContent">

                    <div class="container">

                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link active" href="#home">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#what-we-offer">What we offer</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#who-we-are">Who we are</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#get-a-hold-of-us">Get a hold of us</a>
                            </li>
                        </ul>
        
                        <ul class="navbar-nav ml-auto">
        
                            <div class="nav-item controls">
                                <i onclick="window.location.href='https://github.com/BrianPHL/automated-university-course-registration-and-enrollment-system'"; class="github fa-brands fa-github"></i>
                                <i class="theme-toggle fa-solid fa-moon"></i>
                            </div>
            
                            <div class="nav-item divider"></div>
            
                            <div class="nav-item cta">

                                <button data-type="secondary" onclick="window.location.href='<?php echo $sanitizedLoginUrl; ?>'" type="button">Sign in</button>
                                <button data-type="primary" onclick="window.location.href='<?php echo $sanitizedRegisterUrl; ?>'" type="button">Get started</button>

                            </div>
                        </ul>

                    </div>
    
                </div>
            
            </div>

        </nav>

        <section id="home">

            <div class="container">

                <div class="info">

                    <div class="heading">
    
                        <h6>Home</h6>
                        <h1>Enroll with ease</h1>
                        <h2>Simplify your university journey with us</h2>
    
                    </div>
    
                    <p>
                        Automated University Course Registration and Enrollment System streamlines course registration and enrollment, making it faster, easier, and more accessible.
                    </p>
    
                </div>
    
                <div class="cta">
    
                    <button onclick="window.location.href='#what-we-offer'" type="button" data-type="secondary">Learn more</button>
                    <button data-type="primary" onclick="window.location.href='<?php echo $sanitizedRegisterUrl; ?>'" type="button">Get started</button>
    
                </div>

            </div>

        </section>

        <section id="hero-footer">

            <div class="container">

                <h6>Expertly crafted for your ease</h6>

            </div>


        </section>

        <!-- TODO: Add images per category later. -->
        <section id="what-we-offer">

            <div class="container">

                <div class="info">

                    <div class="heading">
    
                        <h5>What we offer</h5>

                        <div class="wrapper">

                            <h3>Designed and crafted for a seamless experience</h3>
                            <h3>empowering users with tools that simplify every step</h3>

                        </div>
    
                    </div>
    
                </div>

                <div class="wrapper">

                    <div class="list">

                        <div class="feature">

                            <div class="heading">

                                <i class="fa-solid fa-wand-magic-sparkles"></i>
                                <h3>Seamless Course Registration</h3>
    
                            </div>
    
                            <p>
                                Streamlined course registration with automatic waitlist management, prerequisite checks, and schedule conflict resolution for a smooth academic planning experience.
                            </p>

                        </div>

                        <div class="feature">

                            <div class="heading">

                                <i class="fa-solid fa-credit-card"></i>
                                <h3>Secure Payment Processing</h3>
    
                            </div>
    
                            <p>
                                Integrated with trusted payment gateways to handle tuition payments securely, generating automatic fee receipts and updating student accounts in real time.
                            </p>

                        </div>

                        <div class="feature">

                            <div class="heading">

                                <i class="fa-solid fa-maximize"></i>
                                <h3>Responsive & Scalable System</h3>
    
                            </div>
    
                            <p>
                                Our system adapts seamlessly across devices and scales efficiently to support growing user demands, ensuring smooth performance at all times.
                            </p>

                        </div>

                    </div>

                    <img src="https://www.svgrepo.com/show/508699/landscape-placeholder.svg" alt="Placeholder image for features">

                </div>

            </div>

        </section>

        <section id="who-we-are">

            <div class="container">

                <div class="heading">
    
                    <h5>Who we are</h5>

                    <div class="wrapper">

                        <h3>Meet the minds behind the project</h3>
                        <h3>A dedicated team of developers committed to creating an efficient and user-friendly enrollment experience</h3>

                    </div>

                </div>

                <div class="row justify-content-center">

                    <div class="card">
                        <img src="./assets/team/erandio_cymon.jpg" class="card-img-top">
                        <div class="card-body">
                            <h4>Erandio, Cymon Railey A.</h4>
                            <h5>Developer</h5>
                        </div>
                    </div>

                    <div class="card">
                        <img src="./assets/team/pasco_brian.jpg" class="card-img-top" alt="Brian Lawrence C. Pasco's image">
                        <div class="card-body">
                            <h4>Pasco, Brian Lawrence C.</h4>
                            <h5>Developer</h5>
                        </div>
                    </div>

                    <div class="card">
                        <img src="./assets/team/ganapin_aidan.jpg" class="card-img-top" alt="Aidan Kyle DL. Ganapin's image">
                        <div class="card-body">
                            <h4>Ganapin, Aidan Kyle DL.</h4>
                            <h5>Developer</h5>
                        </div>
                    </div>

                    <div class="card">
                        <img src="./assets/team/soliven_sean.jpg" class="card-img-top" alt="Sean Calvin C. Soliven's image">
                        <div class="card-body">
                            <h4>Soliven, Sean Calvin C.</h4>
                            <h5>Developer</h5>
                        </div>
                    </div>
                    <div class="card">
                        <img src="./assets/team/villanueva_kyle.jpg" class="card-img-top" alt="Kyle D. Villanueva's image">
                        <div class="card-body">
                            <h4>Villanueva, Kyle D.</h4>
                            <h5>Developer</h5>
                        </div>
                    </div>

                </div>

            </div>

        </section>

        <section id="newsletter">

            <div class="container">

                <div class="heading">

                    <h5>Newsletter</h5>

                    <div class="wrapper">

                        <h3>Be ahead of the curve</h3>
                        <h3>Get the latest updates on project development</h3>

                    </div>

                </div>

                <!-- <div class="form-group">
    
                    <label for="password">Password</label>

                    <div class="input-group">

                        <input class="form-control" type="password" name="password" placeholder="Your password...">

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="togglePassword fa-solid fa-eye-slash"></i>
                            </div>
                        </div>

                    </div>

                </div> -->

                <div class="form-group">

                    <div class="input-group">

                        <input class="form-control" type="text" placeholder="Your email address...">

                        <div class="input-group-append">
                            <div class="input-group-text" data-contains="button">
                                <button data-type="primary">
                                    <i class="fa-solid fa-paper-plane"></i>
                                    Submit
                                </button>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </section>

        <section id="get-a-hold-of-us">

            <div class="container">

                <div class="heading">
    
                    <h5>Get a hold of us</h5>

                    <div class="wrapper">

                        <h3>We're here to help!</h3>
                        <h3>Have questions, feedback, or need assistance? Reach out to our team, and we’ll get back to you as soon as possible. Let’s make your experience seamless!</h3>

                    </div>

                </div>

                <div class="container">

                    <div class="info">

                        <div class="phone">
    
                            <div class="text">
    
                                <h4>Call with us</h4>
                                <p>Call our dedicated team anytime, they'd be happy to provide all the assistance you need!</p>
    
                            </div>
    
                            <button data-type="secondary">
    
                                <i class="fa-solid fa-phone"></i>
                                +63 (945) 288-7632
    
                            </button>
    
                        </div>
                        
                        <div class="chat">
    
                            <div class="text">
    
                                <h4>Chat with us</h4>
                                <p>Chat with our friendly team anytime, anywhere.</p>
    
                            </div>
    
                            <button data-type="secondary">
    
                                <i class="fa-solid fa-paper-plane"></i>
                                Shoot us an email
    
                            </button>
                            
                        </div>
    
                        <div class="email">
    
                            
                        </div>
    
                    </div>
    
                    <div class="forms">
    
                        <h4>Chat with us</h4>

                        <div class="wrapper">

                            <div class="name">

                                <div class="form-group">

                                    <label for="first_name">First name</label>
                                    <input class="form-control" type="text" name="first_name"  placeholder="Your first name...">

                                </div>

                                <div class="form-group">

                                    <label for="second_name">Second name</label>
                                    <input class="form-control" type="text" name="second_name" placeholder="Your second name...">

                                </div>

                            </div>

                            <div class="form-group">

                                <label for="email_address">Email address</label>
                                <input class="form-control" type="text" name="email_address" placeholder="Your email address...">
                                
                            </div>

                            <div class="form-group">

                                <label for="message">Message</label>
                                <textarea class="form-control" name="message" placeholder="Your message..."></textarea>
                                
                            </div>

                        </div>

                        <button data-type="primary">
                            <i class="fa-solid fa-paper-plane"></i>
                            Submit
                        </button>
    
                    </div>

                </div>

            </div>

        </section>

        <section id="footer">

            <div class="container">

                <div class="wrapper">

                    <div class="links">

                        <div class="column">
    
                            <h5>Quick links</h5>
                            <ul class="list-unstyled">
                                <li>
                                    <a href="#home">Home</a>
                                </li>
                                <li>
                                    <a href="#what-we-offer">What We Offer</a>
                                </li>
                                <li>
                                    <a href="#who-we-are">Who We Are</a>
                                </li>
                                <li>
                                    <a href="#get-a-hold-of-us">Contact Us</a>
                                </li>
                            </ul>
    
                        </div>
    
                        <div class="column">
    
                            <h5>Legal</h5>
                            <ul class="list-unstyled">
                                <li>
                                    <a href="#">Privacy Policy</a>
                                    <i class="fa-solid fa-square-arrow-up-right"></i>
                                </li>
                                <li>
                                    <a href="#">Terms & Conditions</a>
                                    <i class="fa-solid fa-square-arrow-up-right"></i>
                                </li>
                            </ul>
    
                        </div>
    
                        <div class="column">
    
                            <h5>Contact us</h5>
                            <ul class="list-unstyled">
                                <li>
                                    <a href="https://github.com/BrianPHL/automated-university-course-registration-and-enrollment-system">Github</a>
                                    <i class="fa-solid fa-square-arrow-up-right"></i>
                                </li>
                                <li>
                                    <a href="#">Email</a>
                                    <i class="fa-solid fa-square-arrow-up-right"></i>
                                </li>
                            </ul>
    
                        </div>
    
                    </div>

                    <a class="brand" href="#home">
                        <img src="./assets/logo/light.svg" alt="aucres logo in light mode">
                        <h2>aucres</h2>
                    </a>

                </div>

                <div class="divider"></div>

                <div class="footer">

                    <h6>&copy; 2024 Automated University Course Registration and Enrollment System. All rights reserved.</h6>

                    <i class="theme-toggle fa-solid fa-moon"></i>

                </div>

            </div>

        </section>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.min.js" integrity="sha512-7rusk8kGPFynZWu26OKbTeI+QPoYchtxsmPeBqkHIEXJxeun4yJ4ISYe7C6sz9wdxeE1Gk3VxsIWgCZTc+vX3g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script type="module" src="./js/landing.js"></script>

    </body>

</html>
