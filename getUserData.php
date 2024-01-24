<?php
// user_dashboard.php
@include ('config.php');
session_start();

// Check if the user is logged in
// if (!isset($_SESSION['user_email']) && !isset($_SESSION['garage_email'])) {
//     header("Location: login.php"); // Redirect to the login page if not logged in
//     exit();
// }

// Get the user's email from the session
if(isset($_SESSION['user_email'])) {
    $userEmail = $_SESSION['user_email'];

    // Fetch user data
    $userSql = "SELECT * FROM userdata WHERE email='$userEmail'";
    $userResult = $conn->query($userSql);

    if ($userResult->num_rows > 0) {
        $userData = $userResult->fetch_assoc();
        $userName = $userData['name'];
    } else {
        $userName = "Unknown"; // Set a default name if the user's name is not found
    }
} elseif(isset($_SESSION['garage_email'])) {
    $userEmail = $_SESSION['garage_email'];

    // Fetch garage data
    $userSql = "SELECT * FROM garagedata WHERE garageEmail='$userEmail'";
    $userResult = $conn->query($userSql);

    if ($userResult->num_rows > 0) {
        $userData = $userResult->fetch_assoc();
        $userName = $userData['garageName'];
    } else {
        $userName = "Unknown"; // Set a default name if the garage name is not found
    }
}

// Close the database connection


?>