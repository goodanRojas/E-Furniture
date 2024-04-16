    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
        <style>
            body {
                background-image: url("img/system/retro-living-room-interior-design.jpg");
                background-size: cover;
                background-position: center;
                height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .centered-form {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100%;
            }

            .card {
                backdrop-filter: blur(20px);
                background-color: rgba(255, 255, 255, 0.5);
                /* Adjust the opacity as needed */
                max-width: calc(100% - 70px);

            }
        </style>
    </head>

    <body>
        <div class="container">
            <div class="row centered-form">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title">Login</h2>
                            <form action="" method="POST" id="form-data">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="username" name="username"
                                        placeholder="Username/Email" required>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                    </div>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Password" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="bi bi-eye" id="togglePassword"></i>
                                        </span>
                                    </div>
                                </div>
                                <button type="submit" id="procced-login" class=" btn btn-primary btn-block">Login</button>
                                <p class="mt-3 text-center">Not yet registered? <a href="register.php">Click here</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>


            // Toggle password visibility
            $('#togglePassword').click(function () {
                var passwordInput = $('#password');
                var type = passwordInput.attr('type') === 'password' ? 'text' : 'password';
                passwordInput.attr('type', type);
                $(this).toggleClass('bi-eye bi-eye-slash');
            });


            $(document).ready(function () {
                $("#procced-login").click(function (e) {
                    // Prevent the default form submission if the form is valid
                    console.log("Login button clicked!"); // Add this console.log statement

                    if ($("#form-data")[0].checkValidity()) {
                        e.preventDefault();

                        // Create a new FormData object and append form data
                        var formData = new FormData($("#form-data")[0]);
                        formData.append("action", "procced-login");

                        // Send the form data using AJAX
                        console.log("ajax started");
                        $.ajax({
                            
                            url: "action.php",
                            type: "POST",
                            data: formData,
                            processData: false,  // Prevent jQuery from processing the data
                            contentType: false,  // Prevent jQuery from setting the content type
                            success: function (response) {
                                console.log("AJAX success"); // Debug statement

                                console.log("Response from server:", response); // Debug statement

                                if (parseInt(response.trim()) === 1) {
                                    console.log("credentials are true");
                                
                                    $("#form-data")[0].reset();
                                    window.location.href = "main.php?alert=login_successful";
                                } else {
                                    console.log("credentials are false");
                                    Swal.fire({
                                        title: "Wrong credentials!",
                                        icon: "error"
                                    });
                                }
                            },
                            error: function (xhr, status, error) {
                                console.log("AJAX error:", error); // Debug statement
                            }
                        });
                    }
                });
            });

        </script>


        <?php
        if (isset($_GET["alert"]) && $_GET["alert"] == "login_first") {
            echo '<script>
                    Swal.fire({
                        title: "Login first!",
                        icon: "warning"
                    });
                </script>';
        }
        if (isset($_GET["alert"]) && $_GET["alert"] == "register_successful") {
            echo '<script>
                    Swal.fire({
                        title: "Registered succesfuly!",
                        icon: "success"
                    });
                </script>';
        }
        ?>

    </body>

    </html>