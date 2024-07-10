<?php
// Start PHP session if needed or include necessary PHP files

// PHP code for any processing or includes goes here
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
    body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f3f4f6;
        }
        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 400px;
            width: 100%;
        }
        h3 {
            text-align: center;
            margin-bottom: 30px;
        }
        label {
            font-weight: 500;
        }
        select, input {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }
        button:hover {
            background-color: #45a049;
        }
        .contact-method {
            position: relative;
        }
        .tick {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            color: green;
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Signup</h3>
        <form id="signup-form" action="login.php" method="post"> <!-- Change action to point to PHP script -->
            <label for="auth_method">Choose authentication method:</label>
            <select id="auth_method" name="auth_method"> <!-- Add name attribute -->
                <option value="password">Password</option>
                <option value="pin">PIN</option>
            </select>

            <div id="auth_details">
                <label id="auth_label" for="auth_input">Enter your </label>
                <input type="text" id="auth_input" name="auth_input" placeholder="" required> <!-- Add name attribute -->
            </div>

            <label for="contact_method_select">Choose contact method:</label>
            <select id="contact_method_select" name="contact_method_select" onchange="showContactInput()">
                <option value="" selected disabled>Select</option>
                <option value="email">Email</option>
                <option value="phone">Phone Number</option>
            </select>

            <div class="contact_method" id="contact_email">
                <label for="email">Enter your email:</label>
                <input type="email" id="email" name="email" placeholder="Your Email" required> <!-- Add name attribute -->
                <i class="fas fa-check tick" id="emailTick"></i>
            </div>

            <div class="contact_method" id="contact_phone">
                <label for="phone">Enter your phone number:</label>
                <input type="text" id="phone" name="phone" placeholder="Your Phone Number" required> <!-- Add name attribute -->
                <i class="fas fa-check tick" id="phoneTick"></i>
            </div>
            
            <button type="submit">Next</button> <!-- Change button type to submit -->
        </form>
    </div>
    
    <script>
    function validateAndSubmit() {
            var authMethod = document.getElementById('auth_method').value;
            var authInput = document.getElementById('auth_input').value;
            var contactInput = '';
            var emailValidated = document.getElementById('emailTick').style.display === 'block';
            var phoneValidated = document.getElementById('phoneTick').style.display === 'block';
            
            if (authMethod === 'password') {
                if (!isValidPassword(authInput)) {
                    alert("Please enter a valid password (at least 1 uppercase, 1 lowercase, 1 number, 1 special character, and at least 9 characters long).");
                    return;
                }
            } else if (authMethod === 'pin') {
                if (!isValidPin(authInput)) {
                    alert("Please enter a valid PIN (exactly 4 numbers).");
                    return;
                }
            }
                    
            
            if (authMethod === 'password') {
                window.location.href = 'password.html';
            } else if (authMethod === 'pin') {
                window.location.href = 'pin.html';
            }
        }

        function showContactInput() {
            var selectedContact = document.getElementById('contact_method_select').value;
            var contactEmail = document.getElementById('contact_email');
            var contactPhone = document.getElementById('contact_phone');

            if (selectedContact === 'email') {
                contactEmail.style.display = 'block';
                contactPhone.style.display = 'none';
            } else if (selectedContact === 'phone') {
                contactEmail.style.display = 'none';
                contactPhone.style.display = 'block';
            } else {
                contactEmail.style.display = 'none';
                contactPhone.style.display = 'none';
            }
        }

        document.getElementById('auth_method').addEventListener('change', function() {
            var authMethod = this.value;
            var authLabel = document.getElementById('auth-label');
            var authDetails = document.getElementById('auth-details');

            if (authMethod === 'password') {
                authLabel.textContent = 'Enter your password:';
            } else if (authMethod === 'pin') {
                authLabel.textContent = 'Enter your PIN:';
            }

            authDetails.style.display = 'block';
        });

        function isValidPassword(password) {
            // Password must contain at least 1 uppercase, 1 lowercase, 1 number, 1 special character,
            // and must be at least 9 characters long
            var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{9,}$/;
            return passwordRegex.test(password);
        }

        function isValidPin(pin) {
            // PIN must contain exactly 4 numbers
            var pinRegex = /^\d{4}$/;
            return pinRegex.test(pin);
        }

        // Dummy function to simulate validation via OTP
        function validateEmail() {
            document.getElementById('emailTick').style.display = 'block';
        }

        // Dummy function to simulate validation via OTP
        function validatePhone() {
            document.getElementById('phoneTick').style.display = 'block';
        }
    </script>
</body>
</html>

<?php
// More PHP code if needed
?>

