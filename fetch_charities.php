<?php
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database_name";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$state = $_GET['state'];
$sql = "SELECT * FROM charities WHERE state = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $state);
$stmt->execute();
$result = $stmt->get_result();

$charities = array();
while ($row = $result->fetch_assoc()) {
    $charities[] = $row;
}

echo json_encode($charities);

$stmt->close();
$conn->close();
?>
<!-- CREATE TABLE charities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    state VARCHAR(100) NOT NULL
); -->
