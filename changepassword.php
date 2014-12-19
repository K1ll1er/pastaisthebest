<?php
include_once 'includes/changepassword.inc.php';
include_once 'includes/functions.php';

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
                        <h3 class="panel-title">Change Password Below</h3>
                    </div>
                    <div class="panel-body">
                        <form action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" method="post" name="changepassword_form">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Current Password" name="password" type="password" id="password" value="">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="New Password" name="newpassword" type="password" id="newpassword" value="">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="New Confirm Password" name="confirmpwd" type="password" id="confirmpwdd" value="">
                                </div>
                                <input class="btn btn-lg btn-block" type="submit" value="Change" onclick="changepasswordformhash(this.form, this.form.password, this.form.newpassword, this.form.confirmpwd);" />
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