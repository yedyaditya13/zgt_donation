<?php include 'includes/session.php' ?>
<!-- Header -->
<?php include 'includes/header.php' ?>

<?php 
  $today = date('Y-m-d');
  $year = date('Y');
  
  if(isset($_GET['year'])){
    $year = $_GET['year'];
  }
?>


<body>
    <!-- Main Header -->
    <div class="main-header">
        <?php include 'includes/navbar.php' ?>
    </div>
    <!-- End Main Header -->

    <!-- Start reson_area -->
    <div class="reson_area section_padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section_title text-center mb-55" style="margin-top: 30px;">
                        <h3>Records Donation</h3>
                            <hr style="width: 200px;">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table User -->
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">

                        <table id="dtUser" class="table table-striped table-bordered wrap" >
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Tanggal</th>
                                    <th>Kode Transaksi</th>
                                    <th>Nominal</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $conn = $pdo->open();
                                                        
                                    try{
                                        $index = 1;
                                        $stmt = $conn->prepare("SELECT * FROM detail_transaction as d JOIN users as u on u.id=d.id_user JOIN transaction as t ON t.id = d.id_transaction WHERE id_user=:id_user");
                                        $stmt->execute(['id_user' => $user['id']]);
                                                            
                                        foreach($stmt as $row) {
                                            $status = ($row['status_trx'] > 0 ) ? '<span class="label label-success">Sudah Dibayarkan</span>' : '<span class="label label-danger"> Silahkan Konfirmasi Pembayaran</span>';
                                            $date = date("F", strtotime($row['created_on']));
                    
                                            echo "
                                                <tr>
                                                    <td>".$index++."</td>
                                                    <td>".$row['firstname']." ".$row['lastname']."</td>
                                                    <td>".$row['created_on']."</td>
                                                    <td>".$row['code_trx']."</td>
                                                    <td>RP ".number_format($row['nominal'], 2, ',', '.')."</td>
                                                    <td>".$status."</td>
                                                </tr>
                                            ";        
                                        }    
                                    }catch(PDOException $e) {
                                        echo $e->getMessage();
                                    }
                                    $pdo->close();
                                ?>
                            </tbody>
                        </table>   
                    </div>
                </div>
            </div> 
            
            <!-- Donation Request -->
            <div class="container" style="margin-top: 30px;">
                <div class="row justify-content-center">
                    <div class="col-lg-3">
                        <a href="donation_now.php" class="btn btn-info btn-lg donationNow">
                                <span>Ayo, Donasi Sekarang</span>
                            </a>
                    </div>
                </div>
            </div>
            <!-- End Donation Request -->

        </div>
        <!-- End Container -->
    </div>
    <!-- End reson_area -->

    <!-- Footer -->
    <?php include 'includes/footer.php' ?>

    <!-- Scripts Js -->
    <?php include 'includes/scripts.php' ?>

</body>
</html>