<?php
include 'db.php';
session_start();
if (!isset($_POST['login'])) {
    die("Access denied.");
}

$host = 'localhost';
$db = 'user_db';
$user = 'root';
$pass = ''; 

$conn = new mysqli($host, $user, $pass, $db);
include 'db.php';
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$gmail = $_POST['gmail'];
$password = $_POST['password'];

$hashedPassword = hash('sha256', $password);

$sql = "SELECT * FROM users WHERE gmail = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $gmail, $hashedPassword);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    echo "Login successful! Welcome, $gmail";
} else {


    echo "Invalid gmail or password.";
}

$stmt->close();
$conn->close();



?>
<?php
