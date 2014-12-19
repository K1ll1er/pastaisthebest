<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

sec_session_start();

if (login_check($mysqli) === true) {
    header('Location: index.php');
    return;
}
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <script src="js/jquery-2.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</head>

<body>
<?php
include_once 'includes/header.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Secure Login: Registration Success</title>
    <link rel="stylesheet" href="styles/main.css" />
</head>
<body>
    <div class="registersuccessful">
         <h1>Registration successful!</h1>
         <p>You can now go back to the <a href="index.php">login page</a> and log in</p>
    </div>
</body>
</html>