<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Action</title>
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
            background-color: #f0f0f0;
        }

        .container {
            text-align: center;
            animation: fadeIn 0.5s ease;
        }

        .title {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        .btn {
            padding: 10px 20px;
            margin: 0 10px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .btn.login {
            background-color: #007bff;
            color: #fff;
        }

        .btn.signup {
            background-color: #28a745;
            color: #fff;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h3 class="title">Welcome to Secured Cloud Storage</h3>
        <p>Please select an action:</p>
        <button class="btn login" onclick="redirectToLogin()">Login</button>
        <button class="btn signup" onclick="redirectToSignup()">Signup</button>
    </div>

    <script>
        function redirectToLogin() {
            window.location.href = 'login.php'; // Change to appropriate PHP file
        }

        function redirectToSignup() {
            window.location.href = 'signup1.php'; // Change to appropriate PHP file
        }
    </script>
</body>
</html>