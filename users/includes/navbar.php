    <!-- navbar -->
    <div class="row">
        <nav class="navbar navbar-expand-md navbar-light col-md-12 fixed-top">
            <a class="navbar-brand" style="color:white" href="index.php">ZeroGadget</a>
            <button type="button" class="navbar-toggler bg-light" data-toggle="collapse" data-target="#nav">
                <span class="navbar-toggler-icon"></span>
            </button>
                
            <div class="collapse navbar-collapse justify-content-between" id="nav">
                <ul class="navbar-nav">
                    <li class="nav-item" >
                        <a class="nav-link text-light font-weight-bold px-3" href="index.php">Home</a>
                    </li>
                    <li class="nav-item" >
                        <a class="nav-link text-light font-weight-bold px-3" href="blog.php">Blog</a>
                    </li>
                    <li class="nav-item" >
                        <a class="nav-link text-light font-weight-bold px-3" href="#">Donation</a>
                    </li>
                    
                    <?php 
                        if(isset($_SESSION['user'])) {
                            echo '
                                <div class="nav-item">
                                    <a class="nav-link text-light font-weight-bold px-3" href="logout.php" id="logout" nclick="return confirm("Are you sure to logout?");">Logout</a>    
                                </div>
                            ';
                        }
                        else{
                            echo '
                            <li class="nav-item" >
                                <a class="nav-link text-light font-weight-bold px-3" href="login.php">Login</a>
                            </li>
                            <li class="nav-item" >
                                <a class="nav-link text-light font-weight-bold px-3" href="register.php">Sign Up</a>
                            </li>
                            ';
                        }
                    ?>
                </ul>
            </div>
        </nav>
    </div>
    <!-- End Navbar -->

   