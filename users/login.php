<?php include 'includes/session.php'?>
<?php include 'includes/header.php' ?>

<!-- Jika ada session user direct ke index.php -->
<?php 
    if(isset($_SESSION['user'])) {
        header('location: index.php');
    }
?>

<body>
    <div class="main-header">

            <?php include 'includes/navbar.php' ?>

            <!-- Card Error -->
            <?php 
                // $status = true;
                if (isset($_SESSION['error'])) {
                    echo "
                        <div class='row'>
                        <div class='col-md-6 offset-md-3'>
                            <div class='alert alert-danger text-center alert-dismissible fade show' role='alert' style='margin-top:60px;'>
                                <p>".$_SESSION['error']."</p>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                              </button>
                            </div>
                            </div>
                        </div>
                    ";
                    unset($_SESSION['error']);
                }
                if (isset($_SESSION['success'])) {
                    echo '<script type="text/javascript">';
                    echo '
                        Swal.fire({
                                position: "top",
                                icon: "success",
                                title: "Yeeaay, Berhasil Login",
                                showConfirmButton: false,
                                timer: 3000
                        });';
                    echo '</script>';

                    unset($_SESSION['success']);
                }
            ?>
            <!-- End Card Error -->
    </div>
    <!-- End Main Header -->
            
    <!-- Login Form -->
    <div class="login-box row justify-content-center h-100" style="margin-top:130px;margin-bottom: 350px;">
        <div class="login-box-body col-sm-3 my-auto">
            <p class="login-box-msg text-center">Sign in to start donation</p>
            <br>

            <form action="verify_login.php" method="POST">
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row justify-content-center">
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat" name="login"><i class="fa fa-sign-in"></i> Sign In</button>
                    </div>
                </div>
            </form>
            <br>
            <!-- <a href="password_forgot.php">I forgot my password</a><br> -->
            <a href="register.php" class="text-center">Register a new membership</a><br>
            <a href="index.php"><i class="fa fa-home"></i> Home</a>
        </div>
    </div>
    <!-- End Login Form -->
 

    <?php include 'includes/footer.php' ?>
    <?php include 'includes/scripts.php' ?>


</body>
</html>