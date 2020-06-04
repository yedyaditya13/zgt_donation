<?php 

    include 'includes/session.php';

    if(isset($_POST['addDonation'])) {
        $email = $_POST['email'];
        $nominal = $_POST['nominal'];

        $pdo = new Database();
        $conn = $pdo->open();

        $now = date('Y-m-d');

        // Insert table transaksi dahulu
        $stmt = $conn->prepare("INSERT INTO transaction (nominal, created_on) values(:nominal, :created_on)");
        $stmt->execute(['nominal'=>$nominal, 'created_on'=>$now]);
        $lastId = $conn->lastInsertId();

        try{
            // Ambil data dari table users
            // $stmt = $conn->prepare("SELECT*, COUNT(*) AS numrows FROM detail_transaction as d JOIN users as u on u.id=d.id_user JOIN transaction as t ON t.id = d.id_transaction WHERE email=:email");
            // $stmt->execute(['email' => $email]);
            // $row = $stmt->fetch();

            // Generate kode transaksi
            $code_trx = 'TRX';
            $code = 100;
            $date = date("F", strtotime($now));
            $generate_code = $code_trx .'-N'. $code++ .'-'. $date;

            // Status trx default 0
            $status_trx = 0;

            // Jika ada lastId transaction pada table id_transaction
            if ($row['id_transaction'] == $lastId) {
                $_SESSION['error'] = 'Maaf, Transaksi sudah ada';
            }
            else{
                $stmt = $conn->prepare("SELECT * FROM users WHERE email=:email");
                $stmt->execute(['email' =>$email]);
                $user = $stmt->fetch();
                // Cek jika status user belum activated
                if ($user['status'] != 1 ) {
                    // Hapus id transaction di sini
                    $stmt = $conn->prepare("DELETE FROM transaction WHERE id=:id");
                    $stmt->execute(['id' => $lastId]);   
                    $_SESSION['error'] = 'Maaf, User belum terdaftar';
                }
                else{
                    try {
                        $stmt = $conn->prepare("INSERT INTO detail_transaction (id_transaction, id_user, code_trx, status_trx) VALUES (:id_transaction, :id_user, :code_trx, :status_trx)");
                        $stmt->execute(['id_transaction'=>$lastId, 'id_user'=>$user['id'], 'code_trx'=>$generate_code, 'status_trx'=>$status_trx]);
                        $_SESSION['success'] = 'Transaksi Berhasil';
                    }
                    catch(PDOException $e) {
                        // Hapus id transaction juga di sini
                        $stmt = $conn->prepare("DELETE FROM transaction WHERE id=:id");
                        $stmt->execute(['id' => $lastId]);   
                        $_SESSION['error'] = 'Maaf, Transaksi gagal! User belum terdaftar'.$e->getMessage();
                    }
                }                
            }
        }
        catch(PDOException $e) {
           echo $e->getMessage();
        }    

        $pdo->close();
        
        header('location: donation_all_user.php');
    }

?>