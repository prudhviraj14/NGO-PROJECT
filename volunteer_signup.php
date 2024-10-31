<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Secure password hashing
    $qualifications = $_POST['qualifications'];
    $gender = $_POST['gender'];
    $institute = $_POST['institute'];
    $school = $_POST['school'];
    $experience = $_POST['experience'];

    $stmt = $conn->prepare("INSERT INTO volunteers (name, email, password, qualifications, gender, institute, school, experience) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $name, $email, $password, $qualifications, $gender, $institute, $school, $experience);

    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>
