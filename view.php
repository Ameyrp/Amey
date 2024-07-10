<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Files</title>
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
            max-width: 500px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .file-upload {
            border: 2px dashed #007bff;
            border-radius: 5px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
        }
        .file-upload:hover {
            background-color: #f0f0f0;
        }
        #file-input {
            display: none;
        }
        #file-list {
            margin-top: 20px;
        }
        #file-list li {
            margin-bottom: 10px;
            list-style: none;
        }
        #upload-btn {
            display: block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        #upload-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Uploaded Files</h2>
        <?php
        $uploadDir = "uploads/"; // Directory where files are uploaded

        // Check if the directory exists
        if (is_dir($uploadDir)) {
            // Get all files in directory
            $files = scandir($uploadDir);
            
            // Check if scandir() was successful
            if ($files !== false) {
                // Display each file as a link
                foreach ($files as $file) {
                    if ($file != "." && $file != "..") {
                        echo "<p><a href='$uploadDir$file' target='_blank'>$file</a></p>";
                    }
                }
            } else {
                echo "<p>No files found.</p>";
            }
        } else {
            echo "<p>Directory '$uploadDir' not found.</p>";
        }
        ?>
        <a href="file.php" class="btn">Go Back</a>
    </div>
</body>
</html>
