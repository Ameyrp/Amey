<?php
session_start();

$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "multifactor";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $option = $_POST["option"];
    $passwordOrPin = $_POST["password_or_pin"];

    $sql = "SELECT * FROM users2 WHERE username='$username' AND ";
    if ($option == "password") {
        $sql .= "password='$passwordOrPin'";
    } else {
        $sql .= "pin='$passwordOrPin'";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Store the username in a session variable
        $_SESSION["username"] = $username;
        // Redirect the user to twilio.php
        header("Location: twilio.php");
        exit();
    } else {
        $loginError = "Invalid username or password/pin.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0;
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
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="option">Choose Option:</label><br>
                <select id="option" name="option">
                    <option value="password">Password</option>
                    <option value="pin">PIN</option>
                </select>
            </div>
            <div class="form-group">
                <label for="password_or_pin">Password/PIN:</label>
                <input type="password" id="password_or_pin" name="password_or_pin" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Login">
                <?php if(isset($loginError)) { ?>
                    <span class="error"><?php echo $loginError; ?></span>
                <?php } ?>
            </div>
        </form>
    </div>
</body>
</html>
