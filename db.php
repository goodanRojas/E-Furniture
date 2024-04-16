<?php


session_start();
class Database
{
    private $server = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "furniture";
    public $conn;

    public function __construct()
    {
        try {
            $this->conn = new mysqli($this->server, $this->username, $this->password, $this->database);
            if ($this->conn->connect_error) {
                throw new Exception("Connection failed: " . $this->conn->connect_error);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function insertFurniture($image, $name, $description, $quantity, $price)
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO products (img, name, description, quantity, price) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssii", $image, $name, $description, $quantity, $price);
            $stmt->execute();
            $stmt->close();
            return true;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function insertUser($image, $fname, $mname, $lname, $email, $pnum, $pass, $username)
    {
        try {
            $fullname = $fname . " " . $mname . " " . $lname;
            $stmt = $this->conn->prepare("INSERT INTO accounts(fullname, img, pass, email, username, phone) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $fullname, $image, $pass, $email, $username, $pnum);
            $stmt->execute();
            $affectedRows = $stmt->affected_rows;
            $stmt->close();
            if ($affectedRows > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo "Error " . $e->getMessage();
            return false;
        }
    }
    

    public function selectFurniture()
    {
        try {
            $qry = "SELECT * FROM products";
            $result = $this->conn->query($qry);
            if ($result->num_rows > 0) {
                // Fetch data from the result set
                $data = array();
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
                return $data;
            } else {
                return array(); // Return an empty array if no results found
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    
    public function getUserById($id)
    {
        try
        {
            $stmt = $this->conn->prepare("SELECT * FROM accounts WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows >0)
            {
                $data = array();
                while($row = $result->fetch_assoc())
                {
                    $data[]= $row;
                }
                return $data;
            }
            else{
                return 2;
            }
        }
        catch(Exception $e)
        {
            echo "Error ". $e->getMessage();
            return 2;
        }
    }

    public function getFurnitureById($id)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM products WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $data = array();
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
                return $data;
            } else {
                return array(); // Return an empty array if no results found
            }

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }

    }

    public function updateFurniture($id, $image, $name, $description, $quantity, $price)
    {
        try {
            $stmt = $this->conn->prepare("UPDATE products SET image = ?, name = ?, description = ?, quantity = ?, price = ?, date_updated = NOW() WHERE id = ?");
            $stmt->bind_param("sssiii", $image, $name, $description, $quantity, $price, $id);
            $stmt->execute();
            $stmt->close();
            return true;
        } catch (Exception $e) {
            echo "Error " . $e->getMessage();
            return false;
        }
    }

    public function deleteFurniture($id)
    {
        try {

            $stmt = $this->conn->prepare("DELETE FROM products WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
            return true;

        } catch (Exception $e) {
            echo "Error " . $e->getMessage();
            return false;
        }
    }

    public function furnitureTotalRowCount()
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM products");
            $stmt->execute();
            $result = $stmt->get_result();
            $t_rows = $result->num_rows;
            return $t_rows;
        } catch (Exception $e) {
            echo "Error " . $e->getMessage();
            return null;
        }
    }

    public function checkCredentials($username, $password)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM accounts WHERE (username = ? OR email = ?)");
            $stmt->bind_param("ss", $username, $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // User exists, check password
                $row = $result->fetch_assoc();
                $stored_password = $row['pass']; // Assuming 'pass' is the column name for password
                $user_id = $row["id"];
                if ($password === $stored_password) {
                    $_SESSION["user_id"] = $user_id;
                    $stmt2 = $this->conn->prepare("INSERT INTO activity_logs (user_id, activity_description)
                    VALUES (?, 'logged in')");

                    // Bind parameters
                    $stmt2->bind_param('i', $user_id);

                    // Execute the statement
                    $stmt2->execute();

                    // Close the statement
                    $stmt2->close();
                    return true; // Passwords match

                } else {
                    return false; // Incorrect password
                }
            } else {
                return false; // User not found
            }
        } catch (Exception $e) {
            echo "Error " . $e->getMessage();
            return false;
        }
    }

    public function logout($id)
    {
        try {
            // Assuming $this->conn is your database connection
            // Prepare the SQL statement
            $stmt = $this->conn->prepare("INSERT INTO activity_logs (user_id, activity_description)
                                          VALUES (?, 'logged out')");

            // Bind parameters
            $stmt->bind_param('i', $id);

            // Execute the statement
            $stmt->execute();

            // Close the statement
            $stmt->close();
            session_unset();
            session_destroy();
            // Optionally, you might want to return a success message or value here
            return true;
        } catch (Exception $e) {
            // Handle exceptions or errors
            // For example, log the error or return an error message
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function showActivityLogs($id)
    {
        try {
            $stmt = $this->conn->prepare("SELECT 
            activity_logs.id AS id, 
            activity_logs.activity_description AS activity_description, 
            accounts.fullname AS fullname, 
            activity_logs.date_created AS date_created, 
            accounts.img AS img 
        FROM 
        accounts
        RIGHT JOIN 
             
            activity_logs
        ON 
            activity_logs.user_id = accounts.id 
        WHERE 
            activity_logs.user_id = ?
        ");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();


            if ($result->num_rows > 0) {
                // Fetch data from the result set
                $data = array();
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
                return $data;
            } else {
                return array(); // Return an empty array if no results found
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function clearActivityLogs($id)
    {
        try {
            $stmt = $this->conn->prepare("DELETE FROM activity_logs WHERE user_id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                $stmt->close();
                return 1;
            } else {
                $stmt->close();
                return 2;
            }
        } catch (Exception $e) {
            echo "Error " . $e->getMessage();
            return 2;
        }

    }

    



}