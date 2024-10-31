<?php
include 'db_connect.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cause = $_POST['cause'];
    $username = $_SESSION['donator_username'];

    // Here, you can implement the logic to record the donation
    // For example, you might want to insert the donation into a donations table

    echo "Thank you, $username! Your donation for $cause has been processed.";
}
?>
