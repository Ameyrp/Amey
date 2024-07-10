<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}

// Include your database connection code here
// Replace the database connection details with your own
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

// Fetch user information from the database
$username = $_SESSION['username'];

// Prepare and execute query to fetch user information based on username
$stmt = $conn->prepare("SELECT * FROM users1 WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // User found, fetch user details
    $user_info = $result->fetch_assoc();
} else {
    // User not found, handle the error as needed
    echo "Error: User not found";
    exit();
}

// Close database connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload and Display</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            position: relative;
        }
        h1 {
            text-align: center;
            color: #007bff;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        #fileToUpload {
            display: none;
        }
        label {
            display: inline-block;
            cursor: pointer;
            padding: 10px 20px;
            background-color: #28a745;
            color: #fff;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
        label:hover {
            background-color: #218838;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #007bff;
            color: #fff;
        }
        .user-info {
            position: absolute;
            top: 20px;
            right: 20px;
            color: #666;
        }
        .logout-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #dc3545;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .logout-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>File Upload and Display</h1>
        <div class="user-info">
            Logged in as: <?php echo htmlspecialchars($user_info['username']); ?>
        </div>
        <?php if ($user_info['username'] === 'admin'): ?>
            <a href="users.php" class="btn">Users</a>
        <?php endif; ?>
        <a href="upload.php" class="btn">Upload</a>
        <a href="view.php" class="btn">View</a>
        
        <!-- Other HTML content here -->
        
        <a href="start.php" class="logout-btn">Logout</a>
    </div>
</body>
</html>
