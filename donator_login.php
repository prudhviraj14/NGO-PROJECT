<?php
include 'db_connect.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];

    $stmt = $conn->prepare("SELECT * FROM donators WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify password
        if (password_verify($_POST['password'], $row['password'])) {
            $_SESSION['donator_username'] = $row['username']; // Store username in session
            echo "Welcome, " . $row['username'] . "! Please select a donation cause:";
            // Display donation options
            echo "<form action='donate.php' method='POST'>";
            echo "<select name='cause'>";
            echo "<option value='charity'>Charity</option>";
            echo "<option value='disaster_relief'>Disaster Relief</option>";
            echo "<option value='education'>Education</option>";
            echo "</select>";
            echo "<input type='submit' value='Donate'>";
            echo "</form>";
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No account found with that username.";
    }

    $stmt->close();
}
$conn->close();
?>
