<?php
session_start();
if ($_SESSION["user_id"] == null || $_SESSION["user_id"] == "") {
    header("Location: index.php?alert=login_first   ");
    exit();
}
$user_id = $_SESSION["user_id"];

?>
<!-- THIS FILE IS FOR VIEW -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Furniture</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link href="https://cdn.datatables.net/v/bs4/dt-2.0.3/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <style>
        body {
            background-color: antiquewhite;
        }

        .custom-file-upload {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }

        .custom-file-upload input[type='file'] {
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;

            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        #image-preview {
            width: 100px;
            /* Adjust as needed */
            height: 100px;
            /* Adjust as needed */
            border: 1px solid #ccc;
        }

        .custom-file-upload i {
            position: absolute;
            bottom: 5px;
            right: 5px;
            color: #333;
        }

        .logs-table {
            width: 100%;
        }

        .profile-card {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        .profile-img {
            max-width: 100%;
            height: auto;
            border-radius: 50%;
        }

        .profile_modal {
            display: none;
        }

        .profile_modal_visible {
    display: flex;
    position: fixed; /* Change to fixed */
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    align-items: center;
    justify-content: center;
    overflow: auto; /* Add overflow: auto to enable scrolling within the modal if needed */
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
                    <a class="nav-link" href="landing_page.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#">Products</a>
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


    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="text-left font-weight-normal my-3">Data List</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <h4 class="mt-2 text-primary">All furniture</h4>
            </div>
            <div class="col-lg-6">
                <button type="button" class="btn btn-primary m-1 float-right" data-toggle="modal"
                    data-target="#addFurnitureModal"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Add
                    Furniture</button>
            </div>
        </div>
        <hr class="my-1">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive" id="showFurnitureData">

                </div>
            </div>
        </div>
    </div>

    <!-- ADD NEW FURNITURE MODAL -->
    <div class="modal fade" id="addFurnitureModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add New Furniture</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body px-4">
                    <form action="" method="post" id="form-data" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="image" class="custom-file-upload">
                                <img src="img/items/default-image.png" id="image-preview">
                                <input type="file" id="image" name="image" required class="form-control"
                                    onchange="previewImage(event)">
                                <span class="d-inline-block border rounded p-1">
                                    <i class="fas fa-plus"></i>
                                </span>


                            </label>
                        </div>
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Name" required class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" name="description" placeholder="Description" required
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="number" name="quantity" placeholder="Quantity" min="1" required
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="number" name="price" placeholder="Price" min="1" required class="form-control">
                        </div>

                        <div class="form-group">
                            <input type="submit" name="insetNewfurniture" id="insetNewfurniture" value="Add item"
                                class="btn btn-danger btn-block">
                        </div>

                    </form>

                </div>



            </div>
        </div>
    </div>

    <!-- LOGOUT MODAL -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Logout Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to logout?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirm_logout">Logout</button>
                </div>
            </div>
        </div>
    </div>


    <!-- LOGS MODAL -->

    <div class="modal fade" id="activityLogModal" tabindex="-1" role="dialog" aria-labelledby="activityLogModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="activityLogModalLabel">Activity Logs</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive" id="showLogsData">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="clearButton">Clear Logs</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- CLEARE LOGS MODAL -->
    <div class="modal" id="clearLogsConfirmationModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title text-warning">Are you sure you want to clear all the activity logs?</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">

                    <p class="text-danger text-center text-bold"> <strong> This process cannot be undone!</strong></p>
                </div>


                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmClear">Clear</button>
                </div>

            </div>
        </div>
    </div>

    <!-- PROFILE MODAL -->
    <div class="profile_modal" id="show-profile-data">

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
    <script>
        $(document).ready(function () {


            showAllfurniture();
            function showAllfurniture() {
                $.ajax({
                    url: "action.php",
                    type: "POST",
                    data: { action: "viewAllFurniture" },
                    success: function (reponse) {
                        $("#showFurnitureData").html(reponse);
                        $(".table").DataTable({
                            order: [[0, 'desc']],
                        });
                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                    }

                });
            }
            /* INSERT REQUEST */
            $("#insetNewfurniture").click(function (e) {
                // Prevent the default form submission if the form is valid
                if ($("#form-data")[0].checkValidity()) {
                    e.preventDefault();

                    // Create a new FormData object and append form data
                    var formData = new FormData($("#form-data")[0]);
                    formData.append("action", "insertNewFurniture");

                    // Send the form data using AJAX
                    $.ajax({
                        url: "action.php",
                        type: "POST",
                        data: formData,
                        processData: false,  // Prevent jQuery from processing the data
                        contentType: false,  // Prevent jQuery from setting the content type
                        success: function (response) {

                            Swal.fire({
                                title: "Added new furniture!",
                                icon: "success"
                            });
                            $("#form-data")[0].reset();
                            $("#addFurnitureModal").modal('hide');

                            showAllfurniture();
                        },
                        error: function (xhr, status, error) {
                            console.log(error);
                        }
                    });
                }
            });

            $("#confirm_logout").click(function () {
                var user_id = <?php echo $user_id; ?>;
                $.ajax({
                    url: "action.php",
                    type: "POST",
                    data: {
                        action: "logout", // Wrap 'logout' in quotes to make it a string
                        id: user_id
                    },
                    success: function (response) {
                        // Handle the response from the server
                        console.log(response);
                        if (response.trim() == 1) {


                            window.location = "index.php";
                        } else {
                            Swal.fire({
                                title: "Failed to logout!",
                                icon: "error"
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        // Handle errors
                        console.error(error); // Example: Output the error to the console
                    }
                });
            });


            $("#show_profile").click(function () {
                var user_id = <?php echo $user_id; ?>;
                console.log(user_id);
                $.ajax({
                    url: "action.php",
                    type: "POST",
                    data: {
                        action: "show_profile",
                        id: user_id
                    },
                    success: function (response) {
                        // Handle the response from the server
                        console.log(response);
                        if (response.trim() !== 2) {
                            $("#show-profile-data").html(response);
                            $("#show-profile-data").addClass("profile_modal_visible");
                            $("#show-profile-data").removeClass("profile_modal");


                        } else {
                            Swal.fire({
                                title: "Failed to open profile!",
                                icon: "error"
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        // Handle errors
                        console.error(error); // Example: Output the error to the console
                    }
                });
            });

            $("#confirmClear").click(function () {
                $.ajax({
                    url: "action.php",
                    type: "POST",
                    data: {
                        action: "clearActivityLogs",

                    },
                    success: function (response) {
                        // Handle the response from the server
                        console.log(response);
                        console.log(response.trim());
                        if (response.trim() == 1) {
                            Swal.fire({
                                title: "Log has been successfuly Cleared!",
                                icon: "success"
                            });
                            $("#clearLogsConfirmationModal").modal("hide");
                            $("#activityLogModal").modal("hide");
                        } else {
                            Swal.fire({
                                title: "Failed to clear the Logs!",
                                icon: "error"
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        // Handle errors
                        console.error(error); // Example: Output the error to the console
                    }
                });
            });

            $("#showAllLogs").click(function () {
                $.ajax({
                    url: "action.php",
                    type: "POST",
                    data: {
                        action: "viewAllLogs"
                    },
                    success: function (response) {
                        console.log("The data reponse is successful");
                        $("#showLogsData").html(response);
                        $(".logs-table").DataTable({
                            order: [
                                [0, 'desc']
                            ],
                        });
                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                    }
                });
            });
            





        });
        document.addEventListener("DOMContentLoaded", function() {
            $("#close-profile-modal").click(function () {
                $("#show-profile-data").removeClass("profile_modal_visible");
                $("#show-profile-data").addClass("profile_modal");
            });
});


        document.getElementById('clearButton').addEventListener('click', function () {
            $('#clearLogsConfirmationModal').modal('show');
        });
        function previewImage(event) {
            const input = event.target;
            const file = input.files[0];

            // Check if a file is selected
            if (file) {
                // Get the file extension
                const extension = file.name.split('.').pop().toLowerCase();

                // Check if the file extension is an image format
                if (['jpg', 'jpeg', 'png', 'gif'].includes(extension)) {
                    // Read and display the image
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        document.getElementById('image-preview').setAttribute('src', e.target.result);
                    };
                    reader.readAsDataURL(file);
                } else {
                    // Display an error message
                    alert('Please select an image file (jpg, jpeg, png, gif).');
                    // Clear the file input
                    input.value = '';
                }
            }
        }
    </script>


    <?php
    if (isset($_GET["alert"]) && $_GET["alert"] == "login_successful") {
        echo '<script>
        Swal.fire({
            title: "You are now logged in!",
            icon: "success"
        }).then(function() {
            // Redirect to the same page without the GET parameters
            window.location.href = window.location.origin + window.location.pathname;
        });
    </script>';
    }

    ?>
</body>

</html>