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
<head lang="en">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/Login.css">

    <script src="js/jquery-2.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/JavaScript" src="js/sha512.js"></script>
    <script type="text/JavaScript" src="js/forms.js"></script>

    <meta charset="UTF-8">

    <title>Sign in</title>
</head>
<body>
<?php
include_once 'includes/header.php';
?>
<div class="loginarea">
    <div class="container">
        <div class="row vertical-offset-100 element">
            <div class="col-md-4 col-md-offset-4 col-xs-8 col-xs-offset-4 col-lg-4 col-lg-offset-4 col-sm-4 col-sm-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please sign in</h3>
                    </div>
                    <div class="panel-body">
                        <form action="includes/process_login.php" method="post" name="login_form">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Enter E-mail" name="email" type="text" value="">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Enter Password" name="password" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me"> Remember Me
                                    </label>
                                <div class="warning">
                                    <label>
                                        <?php
                                        if (isset($_GET['error'])) {
                                            echo '<p class="error">Error Logging In! ' . $_GET['error']. ' </p>';

                                        }
                                        ?>
                                    </label>
                                </div>
                                <input class="btn btn-lg btn-block" type="submit" value="Login" onclick="formhash(this.form, this.form.password);" />
                                <a href="register.php" class="btn btn-lg btn-block" type="sumbit" value="Register">Register</a>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>