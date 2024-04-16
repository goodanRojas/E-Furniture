<?php
session_start();
if ($_SESSION["user_id"] == null || $_SESSION["user_id"] == "") {
    header("Location: index.php?alert=login_first   ");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Furniture: Landing Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link href="https://cdn.datatables.net/v/bs4/dt-2.0.3/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <style>
        /* Add custom styles here */
        .landing-page {
            background-image: url('img/system/landing page.jpg');
            /* Path to your background image */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: black;
            /* Set text color to contrast with the background */
            padding: 100px 0;
            /* Adjust padding as needed */
            height: calc(100vh - 56px);
            /* Subtract the height of the navbar */
            overflow-y: auto;
            /* Add scrollbar if content overflows vertically */
        }

        .animate-text {
            animation: fadeInUpAnimation 1s ease-in-out;
            /* Add fade-in animation */
        }

        @keyframes fadeInUpAnimation {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 767.98px) {

            /* Adjust for smaller screens */
            .landing-page {
                padding-top: 75px;
                /* Adjust padding for smaller screens */
                height: calc(100vh - 56px - 56px);
                /* Subtract height of navbar and bottom navigation (if any) */
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <!-- Brand -->
        <a class="navbar-brand" href="#"><i class="fas fa-couch"></i>&nbsp;&nbsp;E-Furniture Stock Management</a>

        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="main.php">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php#contact_us">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>

            </ul>
            <div class="dropdown">
                <a type="button" class="nav-link dropdown-toggle" data-toggle="dropdown">
                    More
                </a>
                <div class="dropdown-menu dropdown-menu-right">


                    <button type="button" class="dropdown-item" id="show_profile">
                        <i class="fa-regular fa-user"></i> &nbsp;&nbsp;Profile
                    </button>

                    <button type="button" class="dropdown-item" id="showAllLogs" data-toggle="modal"
                        data-target="#activityLogModal">
                        <i class="fa-regular fa-clipboard"></i>&nbsp;&nbsp; Logs
                    </button>

                    <button class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
                        <i class="fa-solid fa-right-from-bracket"></i>&nbsp; Logout
                    </button>


                </div>
            </div>
        </div>


    </nav>

    <div class="container-fluid landing-page">
        <div class="row">
            <div class="col-md-8 offset-md-2 text-center">
                <h1 class="display-4 animate-text">Welcome to Our Website</h1>
                <p class="lead animate-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis
                    libero justo, a ultrices leo gravida nec.</p>
                <a href="about.php" class="btn btn-primary btn-lg animate-text">Learn More</a>

            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"> </script>
    <script src="https://cdn.datatables.net/v/bs4/dt-2.0.3/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



</body>

</html>