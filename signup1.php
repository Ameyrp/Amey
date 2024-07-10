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

// Function to validate PIN
function validatePin($pin) {
    // PIN must be exactly 4 digits long and contain only numbers
    $pinRegex = "/^\d{4}$/";
    return preg_match($pinRegex, $pin);
}

// Define variables and initialize with empty values
$username = $password = $pin = "";
$usernameErr = $passwordErr = $pinErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate username
    $username = $_POST["username"];
    
    // Check if option is selected and get the selected option
    if (isset($_POST['option'])) {
        $option = $_POST['option'];
        if ($option == "password") {
            $password = $_POST["password"];

            // Password validation
            if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{9,}$/", $password)) {
                $passwordErr = "Password must be at least 9 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character.";
            }
        } elseif ($option == "pin") {
            $pin = $_POST["pin"];

            // PIN validation
            if (!validatePin($pin)) {
                $pinErr = "PIN must be exactly 4 digits long and contain only numbers.";
            }
        }
    }

    // If no errors, store data in database
    if (empty($usernameErr) && (($option == "password" && empty($passwordErr)) || ($option == "pin" && empty($pinErr)))) {
        $sql = "INSERT INTO users2 (username, password, pin) VALUES ('$username', '$password', '$pin')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            // Redirect to start.php
            header("Location: start.php");
            exit(); // Make sure nothing else is executed after redirection
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group select, .form-group input[type="text"], .form-group input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-group input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
        }
        .form-group input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Signup</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="option">Choose Option:</label><br>
                <select id="option" name="option" onchange="toggleFields()">
                    <option value="password">Password</option>
                    <option value="pin">PIN</option>
                </select>
            </div>
            <div class="form-group" id="passwordGroup" style="display: none;">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <span class="error"><?php echo $passwordErr; ?></span>
            </div>
            <div class="form-group" id="pinGroup" style="display: none;">
                <label for="pin">PIN:</label>
                <input type="text" id="pin" name="pin">
                <span class="error"><?php echo $pinErr; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" value="Signup">
            </div>
        </form>
    </div>

    <script>
        // Function to toggle visibility of password and PIN fields based on dropdown selection
        function toggleFields() {
            var option = document.getElementById("option").value;
            var passwordGroup = document.getElementById("passwordGroup");
            var pinGroup = document.getElementById("pinGroup");

            if (option === "password") {
                passwordGroup.style.display = "block";
                pinGroup.style.display = "none";
            } else if (option === "pin") {
                passwordGroup.style.display = "none";
                pinGroup.style.display = "block";
            }
        }

        // Client-side form validation
        function validateForm() {
            var option = document.getElementById("option").value;

            // Password validation if the option is password
            if (option === "password") {
                var password = document.getElementById("password").value;

                var passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{9,}$/;

                if (!passwordRegex.test(password)) {
                    alert("Password must be at least 9 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character.");
                    return false;
                }
            }

            // PIN validation if the option is pin
            if (option === "pin") {
                var pin = document.getElementById("pin").value;

                var pinRegex = /^\d{4}$/;
                if (!pinRegex.test(pin)) {
                    alert("PIN must be exactly 4 digits long and contain only numbers.");
                    return false;
                }
            }

            return true;
        }
    </script>
</body>
</html>