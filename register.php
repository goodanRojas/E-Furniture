<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    
    <style>
        body {
            background-image: url("img/system/retro-living-room-interior-design.jpg");
            background-size: cover;
            background-position: center;
           
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .centered-form {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px 0 ;
           
        }

        .card {
            backdrop-filter: blur(20px);
            background-color: rgba(255, 255, 255, 0.5);
            /* Adjust the opacity as needed */
            max-width: calc(100% - 70px);

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

    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row centered-form">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center">Register</h2>
                        <form action="" method="POST" id="form-data">
                            <div class="form-group">
                                <label for="image" class="custom-file-upload">
                                    <img src="img/users/default-profile.png" id="image-preview">
                                  
                                    <span class="d-inline-block border rounded p-1">
                                        <i class="fas fa-plus">
                                        <input type="file" id="image" name="image" required class="form-control"
                                        onchange="previewImage(event)">
                                        </i>
                                    </span>


                                </label>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="firstName">First Name:</label>
                                    <input type="text" class="form-control" id="firstName" name="firstName" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="middleName">Middle Name:</label>
                                    <input type="text" class="form-control" id="middleName" name="middleName">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="lastName">Last Name:</label>
                                    <input type="text" class="form-control" id="lastName" name="lastName" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="phoneNumber">Phone Number:</label>
                                <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="confirmPassword">Confirm Password:</label>
                                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                                    required>
                            </div>
                            <button type="submit" id="register" class="btn btn-primary btn-block">Register</button>
                            <p class="mt-3 text-center">Already registered? <a href="index.php">Login here</a></p>
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
            $("#register").click(function (e) {
                // Prevent the default form submission if the form is valid
                console.log("Register button clicked!"); // Add this console.log statement

                if ($("#form-data")[0].checkValidity()) {
                    e.preventDefault();

                    // Create a new FormData object and append form data
                    var formData = new FormData($("#form-data")[0]);
                    formData.append("action", "procced-register");

                    // Send the form data using AJAX
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
                                window.location.href = "index.php?alert=register_successful";
                            } else {
                                console.log("Failed to register!");
                                Swal.fire({
                                    title: "Failed to register!",
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




</body>

</html>