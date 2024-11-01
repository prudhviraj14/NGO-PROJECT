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

// Fetch volunteers and projects from the database
$volunteers = $conn->query("SELECT * FROM volunteers");
$projects = $conn->query("SELECT * FROM projects");

while ($volunteer = $volunteers->fetch_assoc()) {
    while ($project = $projects->fetch_assoc()) {
        // Basic matching logic
        if (strpos($volunteer['skills'], $project['required_skills']) !== false) {
            // Notify the volunteer (implement notification logic here)
            $to = $volunteer['email'];
            $subject = "New Project Match";
            $message = "Dear " . $volunteer['name'] . ",\n\nYou have been matched with a new project: " . $project['title'];
            $headers = "From: no-reply@yourdomain.com";

            mail($to, $subject, $message, $headers);
            echo "Matching volunteer: " . $volunteer['name'] . " with project: " . $project['title'] . "<br>";
        }
    }
}

$conn->close();
?>
