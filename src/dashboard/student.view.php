<?php

    if (!isset($_SESSION)) { session_start(); }

    require_once '../config/db.php'; 
    require_once '../api/functions.php';
    
    $conn = connect();

?>

<!DOCTYPE html>

<html lang="en" data-theme="dark">

    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css" integrity="sha512-rt/SrQ4UNIaGfDyEXZtNcyWvQeOq0QLygHluFQcSjaGB04IxWhal71tKuzP6K8eYXYB6vJV4pHkXcmFGGQ1/0w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="//cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
        <link id="favicon" rel="shortcut icon" href="../../../public/favicon-light.ico" type="image/x-icon">
        <link rel="stylesheet" href="./css/dashboard.css">
        <title>student dashboard | aucres</title>

    </head>

    <body>
        
        <div class="alert alert-warning alert-dismissible fade d-none" id="alert-popup" role="alert">
            <label for="alert">Alert</label>
            <p id="alert-message"></p>
        </div>

        <nav class="navbar navbar-expand-lg navbar-dark">

            <div class="container">

                <a class="navbar-brand brand" href="#home">
                    <img src="./assets/logo/light.svg" alt="aucres logo in light mode">
                    <h2>aucres.</h2>
                </a>

                <div class="btn-group">

                <button data-type="secondary" data-toggle="dropdown" data-display="static" aria-expanded="false" type="button"> <?php echo $_SESSION['user']['username']?> (student)
                        <i class="fa-solid fa-caret-down"></i>
                    </button>

                    <div class="dropdown-menu dropdown-menu-left dropdown-menu-lg-right">
                        <label class="dropdown-header">Profile actions</label>
                        <button class="dropdown-item logout" type="button">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            Logout
                        </button>
                    </div>

                </div>
            
            </div>

        </nav>

        <section id="main">

            <div class="container">

                <div class="wrapper">

                    <div class="panel">

                        <ul class="nav">

                            <li class="nav-item">
            
                                <a class="nav-link active" data-page="home">
                                    <i class="fa-solid fa-chart-line"></i>
                                    Dashboard
                                </a>
                            </li>
            
                            <li class="nav-item">
                                <a
                                    class="nav-link dropdown"
                                    href="#accountsCollapse"
                                    data-toggle="collapse"
                                    aria-expanded="false"
                                    aria-controls="accountsCollapse"
                                >
                                    <span>
                                        <i class="fa-solid fa-database"></i>
                                        Operations
                                    </span>
                                    <i class="fa-solid fa-caret-down"></i>
                                </a>
            
                                <ul class="collapse list-unstyled" id="accountsCollapse">
                                    <li>
            
                                        <a class="nav-link" data-page="enroll-courses">
                                            <i class="fa-solid fa-graduation-cap"></i>    
                                            Enroll Courses
                                        </a>
            
                                    </li>
            
                                    <li>
            
                                        <a class="nav-link" data-page="pay-unpaid-courses">
                                            <i class="fa-solid fa-chalkboard-user"></i>   
                                            Pay Unpaid Courses
                                        </a>
            
                                    </li>
            
                                </ul>
            
                            </li>

                            <li class="nav-item">
            
                                <a class="nav-link" data-page="enrolled-courses">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                    Enrolled Courses
                                </a>
            
                            </li>
            
                            <li class="nav-item">
            
                                <a class="nav-link" data-page="user-profile">
                                    <i class="fa-solid fa-circle-user"></i>
                                    User Profile
                                </a>
            
                            </li>
            
                        </ul>

                        <div class="actions">

                            <button class="logout" data-type="secondary" type="button">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                Logout
                            </button>

                            <i class="theme-toggle fa-solid fa-moon"></i>

                        </div>

                    </div>

                    <div id="dashboardSection">

                        <div class="home" style="display: none;">
        
                            <div class="header">
            
                                <p>Dashboard</p>
            
                            </div>
            
                            <div class="table">
            
                                <table id="dashboard-table" class="cell-border nowrap order-column">
            
                                    <thead>
            
                                        <tr>
                                            <td>ID</td>
                                            <td>Title</td>
                                            <td>Description</td>
                                            <td>Program</td>
                                        
                                        </tr>
                                    
                                    </thead>
            
                                    <tbody>
    
                                        <?php
                                    
                                        $results = getCoursesData($conn, $_SESSION['user']['program']);
                
                                        foreach ($results as $row) {
                
                                            echo "<tr>";
                                                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                                                echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                                                echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                                                echo "<td>" . htmlspecialchars($row['program']) . "</td>";
                                            echo "</tr>";
                
                                        }
                
                                        ?>
            
                                    </tbody>
            
                                </table>
            
                            </div>
            
                        </div>

                        <div class="user-profile" style="display: none;">

                            <div class="header">

                                <p><a class="breadcrumb-link" data-page="home">Dashboard</a><span style="margin-right: 0.5rem; ">/</span>User Profile</p>

                            </div>

                            <div class="profile">

                                <div class="info">

                                    <h4>Id</h4>
                                    <p><?php echo $_SESSION['user']['id'] ?></p>

                                </div>

                                <div class="info">

                                    <h4>Username</h4>
                                    <p><?php echo $_SESSION['user']['username'] ?></p>

                                </div>

                                <div class="info">

                                    <h4>Program</h4>
                                    <p><?php echo $_SESSION['user']['program'] ?></p>

                                </div>

                                <div class="info">

                                    <h4>First name</h4>
                                    <p><?php echo $_SESSION['user']['first_name'] ?></p>

                                </div>

                                <div class="info">

                                    <h4>Last name</h4>
                                    <p><?php echo $_SESSION['user']['last_name'] ?></p>

                                </div>

                                <div class="info">

                                    <h4>Created at</h4>
                                    <p><?php echo $_SESSION['user']['created_at'] ?></p>

                                </div>

                                <div class="info">

                                    <h4>Last updated at</h4>
                                    <p><?php echo $_SESSION['user']['updated_at'] ?></p>

                                </div>

                            </div>

                        </div>

                        <div class="enroll-courses" style="display: none;">

                            <div class="header">

                                <p><a class="breadcrumb-link" data-page="home">Dashboard</a><span style="margin-right: 0.5rem; ">/</span>Enroll Courses</p>

                            </div>

                            <div class="table" style="padding: 1rem; display: flex; flex-direction: column; gap: 1rem;">
                                
                                <?php

                                $results = getCourseDataByProgram($conn, $_SESSION['user']['program']);
                                foreach ($results as $row) {
                                echo "<div class='entry' data-studentId='" . $_SESSION['user']['id'] . "' data-courseId=" . htmlspecialchars($row['id']) . ">";
                                    echo "<div class='info'>";
                                        echo "<h4>" . htmlspecialchars($row['title']) . "</h4>";
                                        echo "<h5>" . htmlspecialchars($row['description']) . "</h5>";
                                        echo "<h5>" . htmlspecialchars($row['program']) . "</h5>";
                                    echo "</div>";
                                    echo "<div class='cta'>";
                                        echo "<button class='accept-enrollment' data-type='primary'>Enroll</button>";    
                                    echo "</div>";
                                echo "</div>";
                                }

                                ?>

            
                            </div>

                        </div>

                        <div class="pay-unpaid-courses" style="display: none;">

                            <div class="header">

                                <p><a class="breadcrumb-link" data-page="home">Dashboard</a><span style="margin-right: 0.5rem; ">/</span>Pay Unpaid Courses</p>

                            </div>

                            <div class="table" style="padding: 1rem; display: flex; flex-direction: column; gap: 1rem;">
                                
                                <div class="placeholder">

                                    <h4>No data available.</h4>

                                </div>
                                
                                <?php

                                $results = getEnrolledDataByStudentId($conn, $_SESSION['user']['id']);
                                foreach ($results as $row) {
                                echo "<div class='entry' data-studentId='" . $_SESSION['user']['id'] . "'>";
                                    echo "<div class='info'>";
                                        echo "<h4>" . htmlspecialchars($row['course']) . "</h4>";
                                        echo "<h5>" . htmlspecialchars($_SESSION['user']['program']) . "</h5>";
                                    echo "</div>";
                                    echo "<div class='cta'>";
                                        echo "<button class='pay-course' data-type='primary'>Pay</button>";    
                                    echo "</div>";
                                echo "</div>";
                                }

                                ?>
            
                            </div>

                        </div>

                        <div class="enrolled-courses" style="display: none;">
        
                            <div class="header">

                                <p><a class="breadcrumb-link" data-page="home">Dashboard</a><span style="margin-right: 0.5rem; ">/</span>Enrolled Courses</p>

                            </div>
            
                            <div class="table">
            
                                <table id="enrolled-courses-table" class="cell-border nowrap order-column">
            
                                    <thead>
            
                                        <tr>
                                            <td>ID</td>
                                            <td>Course</td>
                                        
                                        </tr>
                                    
                                    </thead>
            
                                    <tbody>
    
                                        <?php
                                    
                                        $results = getPaidEnrolledCourses($conn, $_SESSION['user']['id']);
                
                                        foreach ($results as $row) {
                
                                            echo "<tr>";
                                                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                                                echo "<td>" . htmlspecialchars($row['course']) . "</td>";
                                            echo "</tr>";
                
                                        }
                
                                        ?>
            
                                    </tbody>
            
                                </table>
            
                            </div>
            
                        </div>

                    </div>

                </div>

                <div class="footer">

                    <h6>&copy; 2024 Automated University Course Registration and Enrollment System. All rights reserved.</h6>

                    <a class="return">
                        Homepage
                        <i class="fa-solid fa-square-arrow-up-right"></i>
                    </a>
    
                </div>

            </div>

        </section>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.bundle.min.js" integrity="sha512-igl8WEUuas9k5dtnhKqyyld6TzzRjvMqLC79jkgT3z02FvJyHAuUtyemm/P/jYSne1xwFI06ezQxEwweaiV7VA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script type="module" src="./js/globals.js"></script>
        <script type="module" src="./js/dashboard.js"></script>
        <script type="module" src="//cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>

        <script>

            const targetElement = $('.pay-unpaid-courses > .table')[0];
            let observer = new MutationObserver((mutations) => {
                mutations.forEach((mutation) => {
                    if (mutation.type === 'childList') {
                    
                        if ($(targetElement).children().not('.placeholder').length > 0) {
                            $(targetElement).find('.placeholder').hide();
                        } else {
                            $(targetElement).find('.placeholder').show();
                        }
                    }
                })
            })
            
            if ($(targetElement).children().not('.placeholder').length === 0) {
                $(targetElement).find('.placeholder').show();
            } else {
                $(targetElement).find('.placeholder').hide();
            }

            observer.observe(targetElement, { childList: true, subtree: true });

        </script>

    </body>

</html>