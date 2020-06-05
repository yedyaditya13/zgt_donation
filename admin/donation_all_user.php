<?php include 'includes/session.php' ?>

<?php 
  $today = date('Y-m-d');
  $year = date('Y');
  if(isset($_GET['year'])){
    $year = $_GET['year'];
  }
?>


<?php include 'includes/header.php' ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <?php include 'includes/navbar.php' ?>          
    <?php include 'includes/menubar.php' ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
                <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Dashboard</h1>
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

            <div class="row" >
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <a href="#addNewDonation" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New Donation</a>
                        </div>
                        <div class="box-body">
                            <table id="example3" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Tanggal</th>
                                    <th>Bulan</th>
                                    <th>Kode Transaksi</th>
                                    <th>Nominal</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php 
                                        $pdo = new Database();
                                        $conn = $pdo->open();

                                        try{
                                            $index = 1;
                                            $code = 100;
                                            $stmt = $conn->prepare("SELECT * FROM detail_transaction as d JOIN users as u on u.id=d.id_user JOIN transaction as t ON t.id = d.id_transaction ORDER BY t.created_on");
                                            $stmt->execute();

                                            foreach($stmt as $row) {
                                                // $status_settled = 0;
                                                $status = ($row['status_trx'] > 0 ) ? '<span class="label label-success">Sudah Dibayarkan</span>' : '<span class="label label-danger">Konfirmasi Pembayaran</span>';
                                                $confirm = ($row['status_trx'] == 0) ? '<span class="pull-right"><a href="#confirm" class="status" data-toggle="modal" data-id="'.$row['id'].'"><i class="fa fa-check-square-o"></i></a></span>' : '';
                                            
                                                $date = date("F", strtotime($row['created_on']));

                                                // Generate Code Trx
                                                $code_trx = $row['code_trx'];
                                                $generate_code = $code_trx .'-'. $code++ .'-'. $date;

                                                echo "
                                                <tr>
                                                    <td>".$index++."</td>
                                                    <td>".$row['firstname']." ".$row['lastname']."</td>
                                                    <td>".$row['created_on']."</td>
                                                    <td>".$date."</td>
                                                    <td>".$generate_code."</td>
                                                    <td>".$row['nominal']."</td>
                                                    <td>
                                                        ".$status."
                                                        ".$confirm."
                                                    </td>
                                                    <td>
                                                        <a href='donation_user.php?user=".$row['id_user']."' class='btn btn-info btn-sm btn-flat data'><i class='fa fa-search'></i> Data</a>
                                                        <button class='btn btn-danger btn-sm deleteDonation btn-flat' data-id='".$row['id']."'><i class='fa fa-trash'></i> Delete</button>
                                                    </td>
                                                </tr>
                                                ";
                                            }
                                        }catch(PDOException $e) {
                                            echo $e->getMessage();
                                        }
        
                                        $pdo->close();
                                    ?>

                                    <!-- <tr>
                                        <th rowspan="2">No</th>
                                        <th rowspan="2">Nama</th>
                                        <th colspan="2">Tanggal</th>
                                        <th colspan="2">Bulan</th>
                                        <th rowspan="2">Total</th>
                                    </tr>
                                    <tr>
                                        <th>Jan</th>
                                        <th>Feb</th>
                                        <th>Mar</th>
                                        <th>Apr</th>                                    
                                        <th>Mei</th>
                                        <th>Jun</th>
                                        <th>Jul</th>
                                        <th>Agu</th>                                    
                                        <th>Sep</th>
                                        <th>Okt</th>
                                        <th>Nov</th>
                                        <th>Des</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Dita</td>
                                        <td>25000</td>
                                        <td>25000</td>
                                        <td>25000</td>
                                        <td>25000</td>
                                        <td>25000</td>
                                        <td>25000</td>
                                        <td>25000</td>
                                        <td>25000</td>
                                        <td>25000</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>350,0000</td>
                                    </tr> -->
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th rowspan="2" style="border: none;">Total</th>
                                        <th rowspan="2" style="border: none;"></th>
                                        <th rowspan="2" style="border: none;"></th>
                                        <th rowspan="2" style="border: none;"></th>
                                        <th rowspan="2"></th>    
                                        <th rowspan="2" style="border: none;"></th>
                                    </tr>
                                    <tr>
                                        <?php 
                                            $conn = $pdo->open();
                                            $sts_trx = 1;
                                            
                                            try{
                                                $stmt = $conn->prepare("SELECT SUM(nominal) as total FROM transaction JOIN detail_transaction ON transaction.id=detail_transaction.id_transaction WHERE detail_transaction.status_trx=:status_trx");
                                                $stmt->execute(['status_trx' => $sts_trx]);
                                                $row = $stmt->fetch();
                                                
                                                echo "
                                                    <td><b>RP ".number_format($row['total'], 2, ',', '.')."</b></td>
                                                    <td></td>
                                                ";
                                            }
                                            catch(PDOException $e) {
                                                echo $e->getMessage();
                                            }
                                        
                                            $pdo->close();
                                        ?>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>


    </div>
    <?php include 'includes/footer.php' ?>
    <?php include 'includes/users_modal.php'?>

</div>

    <?php include 'includes/scripts.php'?>


<script>
    $(document).ready(function(){
        $(document).on('click', '.status', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            getUserRow(id);
        })
    });

    // Delete User
    $(document).on('click', '.deleteDonation', function(e){
        e.preventDefault();
        $('#deleteDonation').modal('show');
        var id = $(this).data('id');
        getUserRow(id); 
    });

    function getUserRow(id) {
        $.ajax({
            type: 'POST',
            url: 'users_row_transaction.php',
            data: {id:id},
            dataType: 'JSON',
            success: function(response) {
                $('.userid').val(response.id);
            }
        })
    }
</script>

</body>
</html>