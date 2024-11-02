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
$stmt = $conn->prepare("INSERT INTO volunteers (name, email, password, qualifications, gender, institute, school, experience, skills, interests, availability) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssssss", $name, $email, $password, $qualifications, $gender, $institute, $school, $experience, $skills, $interests, $availability);

// Set parameters and execute
$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$qualifications = $_POST['qualifications'];
$gender = $_POST['gender'];
$institute = $_POST['institute'];
$school = $_POST['school'];
$experience = $_POST['experience'];
$skills = $_POST['skills'];
$interests = $_POST['interests'];
$availability = $_POST['availability'];

if ($stmt->execute()) {
    echo "Registration successful!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
