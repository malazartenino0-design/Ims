<?php
session_start();

$conn = new mysqli("localhost", "root", "", "data"); // Adjust if needed

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$gmail = $_POST['gmail'];
$password = $_POST['password'];

// Prevent SQL injection
$gmail = $conn->real_escape_string($gmail);
$password = $conn->real_escape_string($password);

// Check the user
$sql = "SELECT * FROM user_db WHERE gmail = '$gmail' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows === 1) {
    $_SESSION['gmail'] = $gmail;
    header("Location: inventory.php"); // Redirect to inventory
    exit();
} else {
    echo "Invalid login. <a href='login.php'>Try again</a>";
}

$conn->close();
?>
<?php
// This file is for processing the login form from login.html