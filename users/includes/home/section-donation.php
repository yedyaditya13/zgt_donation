<!-- Section Donation  -->
<div class="reson_area section_padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section_title text-center mb-55">
                    <h3>Total Donation</h3>
                    <hr style="width: 200px;">
                </div>
            </div>
        </div>
        <div class="row justify-content-center text-center">
            <div class="col-lg-4 col-md-6">
                <?php                             
                    $conn = $pdo->open();
                    
                    try{
                        $stmt = $conn->prepare("SELECT SUM(nominal) as total FROM transaction");
                        $stmt->execute();
                        $row = $stmt->fetch();
    
                        echo "
                        <h2><b>RP ".number_format($row['total'], 2, ',', '.')."</b></h2>
                        ";
                    }
                    catch(PDOException $e) {
                        echo $e->getMessage();
                    }   
                    $pdo->close();
                ?>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 pt-4 text-center">
                <?php 
                    $conn = $pdo->open(); 
                    if (isset($_SESSION['user'])) {
                        try{
                            $stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
                            $stmt->execute(['id'=>$_SESSION['user']]);
                            $row = $stmt->fetch();
                            
                            echo '
                            <a href="donation.php?user='.$row['id'].'" class="btn btn-info btn-sm donation">
                                <span>Check Donation!</span>
                            </a>
                            ';
                        }
                        catch(PDOException $e) {
                            echo $e->getMessage();
                        }
                        $pdo->close();
                    }else{
                        // Belum di beri modal show user
                        echo '
                            <a href="#donate" class="btn btn-info btn-sm donation" data-toggle="modal">
                                <span>Check Donation!</span>
                            </a>
                        ';
                    }    
                ?>            
            </div>
        </div>  
    </div>
</div>
<!-- Section Donation  -->