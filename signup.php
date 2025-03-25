<?php
// PHP logic to handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate inputs (basic validation)
    if (empty($username) || empty($email) || empty($password)) {
        $error = "All fields are required.";
    } else {
        // Hash the password for security
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Create an array with user data
        $userData = [
            'username' => $username,
            'email' => $email,
            'password' => $hashedPassword
        ];

        // Define the JSON file path
        $jsonFile = 'users.json';

        // Check if the JSON file exists
        if (file_exists($jsonFile)) {
            // Read existing data
            $data = json_decode(file_get_contents($jsonFile), true);
        } else {
            // Initialize an empty array if the file doesn't exist
            $data = [];
        }

        // Add the new user data to the array
        $data[] = $userData;

        // Save the updated data back to the JSON file
        file_put_contents($jsonFile, json_encode($data, JSON_PRETTY_PRINT));

        // Display a success message
        $success = "Signup successful!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin-top: 60px;
        }
        .signup-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        .signup-container h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .signup-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        .signup-container button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .signup-container button:hover {
            background-color: #218838;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
        .success {
            color: green;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <h2>Create an account</h2>
        <?php
        // Display error message if any
        if (isset($error)) {
            echo "<p class='error'>$error</p>";
        }
        // Display success message if any
        if (isset($success)) {
            echo "<p class='success'>$success</p>";
        }
        ?>
        <form action="signup.php" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Sign Up</button>
        </form>
    </div>
</body>
</html>