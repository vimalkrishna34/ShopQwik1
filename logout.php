<?php
session_start();
session_destroy(); // Destroy the session to log out the user

// Redirect to login page after 3 seconds
header("Refresh:3; url=login.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logging Out...</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f1de;
            color: #5a3d2b;
            font-family: 'Arial', sans-serif;
        }
        .logout-message {
            text-align: center;
            padding: 30px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 400px;
        }
        .spinner-border {
            width: 3rem;
            height: 3rem;
            margin: 10px auto;
            display: block;
            color: #f0b429;
        }
        .btn-primary {
            background-color: #f0b429;
            border: none;
            padding: 10px 15px;
            border-radius: 6px;
            font-weight: bold;
            text-decoration: none;
        }
        .btn-primary:hover {
            background-color: #d49525;
        }
    </style>
</head>
<body>

<div class="logout-message">
    <h2>You have been logged out.</h2>
    <div class="spinner-border" role="status">
        <span class="visually-hidden">Logging out...</span>
    </div>
    <p>Redirecting to the login page in 3 seconds...</p>
    <a href="login.php" class="btn btn-primary">Go to Login</a>
</div>


</body>
</html>