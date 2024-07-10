<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["files"])) {
    $uploadDir = "uploads/"; // Directory to upload files

    // Loop through each file
    foreach ($_FILES["files"]["name"] as $key => $fileName) {
        $fileTmp = $_FILES["files"]["tmp_name"][$key]; // Temporary file path
        $fileDest = $uploadDir . $fileName; // Destination file path

        // Move file to destination directory
        if (move_uploaded_file($fileTmp, $fileDest)) {
            echo "<p>File '$fileName' uploaded successfully!</p>";
        } else {
            echo "<p>Error uploading file '$fileName'.</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
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
        <h2>Upload Files</h2>
        <div class="file-upload" onclick="document.getElementById('file-input').click()">
            <p>Click here to upload files or drag and drop files here.</p>
        </div>
        <input type="file" id="file-input" name="files[]" multiple style="display: none;">
        <ul id="file-list"></ul>
        <button id="upload-btn" onclick="uploadFiles()">Upload Files</button>
        <a href="view.php" class="btn">View Files</a>
        <a href="file.php" class="btn">Go Back</a>
    </div>

    <script>
        // JavaScript code here
        function uploadFiles() {
            var files = document.getElementById('file-input').files;
            var fileList = document.getElementById('file-list');

            for (var i = 0; i < files.length; i++) {
                var listItem = document.createElement('li');
                listItem.textContent = files[i].name;
                fileList.appendChild(listItem);
            }

            var formData = new FormData();
            for (var i = 0; i < files.length; i++) {
                formData.append('files[]', files[i]);
            }

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'upload.php', true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    console.log(xhr.responseText);
                    document.getElementById('file-list').innerHTML = ''; // Clear file list after uploading
                }
            };
            xhr.send(formData);
        }
    </script>
</body>
</html>
