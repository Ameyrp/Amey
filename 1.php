<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Top 5 Students by JEE Score</title>
</head>
<body>

<h2>Students Admission Form</h2>

<form method="post">
    <label for="studentID">Student ID:</label><br>
    <input type="text" id="studentID" name="studentID"><br><br>
    
    <label for="studentName">Student Name:</label><br>
    <input type="text" id="studentName" name="studentName"><br><br>
    
    <label for="emailID">Email ID:</label><br>
    <input type="email" id="emailID" name="emailID"><br><br>
    
    <label for="twelfthGrade">12th Grade:</label><br>
    <input type="text" id="twelfthGrade" name="twelfthGrade"><br><br>
    
    <label for="JEEScore">JEE Score:</label><br>
    <input type="number" id="JEEScore" name="JEEScore"><br><br>
    
    <input type="submit" value="Submit">
</form>

<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "amwey";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $studentID = $_POST['studentID'];
    $studentName = $_POST['studentName'];
    $emailID = $_POST['emailID'];
    $twelfthGrade = $_POST['twelfthGrade'];
    $JEEScore = $_POST['JEEScore'];
    
    // Insert data into database
    $sql = "INSERT INTO students (studentID, studentName, emailID, twelfthGrade, JEEScore)
            VALUES ('$studentID', '$studentName', '$emailID', '$twelfthGrade', '$JEEScore')";
    
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Retrieve top 5 students based on JEE Score
$sql = "SELECT * FROM students ORDER BY JEEScore DESC LIMIT 5";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Top 5 Students by JEE Score:</h2>";
    echo "<ol>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>{$row['studentName']} (JEE Score: {$row['JEEScore']})</li>";
    }
    echo "</ol>";
} else {
    echo "No students found";
}

$conn->close();
?>

</body>
</html>
