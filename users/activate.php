<?php include 'includes/session.php' ?>

<?php 

    // $pdo = new Database();
    $output = '';

    if (!isset($_GET['code']) or !isset($_GET['user'])) {
        $output .= '
                <div class="alert alert-danger">
                    <h4><i class="icon fa fa-warning"></i> Error!</h4>
                    Code to activate account not found.
                </div>
                <h4 style="padding-top:10px;">You may <a href="register.php">Signup</a> or back to <a href="index.php">Homepage</a>.</h4>
            ';
    }
    else{
        $conn = $pdo->open();

        $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM users WHERE activate_code=:code AND id=:id ");
        $stmt->execute(['code'=>$_GET['code'], 'id'=>$_GET['user']]);
        $row = $stmt->fetch();

        if ($row['numrows'] > 0) {
            if ($row['status']) {
                $output .= '
					<div class="alert alert-danger">
		                <h4><i class="icon fa fa-warning"></i> Error!</h4>
		                Account already activated.
		            </div>
		            <h4 style="padding-top:10px;">You may <a href="login.php">Login</a> or back to <a href="index.php">Homepage</a>.</h4>
				';
            }
            else{
                try{
                    $stmt = $conn->prepare("UPDATE users SET status =:status WHERE id=:id");
                    $stmt->execute(['status'=>1, 'id'=>$row['id']]);
                    $output .= '
                            <div class="alert alert-success">
			                    <h4><i class="icon fa fa-check"></i> Success!</h4>
			                    Account activated - Email: <b>'.$row['email'].'</b>.
			                </div>
			                <h4 style="padding-top:10px;">You may <a href="login.php">Login</a> or back to <a href="index.php">Homepage</a>.</h4>
                    ';

                }
                catch(PDOException $e) {
                    $output .= '
						<div class="alert alert-danger">
			                <h4><i class="icon fa fa-warning"></i> Error!</h4>
			                '.$e->getMessage().'
			            </div>
			            <h4 style="padding-top:10px;">You may <a href="register.php">Signup</a> or back to <a href="index.php">Homepage</a>.</h4>
					';
                }
            }
        }
        else{
            $output .= '
				<div class="alert alert-danger">
	                <h4><i class="icon fa fa-warning"></i> Error!</h4>
	                Cannot activate account. Wrong code.
	            </div>
	            <h4 style="padding-top:10px;">You may <a href="register.php">Signup</a> or back to <a href="index.php">Homepage</a>.</h4>
			';
        }
        $pdo->close();
    }

?>

<?php include 'includes/header.php' ?>
<body>
    <div class="main-header">
        <?php include 'includes/navbar.php' ?>
    </div>
	 
        <div class="content-wrapper" style="margin-top: 150px; margin-bottom:300px;">
            <div class="container">

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-sm-9">
                            <?php echo $output; ?>
                        </div> 
                    </div>
                </section>
	     
	        </div>
        </div>

  
    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/scripts.php'; ?>
    
</body>
</html>