<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

sec_session_start();
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
<div class="jumbotron">
    <div class="container">
        <h1>WinterCloud</h1>
        <?php if (login_check($mysqli) === true) : ?>
        <?php else : ?>
            <p>Why not Sign in or Register an account?</p>
            <a href="sign-in.php" class="btn btn-lg">Sign-in</a>
            <a href="register.php" class="btn btn-lg">Register</a>
            <a href="#">Learn More</a>
        <?php endif; ?>
    </div>
</div>
<div class="learn-more">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h3>Something</h3>
                <p>Access your files from anywhere at anytime, from any device.
                    Professional Cloud Storage from JustCloud is Simple, Fast and
                    Unlimited. Just Cloud will automatically backup all your documents,
                    photos, music, videos and more to the cloud so you are never without
                    files again.</p>
                <p><a href="#">blahblahblah</a></p>
            </div>
            <div class="col-md-4">
                <h3>Safety</h3>
                <p>Access your files from anywhere at anytime, from any device.
                    Professional Cloud Storage from JustCloud is Simple, Fast and
                    Unlimited. Just Cloud will automatically backup all your documents,
                    photos, music, videos and more to the cloud so you are never without
                    files again.</p>
                <p><a href="#">blahblahblah</a></p>
            </div>
            <div class="col-md-4">
                <h3>Storage</h3>
                <p>Access your files from anywhere at anytime, from any device.
                    Professional Cloud Storage from JustCloud is Simple, Fast and
                    Unlimited. Just Cloud will automatically backup all your documents,
                    photos, music, videos and more to the cloud so you are never without
                    files again.</p>
                <p><a href="#">blahblahblahb</a></p>
            </div>
        </div>
    </div>
</div>
</body>
</html>

