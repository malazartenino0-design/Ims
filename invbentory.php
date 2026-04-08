<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bearer = $_POST['bearer'];
    $equipment = $_POST['equipment'];
    $specs = $_POST['specs'];
    $issued_date = $_POST['issued_date'];

    $stmt = $conn->prepare("INSERT INTO inventory (bearer, equipment, specs, issued_date) VALUES (?, ?, ?, ?)");
    $stmt->execute([$bearer, $equipment, $specs, $issued_date]);

    echo "<p>Inventory added successfully!</p>";
}
?> 


