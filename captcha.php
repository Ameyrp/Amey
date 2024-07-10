<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Captcha Verification</title>
   <style>
       body {
           font-family: Arial, sans-serif;
           margin: 0;
           padding: 0;
           display: flex;
           flex-direction: column;
           justify-content: center;
           align-items: center;
           min-height: 100vh;
           background-color: #f5f5f5;
       }

       .captcha-container {
           text-align: center;
           background-color: #fff;
           border-radius: 8px;
           padding: 20px;
           box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
           max-width: 1250px;
           width: 100%;
           margin-bottom: 20px;
       }

       h2 {
           margin-top: 0;
           color: #333;
       }

       .captcha-images {
           display: flex;
           justify-content: center;
           margin-bottom: 20px;
       }

       .captcha-image {
           width: 120px; /* Adjust image width as needed */
           height: auto;
           border-radius: 8px;
           box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
           margin: 10px; /* Added margin between images */
           transition: transform 0.3s ease-in-out;
           cursor: pointer;
       }

       .captcha-image.selected {
           border: 3px solid #4CAF50; /* Green border for selected image */
       }

       .captcha-image:hover {
           transform: scale(1.05);
       }

       .captcha-button {
           padding: 10px 20px;
           font-size: 16px;
           cursor: pointer;
           background-color: #4CAF50;
           color: #fff;
           border: none;
           border-radius: 4px;
       }

       .captcha-button:hover {
           background-color: #45a049;
       }

       .captcha-message {
           margin-top: 10px;
           font-size: 14px;
       }

       .text-captcha-container {
           margin-top: 20px; /* Added space between image and text captcha */
           text-align: center;
       }

       .text-captcha-input {
           padding: 10px;
           font-size: 16px;
           border: 1px solid #ccc;
           border-radius: 4px;
           width: 250px;
           margin-bottom: 20px;
           box-sizing: border-box;
       }

       .text-captcha-button {
           padding: 10px 20px;
           font-size: 16px;
           cursor: pointer;
           background-color: #4CAF50;
           color: #fff;
           border: none;
           border-radius: 4px;
       }

       .text-captcha-button:hover {
           background-color: #45a049;
       }
   </style>
</head>
<body>
   <div class="captcha-container">
       <h2>Select image of Bike</h2>
       <div class="captcha-images">
           <?php
           // Array of images with their labels
           $images = array(
               array("car", "image-1.jpg"),
               array("car", "image-2.jpg"),
               array("car", "image-3.jpg"),
               array("car", "image-4.jpg"),
               array("car", "image-5.jpg"),
               array("car", "image-6.jpg"),
               array("car", "image-7.jpg"),
               array("car", "image-8.jpg"),
               array("bike", "bike-image.jpg") // One image with a bike
           );

           // Shuffle the images array
           shuffle($images);

           // Display images
           foreach ($images as $img) {
               echo '<img src="' . $img[1] . '" alt="' . $img[0] . '" class="captcha-image" onclick="selectImage(this)">';
           }
           ?>
       </div>
       <button onclick="verifyImageCaptcha()" class="captcha-button">Verify</button>
       <p class="captcha-message" id="captchaMessage"></p>
   </div>

   <div class="text-captcha-container">
       <h2>Text Captcha Verification</h2>
       <p>Enter the following CAPTCHA text:</p>
       <p id="textCaptcha" class="text-captcha"></p>
       <input type="text" id="textCaptchaInput" class="text-captcha-input" placeholder="Enter CAPTCHA">
       <button onclick="verifyTextCaptcha()" class="text-captcha-button">Verify</button>
       <p class="captcha-message" id="textCaptchaMessage"></p>
   </div>

   <script>
       // Function to select clicked image
       function selectImage(image) {
           var captchaImages = document.getElementsByClassName("captcha-image");
           for (var i = 0; i < captchaImages.length; i++) {
               captchaImages[i].classList.remove("selected");
           }
           image.classList.add("selected");
       }

       // Function to verify image captcha
       function verifyImageCaptcha() {
           var selectedImage = document.querySelector('.captcha-image.selected');
           if (selectedImage && selectedImage.getAttribute("alt") === "bike") {
               document.getElementById("captchaMessage").textContent = "Verification successful!";
               document.getElementById("captchaMessage").style.color = "#4CAF50"; // Green color
           } else {
               document.getElementById("captchaMessage").textContent = "Verification failed. Please try again.";
               document.getElementById("captchaMessage").style.color = "#f44336"; // Red color
               refreshCaptcha();
           }
       }

       // Function to refresh image captcha
       function refreshCaptcha() {
           var images = document.querySelectorAll('.captcha-image');
           images.forEach(function(image) {
               image.classList.remove('selected');
           });
           location.reload();
       }

       // Function to generate random text captcha
       function generateRandomTextCaptcha(length) {
           const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
           let captcha = '';
           for (let i = 0; i < length; i++) {
               captcha += characters.charAt(Math.floor(Math.random() * characters.length));
           }
           return captcha;
       }

       // Function to verify text captcha
       function verifyTextCaptcha() {
           var textCaptchaInput = document.getElementById("textCaptchaInput").value.toLowerCase().trim();
           var textCaptcha = document.getElementById("textCaptcha").textContent.toLowerCase().trim();
           if (textCaptchaInput === textCaptcha) {
               document.getElementById("textCaptchaMessage").textContent = "Verification successful!";
               document.getElementById("textCaptchaMessage").style.color = "#4CAF50"; // Green color
               verifyAllCaptchas();
           } else {
               document.getElementById("textCaptchaMessage").textContent = "Verification failed. Please try again.";
               document.getElementById("textCaptchaMessage").style.color = "#f44336"; // Red color
               document.getElementById("textCaptchaInput").value = ""; // Clear input field
               refreshTextCaptcha();
           }
       }

       // Function to verify both image and text captchas
       function verifyAllCaptchas() {
           var imageVerified = document.getElementById("captchaMessage").textContent === "Verification successful!";
           var textVerified = document.getElementById("textCaptchaMessage").textContent === "Verification successful!";
           if (imageVerified && textVerified) {
               window.location.href = "file.php";
           }
       }

       // Function to refresh text captcha
       function refreshTextCaptcha() {
           var textCaptcha = generateRandomTextCaptcha(6); // Generate new CAPTCHA text
           document.getElementById("textCaptcha").textContent = textCaptcha;
       }

       // Generate initial CAPTCHA text
       var initialTextCaptcha = generateRandomTextCaptcha(6);
       document.getElementById("textCaptcha").textContent = initialTextCaptcha;
   </script>
</body>
</html>
