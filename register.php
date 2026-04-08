<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "user_db";

// Connect
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// On form submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gmail = $_POST['gmail'] ?? '';
    $pass = $_POST['password'] ?? '';

    if (!empty($gmail) && !empty($pass)) {
        $hashedPass = password_hash($pass, PASSWORD_DEFAULT);

        // Check for duplicate email first
        $check = $conn->prepare("SELECT gmail FROM users WHERE gmail = ?");
        $check->bind_param("s", $gmail);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            echo "Email already exists. Please use another email.";
        } else {
            // Insert new user
            $stmt = $conn->prepare("INSERT INTO users (gmail, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $gmail, $hashedPass);

            if ($stmt->execute()) {
                echo "Registered successfully!";
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        }

        $check->close();
    } else {
        echo "Please fill out all fields.";
    }
}

$conn->close();
?>
