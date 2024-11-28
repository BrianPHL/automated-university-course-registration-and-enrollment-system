<?php

	if (!isset($_SESSION)) { session_start(); }

	$error = array(
		'code' => http_response_code(),
		'title' => $_SESSION['error']['handler']['title'],
		'description' => $_SESSION['error']['handler']['description']
	);

?>

<!DOCTYPE html>

<html lang="en" data-theme="dark">

    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css" integrity="sha512-rt/SrQ4UNIaGfDyEXZtNcyWvQeOq0QLygHluFQcSjaGB04IxWhal71tKuzP6K8eYXYB6vJV4pHkXcmFGGQ1/0w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link id="favicon" rel="shortcut icon" href="../../../public/favicon-light.ico" type="image/x-icon">
        <link rel="stylesheet" href="./css/error.css">
        <title><?php echo http_response_code() ?> | aucres</title>

    </head>

    <body>

		<section id="main">

			<div class="container">


				<span>

					<?php
						echo '<h1> HTTP ' . $error['code'] . '</h1>';
						echo '<h2> ' . $error['title'] . '</h2>';
					?>

				</span>

				<?php echo '<h3> ' . $error['description'] . '</h3>'; ?>

				<button data-type="primary" onclick='window.location.href="https://localhost/aucres/public/portals.php"'>Return to Portals</button>

			</div>

		</section>

		<section id="footer">

            <div class="container">

                <h6>&copy; 2024 Automated University Course Registration and Enrollment System. All rights reserved.</h6>
                <i class="theme-toggle fa-solid fa-moon"></i>

            </div>

        </section>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    	    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.bundle.min.js" integrity="sha512-igl8WEUuas9k5dtnhKqyyld6TzzRjvMqLC79jkgT3z02FvJyHAuUtyemm/P/jYSne1xwFI06ezQxEwweaiV7VA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    	    <script type="module" src="./js/globals.js"></script>

    </body>

</html>