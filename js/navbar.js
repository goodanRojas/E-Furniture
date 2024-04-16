
$(document).ready(function() {
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
