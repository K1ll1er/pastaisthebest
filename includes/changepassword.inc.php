<?php
include_once 'functions.php';
include_once 'db_connect.php';
include_once 'psl-config.php';
sec_session_start();

if (login_check($mysqli) !== true) {
    header('Location: index.php');
    return;
}

$error_msg = "";

if (isset($_POST['password'], $_POST['newpassword'], $_POST['confirmpwd'])) {
    // Sanitize and validate the data passed in
    $oldpassword = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'newpassword', FILTER_SANITIZE_STRING);
    $passwordconfirm = filter_input(INPUT_POST, 'confirmpwed', FILTER_SANITIZE_STRING);

    $error_msg = change_password($oldpassword, $password, $passwordconfirm, $mysqli);
    if ($error_msg === true) {
        header('Location: index.php');
    } else {
        header('Location: error.php?errormessage=' . $error_msg);
    }
}