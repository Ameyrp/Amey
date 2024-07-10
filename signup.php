<?php
// PHP code starts here
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "multifactor";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define variables and initialize with empty values
$username = $password = $pin = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate username
    $username = $_POST["username"];
    
    // Check if option is selected and get the selected option
    if (isset($_POST['option'])) {
        $option = $_POST['option'];
        if ($option == "password") {
            $password = $_POST["password"];
        } elseif ($option == "pin") {
            $pin = $_POST["pin"];
        }
    }

    // Store data in database
    $sql = "INSERT INTO users1 (username, password, pin) VALUES ('$username', '$password', '$pin')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>