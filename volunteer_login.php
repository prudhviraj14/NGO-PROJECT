<?php
include 'db_connect.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    $stmt = $conn->prepare("SELECT * FROM volunteers WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify password (for security)
        if (password_verify($_POST['password'], $row['password'])) {
            $_SESSION['volunteer_id'] = $row['id']; // Store volunteer ID in session
            $_SESSION['volunteer_name'] = $row['name']; // Store volunteer name

            // Check if a job is allocated
            if (!empty($row['job_title'])) {
                echo "Welcome, " . $row['name'] . "! Your allocated job is: " . $row['job_title'];
            } else {
                echo "Welcome, " . $row['name'] . "! You currently have no allocated jobs.";
            }
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No account found with that email.";
    }

    $stmt->close();
}
$conn->close();
?>
