<?php

    if (!isset($_SESSION)) { session_start(); }

    require_once '../public/dashboard.php';
    require_once '../config/db.php'; 
    
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
        <title>admin dashboard | aucres</title>

    </head>

    <body>

        <nav class="navbar navbar-expand-lg navbar-dark">

            <div class="container">

                <a class="navbar-brand brand" href="#home">
                    <img src="./assets/logo/light.svg" alt="aucres logo in light mode">
                    <h2>aucres.</h2>
                </a>

                <div class="btn-group">

                    <button data-type="secondary" data-toggle="dropdown" data-display="static" aria-expanded="false" type="button"> <?php echo $_SESSION['user']['username'] . ' (' . $_SESSION['user']['role'] . ')'  ?>
                        <i class="fa-solid fa-caret-down"></i>
                    </button>

                    <div class="dropdown-menu dropdown-menu-left dropdown-menu-lg-right">
                        <label class="dropdown-header">Profile actions</label>
                        <button class="dropdown-item" type="button">
                            <i class="fa-solid fa-circle-user"></i>    
                            View profile
                        </button>
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
                                        Accounts
                                    </span>
                                    <i class="fa-solid fa-caret-down"></i>
                                </a>
            
                                <ul class="collapse list-unstyled" id="accountsCollapse">
                                    <li>
            
                                        <a class="nav-link" data-page="student-accounts">
                                            <i class="fa-solid fa-graduation-cap"></i>    
                                            Student
                                        </a>
            
                                    </li>
            
                                    <li>
            
                                        <a class="nav-link" data-page="faculty-accounts">
                                            <i class="fa-solid fa-chalkboard-user"></i>   
                                            Faculty
                                        </a>
            
                                    </li>
            
                                    <li>
            
                                        <a class="nav-link" data-page="admin-accounts">
                                            <i class="fa-solid fa-user-tie"></i>   
                                            Admin
                                        </a>
            
                                    </li>
            
                                </ul>
            
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

                        <div class="home">
        
                            <div class="breadcrumbs">
            
                                <p>Dashboard</p>
            
                            </div>
            
                            <div class="counters">
            
                                <div class="counter">
            
                                    <h4>No. of Student accounts</h4>
                                    <?php echo "<h3>" . htmlspecialchars(getEntriesCount($conn, 'accounts', 'student')) . "</h3>" ?>
                                        
                                </div>
            
                                <div class="counter">
            
                                    <h4>No. of Faculty accounts</h4>
                                    <?php echo "<h3>" . htmlspecialchars(getEntriesCount($conn, 'accounts', 'faculty')) . "</h3>" ?>
                                </div>
            
                                <div class="counter">
            
                                    <h4>No. of admin accounts</h4>
                                    <?php echo "<h3>" . htmlspecialchars(getEntriesCount($conn, 'accounts', 'admin')) . "</h3>" ?>
                                        
                                </div>
            
                            </div>
            
                            <div class="table">
            
                                <table id="dashboard-table" class="cell-border nowrap order-column">
            
                                    <thead>
            
                                        <tr>
                                            <td>Id</td>
                                            <td>Username</td>
                                            <td>Role</td>
                                            <td>Email</td>
                                            <td>First name</td>
                                            <td>Last name</td>
                                            <td>Updated at</td>
                                        
                                        </tr>
                                    
                                    </thead>
            
                                    <tbody>
    
                                        <?php
                                    
                                        $results = getTableData($conn, 'accounts');
                
                                        foreach ($results as $row) {
                
                                            echo "<tr>";
                                                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                                                echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                                                echo "<td>" . htmlspecialchars($row['role']) . "</td>";
                                                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                                echo "<td>" . htmlspecialchars($row['first_name']) . "</td>";
                                                echo "<td>" . htmlspecialchars($row['last_name']) . "</td>";
                                                echo "<td>" . htmlspecialchars($row['updated_at']) . "</td>";
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

    </body>

</html>