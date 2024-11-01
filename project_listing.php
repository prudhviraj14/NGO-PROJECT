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

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO projects (title, description, required_skills, location, contact_email) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $title, $description, $required_skills, $location, $contact_email);

// Set parameters and execute
$title = $_POST['title'];
$description = $_POST['description'];
$required_skills = $_POST['required_skills'];
$location = $_POST['location'];
$contact_email = $_POST['contact_email'];

if ($stmt->execute()) {
    echo "Project listed successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
