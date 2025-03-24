<?php include 'includes/header.php'; ?>
<h2>Register</h2>
<form method="post" action="register.php">
    <input type="text" name="name" placeholder="Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" name="register">Register</button>
</form>

<?php
if (isset($_POST['register'])) {
    include 'includes/db.php';
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = $conn->prepare("INSERT INTO users (name, email, password, user_type) VALUES (?, ?, ?, 'customer')");
    $query->bind_param('sss', $name, $email, $password);
    if ($query->execute()) {
        header("Location: login.php");
    } else {
        echo "Registration failed.";
    }
}
?>

<?php include 'includes/footer.php'; ?>
