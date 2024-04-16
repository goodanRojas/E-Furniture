<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Furniture: About</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link href="https://cdn.datatables.net/v/bs4/dt-2.0.3/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <style>
        body {
            background-color: antiquewhite;
        }

        .custom-background {
            background-image: url('img/system/landing page.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh;
            /* Adjust the height as needed */
        }

        .contact-info {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .contact-info i {
            color: #010814;
            /* Adjust color as needed */
        }

        .contact-info a {
            color: #010814;
            /* Adjust color as needed */
            text-decoration: none;
        }

        .contact-info a:hover {
            text-decoration: underline;
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
                    <a class="nav-link " href="landing_page.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="main.php">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php#contact_us">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#">About</a>
                </li>

            </ul>
            <div class="dropdown">
                <a type="button" class="nav-link dropdown-toggle" data-toggle="dropdown">
                    more
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#"><i class="fa-regular fa-user"></i> &nbsp;&nbsp;Profile</a>
                    <a class="dropdown-item" href="#"><i class="fa-regular fa-clipboard"></i>&nbsp;&nbsp; Logs</a>
                    <a class="dropdown-item" href="#"><i class="fa-solid fa-right-from-bracket"></i>&nbsp; Logout</a>

                </div>
            </div>
        </div>


    </nav>

    <div class="container-fluid ">
        <div class="row pt-5 custom-background">
            <div class="col-md-8 offset-md-2 text-center">
                <h2 class="display-4">About E-Furnoture Stock Management</h2>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-sm-6 col-md-3 d-flex">
                <div class="card h-100 d-flex flex-column justify-content-between shadow">
                    <div class="card-body text-center">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-gear fa-stack-1x"></i>
                        </span>
                        <h5 class="card-title mt-3">Innovative</h5>
                        <p class="card-text">Pursuing new creative ideas that have the potential to improve the designs
                            in office furniture world.</p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3 d-flex">
                <div class="card h-100 d-flex flex-column justify-content-between shadow">
                    <div class="card-body text-center">
                        <span class="fa-stack fa-4x">
                            <i class="fa-solid fa-paperclip"></i>
                        </span>
                        <h5 class="card-title mt-3">Committed</h5>
                        <p class="card-text">Committing to good product service, after sales and other initiatives that
                            impact lives within and outside the organization.</p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3 d-flex">
                <div class="card h-100 d-flex flex-column justify-content-between shadow">
                    <div class="card-body text-center">
                        <span class="fa-stack fa-4x">
                            <i class="fa-solid fa-hand"></i>
                        </span>
                        <h5 class="card-title mt-3">Accountable</h5>
                        <p class="card-text">Acknowledging and assuming responsibility for actions, products, decisions
                            and policies. It can be applied to individual accountability within and outside the
                            organization.</p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3 d-flex">
                <div class="card h-100 d-flex flex-column justify-content-between shadow">
                    <div class="card-body text-center">
                        <span class="fa-stack fa-4x">
                            <i class="fa-solid fa-users"></i>
                        </span>
                        <h5 class="card-title mt-3">Valuing Client</h5>
                        <p class="card-text">Value your clients and they will value you, we take good care of our
                            clients and we value the partnerships that we have every time we associate.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row p-5" id="contact_us">
            <div class="col-md-12">
                <h2 class="text-center mb-4">Contact Us</h2>
                <div class="row">
                    <div class="col-md-6 p-5">
                        <p class="contact-info"><i class="fas fa-phone"></i>&nbsp;&nbsp; 09123456789</p>
                        <p class="contact-info"><i class="fab fa-facebook"></i>&nbsp;&nbsp; <a
                                href="https://www.facebook.com/" title="facebook page">E-furniture Fb Page</a></p>
                        <p class="contact-info"><i class="fas fa-envelope"></i>&nbsp;&nbsp; <a
                                href="mailto:E-furniture@gmail.com" title="Email account">E-furniture@gmail.com</a></p>
                        <p class="contact-info"><i class="fas fa-map-marker-alt"></i>&nbsp;&nbsp; San Isidro Tomas Oppus
                            Southern Leyte</p>
                    </div>



                    <div class="col-md-6">
                        <p>Please fill out the form below to get in touch with us.</p>
                        <form>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Your Name" required>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Your Email" required>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" rows="5" placeholder="Your Message" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>




    </div>
    <footer class="footer mt-auto py-3">
        <div class="container text-center">
            <span class="text-muted">© 2024 E-Furniture. All rights reserved.</span>
        </div>
    </footer>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"> </script>
    <script src="https://cdn.datatables.net/v/bs4/dt-2.0.3/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>