<?php 
  include 'includes/session.php';
?>

<?php 
  $today = date('Y-m-d');
  $year = date('Y');
  if(isset($_GET['year'])){
    $year = $_GET['year'];
  }

  $conn = $pdo->open();
?>


<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <?php include 'includes/navbar.php'; ?>
    <?php include 'includes/menubar.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
            <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
            Dashboard
            </h1>
            <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
        <?php
            if(isset($_SESSION['error'])){
                echo "
                  <div class='alert alert-danger alert-dismissible'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon fa fa-warning'></i> Error!</h4>
                    ".$_SESSION['error']."
                  </div>
                ";
                unset($_SESSION['error']);
              }
              if(isset($_SESSION['success'])){
                echo "
                  <div class='alert alert-success alert-dismissible'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon fa fa-check'></i> Success!</h4>
                    ".$_SESSION['success']."
                  </div>
                ";
                unset($_SESSION['success']);
              }
            ?>
      
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <?php
                                $type = 0;
                                try{
                                    $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM users WHERE type=:type");
                                    $stmt->execute(['type'=>$type]);
                                    $row = $stmt->fetch();
                                    echo "<h3 class='title_card'>".$row['numrows']."</h3>";
                                }
                                catch(PDOException $e){
                                    echo $e->getMessage();
                                }
                            ?>

                            <p>Total All Users</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <a href="users.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <?php 
                                $conn = $pdo->open();
                                            
                                $stmt = $conn->prepare("SELECT SUM(nominal) as total FROM transaction");
                                $stmt->execute();
                                $row = $stmt->fetch();
                                            
                                echo "
                                    <h3 class='title_card'>Rp ".number_format($row['total'], 2,',','.')."</h3>
                                "
                            ?>
          
                            <p>Total Donation</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-money"></i>
                        </div>
                        <a href="donation_all_user.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3 class="title_card">Blog</h3>
                        
                            <p>All Blogs</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-newspaper-o"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3 class="title_card">ETC</h3>

                            <p>ETC</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-binoculars"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            <!-- ./col -->
            </div>

            <!-- /.row -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Monthly Report</h3>
                            <div class="box-tools pull-right">
                                <form class="form-inline">
                                    <div class="form-group">
                                        <!-- <label>Select Year: </label>
                                        <select class="form-control input-sm" id="select_year"> -->

                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="chart">
                                <br>
                                <div id="legend" class="text-center"></div>
                                    <canvas id="barChart" style="height:350px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
      <!-- right col -->

    </div>
  	<?php include 'includes/footer.php'; ?>

</div>
<!-- ./wrapper -->


<!-- Chart Data -->
<!-- <?php
    $months = array();
    $sales = array();
    for( $m = 1; $m <= 12; $m++ ) {
        try{
        $stmt = $conn->prepare("SELECT * FROM details LEFT JOIN sales ON sales.id=details.sales_id LEFT JOIN products ON products.id=details.product_id WHERE MONTH(sales_date)=:month AND YEAR(sales_date)=:year");
        $stmt->execute(['month'=>$m, 'year'=>$year]);
        $total = 0;
        foreach($stmt as $srow){
            $subtotal = $srow['price']*$srow['quantity'];
            $total += $subtotal;    
        }
        array_push($sales, round($total, 2));
        }
        catch(PDOException $e){
        echo $e->getMessage();
        }

    $num = str_pad( $m, 2, 0, STR_PAD_LEFT );
    $month =  date('M', mktime(0, 0, 0, $m, 1));
    array_push($months, $month);
  }

  $months = json_encode($months);
  $sales = json_encode($sales);

?> -->
<!-- End Chart Data -->

<?php $pdo->close(); ?>
<?php include 'includes/scripts.php'; ?>


<!-- <script>
$(function(){
  $('#select_year').change(function(){
    window.location.href = 'home.php?year='+$(this).val();
  });
});
</script> -->


</body>
</html>
