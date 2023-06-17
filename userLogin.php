<?php
session_start(); // Start the session

include 'config.php';
include 'dbconnect.php';

// New login
if (isset($_POST['username'])) {
    $username = stripslashes($_POST['username']);
    $username = mysqli_real_escape_string($conn, $username);
    $password = stripslashes($_POST['password']);
    $password = mysqli_real_escape_string($conn, $password);

    $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $rows = mysqli_num_rows($result);

    if ($rows == 1) {
        $session_rows = mysqli_fetch_array($result);
        $_SESSION['user_id'] = $session_rows['user_id'];
        $_SESSION['username'] = $session_rows['f_name'];
        $_SESSION['user_role'] = 'user';

        $_SESSION['login_success'] = true;
        header("Location: user_profile.php");
        exit();
    } else {
        $_SESSION['login_success'] = false; 
        $_SESSION['login_error_message'] = "User does not exist"; 
        header("Location: login.php");
        exit();
    }
}
?>
