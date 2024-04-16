<?php

require_once "db.php";

$db = new Database();

if ($_POST["action"] && $_POST["action"] == "viewAllFurniture") {
    $output = '';
    $data = $db->selectFurniture();
    if ($db->furnitureTotalRowCount() > 0) {
        $output .= '
        <table class="table table-stripped table-sm table-bordered">
        <thead>
            <tr class="text-center">
                <th>Id</th>
                <th>Image</th>
                <th>Name</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        ';
        foreach ($data as $row) {
            $output .= '
            <tr class="text-center text-secondary">
            <td style="vertical-align: middle; text-align: center;"> <img src="img/items/' . $row["img"] . '" class="img-fluid"
            style="max-width: 100px; max-height: 100px;"> </td>
            <td style="vertical-align: middle; text-align: center;">' . $row["id"] . '</td>
            <td style="vertical-align: middle; text-align: center;">' . $row["name"] . ' </td>
            <td style="vertical-align: middle; text-align: center;">' . $row["description"] . ' </td>
            <td style="vertical-align: middle; text-align: center;">' . $row["quantity"] . ' </td>
            <td style="vertical-align: middle; text-align: center;">' . $row["price"] . ' </td>
            <td style="vertical-align: middle; text-align: center;">   
            <a href="#" title="Edit Details" class="text-success">
            <i class="fas fa-edit"></i></a>
            &nbsp; &nbsp;
            <a href="#" title="Delete item" class="text-danger"><i
            class="fas fa-trash"></i></a> </td>
            </tr>
            ';
        }

        $output .= " </tbody> </table>";
        echo $output;

    } else {
        echo '
            <h3 class="text-center text-secondary mt-5">:( No furniture found! </h3> 
        ';
    }
}

if ($_POST["action"] && $_POST["action"] == "viewAllLogs") {
    // Include the database connection file


    // Check if the user ID is set in the session
    if (isset($_SESSION["user_id"])) {
        $user_id = $_SESSION["user_id"];

        $output = '';
        $data = $db->showActivityLogs($user_id);
        if (count($data) > 0) { // Check if there is data to display
            $output .= '
            <div class="table-responsive"> <!-- Wrap the table in a div with class "table-responsive" -->
                <table class="logs-table table-stripped table-sm table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>Id</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Activity</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
            ';
            foreach ($data as $row) {
                $output .= '
                <tr class="text-center text-secondary">
                    <td>' . $row["id"] . '</td>
                    <td><img src="img/users/' . $row["img"] . '" class="img-fluid" style="max-width: 100px; max-height: 100px;"></td>
                    <td>' . $row["fullname"] . ' </td>
                    <td>' . $row["activity_description"] . ' </td>
                    <td>' . $row["date_created"] . ' </td>
                </tr>
                ';
            }
            $output .= " </tbody> </table></div>"; // Close the table and div
            echo $output;
        } else {
            echo '<h3 class="text-center text-secondary mt-5">No activity logs found!</h3>';
        }
    } else {
        echo "User ID not set in session.";
    }

}


if ($_POST["action"] && $_POST["action"] == "show_profile") {
    $id = $_POST["id"];
    $result = $db->getUserById($id);

    if ($result !== 2) {
        $output = "";
        foreach ($result as $row) {
            $output .= '
            <div class="container">
               
                <div class="profile-card">
                <button type="button" class="close" id="close-profile-modal">&times;</span>
            </button>
                    <div class="text-center">
                        <img src="img/users/' . $row["img"] . '" alt="' . $row["img"] . '" class="profile-img img-fluid" style="width: 150px; height: 150px;">
                    </div>
                    <div class="text-center mt-3">
                        <h4>' . $row["fullname"] . '</h4>
                        <p><i class="fa-solid fa-phone"></i>&nbsp;Phone Number: ' . $row["phone"] . '</p>
                        <p><i class="fa-solid fa-envelope"></i>&nbsp;Email: ' . $row["email"] . '</p>
                        <p><i class="fa-solid fa-user"></i>&nbsp;Username: ' . $row["username"] . '</p>
                    </div>
                </div>
            </div>';

        }
        echo $output;
    } else {
        echo 2;
    }


}

if ($_POST["action"] && $_POST["action"] == "insertNewFurniture") {
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $image = $_FILES["image"]["name"]; // The name of the uploaded file
        $temp_name = $_FILES["image"]["tmp_name"]; // The temporary filename of the file
        // Move the uploaded file to a permanent location
        move_uploaded_file($temp_name, "img/items/" . $image); // Assuming img/items/ is your desired upload directory
    } else {
        // Handle case where no file was uploaded or an error occurred during upload
        $image = "default-image.png"; // Set a default image
    }
    $name = $_POST["name"];
    $description = $_POST["description"];
    $quantity = $_POST["quantity"];
    $price = $_POST["price"];

    $db->insertFurniture($image, $name, $description, $quantity, $price);

}

if ($_POST["action"] && $_POST["action"] == "procced-login") {
    $username = $_POST["username"];
    $pass = $_POST["password"];

    $result = $db->checkCredentials($username, $pass);

    if ($result) {
        echo 1;


    } else {
        echo 2;

    }

}

if ($_POST["action"] && $_POST["action"] == "logout") {
    $user_id = $_POST["id"];
    $result = $db->logout($user_id);
    if ($result) {
        echo 1; //true


    } else {
        echo 2; //false

    }
}

if ($_POST["action"] && $_POST["action"] == "clearActivityLogs") {
    if (isset($_SESSION["user_id"])) {
        $id = $_SESSION["user_id"];
        $success = $db->clearActivityLogs($id);

        echo $success;
    }
}


if ($_POST["action"] && $_POST["action"] == "procced-register") {
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $image = $_FILES["image"]["name"]; // The name of the uploaded file
        $temp_name = $_FILES["image"]["tmp_name"]; // The temporary filename of the file
        // Move the uploaded file to a permanent location
        move_uploaded_file($temp_name, "img/users/" . $image); // Assuming img/items/ is your desired upload directory
    } else {
        // Handle case where no file was uploaded or an error occurred during upload
        $image = "default-profile.png"; // Set a default image
    }
    $fname = $_POST["firstName"];
    $mname = $_POST["middleName"];
    $lname = $_POST["lastName"];
    $uname = $_POST["username"];
    $email = $_POST["email"];
    $pnum = $_POST["phoneNumber"];
    $pass = $_POST["password"];

    $result = $db->insertUser($image, $fname, $mname, $lname, $email, $pnum, $pass, $uname);

    if ($result) {
        echo 1;
    } else {
        echo 2;
    }
}


?>