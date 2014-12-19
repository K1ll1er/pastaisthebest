<?php
include_once 'db_connect.php';
include_once 'functions.php';

sec_session_start();

if (isset($_POST['email'], $_POST['p'])) {
    $email = $_POST['email'];
    $password = $_POST['p']; // The hashed password.

    $result = login($email, $password, $mysqli);
    if ($result === true) {
        // Login success 
        header('Location: ../index.php');
    } else {
        // Login failed 
        header('Location: ../sign-in.php?error=' . $result);
    }
} else {
    // The correct POST variables were not sent to this page. 
    echo 'Invalid Request';
}