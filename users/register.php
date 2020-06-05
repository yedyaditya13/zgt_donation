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
            $status = true;
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
                            title: "Yeeaay, Berhasil Register! Silahkan cek email anda untuk aktivasi",
                            showConfirmButton: false,
                            timer: 3000
                    });';
                echo '</script>';

                // echo "
                //     <div class='row'>
                //         <div class='col-md-6 offset-md-3'>
                //             <div class='alert alert-success text-center alert-dismissible fade show' role='alert' style='margin-top:60px;'>
                //                 <p>".$_SESSION['success']."</p>
                //                 <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                //                 <span aria-hidden='true'>&times;</span>
                //             </button>
                //             </div>
                //         </div>
                //     </div>
                // ";

                unset($_SESSION['success']);
            }
        ?>
        <!-- End Card Error -->
    </div>
    <!-- End Main Header -->

    <!-- Register Form -->
    <div class="register-box-body row justify-content-center h-100" style="margin-top:130px;margin-bottom:200px;">
        <div class="login-box-body col-sm-3 my-auto">
            <p class="login-box-msg text-center">Register a new membership</p>

            <form action="verify_register.php" method="POST">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="firstname" placeholder="Firstname" value="<?php echo (isset($_SESSION['firstname'])) ? $_SESSION['firstname'] : '' ?>" required>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="lastname" placeholder="Lastname" value="<?php echo (isset($_SESSION['lastname'])) ? $_SESSION['lastname'] : '' ?>"  required>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo (isset($_SESSION['email'])) ? $_SESSION['email'] : '' ?>" required>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="repassword" placeholder="Retype password" required>
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                </div>
                <div class="row row justify-content-center">
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat" name="register"><i class="fa fa-pencil"></i> Sign Up</button>
                    </div>
                </div>
            </form>  
            <br>
            <a href="login.php">I already have a membership</a><br>
            <a href="index.php"><i class="fa fa-home"></i> Home</a>
        </div>
    </div>
    <!-- End Register Form -->

    <?php include 'includes/footer.php' ?>
    <?php include 'includes/scripts.php' ?>

</body>
</html>
