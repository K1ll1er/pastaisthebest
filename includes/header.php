<nav class="navbar navbar-default navbar-inverse navbar-static-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php"><img src="http://i.imgur.com/SvTiarf.png" alt="Wintercloudlogo" style="margin-top:-5px"> </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.php">Home</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
<?php if (login_check($mysqli) === true) : ?>
    <li><a href="#">Signed in as <?php echo $_SESSION['username']; ?></a></li>
    <li><a href="uploading.php">File Management</a></li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Options<span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
            <li><a href="changepassword.php">Change Password</a></li>
            <li><a data-target="index.php">Link 2</a></li>
            <li><a data-target="#">Link 3</a></li>
            <li class="divider"></li>
            <li><a data-target="#">Link 4</a></li>
        </ul>
    </li>
    <li><a href="includes/logout.php">Logout</a></li>
<?php else : ?>
    <li><a href="sign-in.php">Sign in</a></li>

<?php endif; ?>
</ul>
</div><!-- /.navbar-collapse -->
</div><!-- /.container-fluid -->
</nav>