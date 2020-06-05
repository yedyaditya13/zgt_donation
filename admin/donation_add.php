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

    
    try {
        $stmt = $conn->prepare("SELECT * FROM detail_transaction WHERE detail_transaction.id_transaction=:id");
        $stmt->execute(['id' => $lastId]);
        $row = $stmt->fetch();

        // Jika ada lastId transaction pada table id_transaction
        if ($row['id_transaction'] == $lastId) {
            $_SESSION['error'] = 'Maaf, Transaksi sudah ada';
        }
        else{
            $stmt = $conn->prepare("SELECT * FROM users WHERE email=:email");
            $stmt->execute(['email' =>$email]);
            $user = $stmt->fetch();

            // Note id_user di buat null di table detail_transaction
            // Cek jika status user belum activated
            if ($user['status'] != 1 ) {
                // Insert table detail transaksi dulu
                $query = $conn->prepare("INSERT INTO detail_transaction(id_transaction, id_user, code_trx, status_trx) VALUES(:id_transaction, :id_user, :code_trx, :status_trx)");
                $query->execute(['id_transaction'=>$lastId, 'id_user'=>$user['id'], 'code_trx'=>'test01', 'status_trx'=>0]);

                // Lalu Hapus bedasarkan id transaction 
                $stmt = $conn->prepare("DELETE d, t FROM detail_transaction d INNER JOIN transaction t ON d.id_transaction = t.id WHERE d.id=:id");
                $stmt->execute(['id' => $lastId]);   
                $_SESSION['error'] = 'Maaf, User belum terdaftar atau activated';
            // }
            // // Cek jika email user tidak ada
            // elseif ($user['email'] == null || empty($user['email']) ) {
            // // Insert table detail transaksi dulu
            // $query = $conn->prepare("INSERT INTO detail_transaction(id_transaction, id_user, code_trx, status_trx) VALUES(:id_transaction, :id_user, :code_trx, :status_trx)");
            // $query->execute(['id_transaction'=>$lastId, 'id_user'=>null, 'code_trx'=>'test01', 'status_trx'=>0]);
            
            // // Lalu Hapus bedasarkan id transaction 
            // $stmt = $conn->prepare("DELETE d, t FROM detail_transaction d INNER JOIN transaction t ON d.id_transaction = t.id WHERE d.id=:id");
            // $stmt->execute(['id' => $lastId]);   
            // $_SESSION['error'] = 'Maaf, User belum terdaftar';
            }
            else{
                $code_trx = 'TRX';
                $code = 100;
                $date = date("F", strtotime($now));
                $generate_code = $code_trx .'-N'. $code++ .'-'. $date;

                // Status trx default 0
                $status_trx = 0;

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
    catch (PDOException $e) {
        $_SESSION['error'] = $e->getMessage();
    }

    $pdo->close();
 
    header('location: donation_all_user.php');
}

?>