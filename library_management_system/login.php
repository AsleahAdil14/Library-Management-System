<?php
include('config/database.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            header("Location: dashboard.php");
        } else {
            echo "Invalid password";
        }
    } else {
        echo "No user found with this email";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/login.css">
    
</head>
<body>
  <div class="container">
   <form method="POST" action="login.php">
        <h2>Login</h2>
        <label><b>EMAIL</b>:</label>
        <input type="text" name="email" required>
        <label><b>PASSWORD</b>:</label>
        <input type="password" name="password" required>
        <button type="submit"><b>LOGIN</b></button>
        <p>Don't have an account? <a href="register.php">Register Here</a></p> 
    </form>
  </div>
</body>
</html>
