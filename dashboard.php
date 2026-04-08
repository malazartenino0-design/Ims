!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['email']); ?>!</h2>
    <p>This is your secure dashboard.</p>
    <form action="logout.php" method="POST">
        <button type="submit" name="logout">Logout</button>
    </form>
</body>
</html>

<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.html");
    exit();
}
?>
<?php
include 'db.php';   
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bearer = $_POST['bearer'];
    $equipment = $_POST['equipment'];
    $specs = $_POST['specs'];
    $issued_date = $_POST['issued_date'];

    $stmt = $conn->prepare("INSERT INTO inventory (bearer, equipment, specs, issued_date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $bearer, $equipment, $specs, $issued_date);
    
    if ($stmt->execute()) {
        echo "<p>Inventory added successfully!</p>";
    } else {
        echo "<p>Error adding inventory: " . $stmt->error . "</p>";
    }
    
    $stmt->close();
}

