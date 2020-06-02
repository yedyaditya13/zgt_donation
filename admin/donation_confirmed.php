<?php 

    include 'includes/session.php';

    if (isset($_POST['confirm'])) {
        $id = $_POST['id'];

        $pdo = new Database();
        $conn = $pdo->open();

        $stmt = $conn->prepare("SELECT * FROM detail_transaction WHERE id=:id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        if (isset($row['id']) > 0) {
           try {
            $stmt = $conn->prepare("UPDATE detail_transaction SET status_trx=:status_trx WHERE id=:id");
            $stmt->execute(['status_trx'=>1, 'id'=>$id]);
            $_SESSION['success'] = 'Transaksi Berhasil';
            
           } catch (PDOException $e) {
                $_SESSION['error'] = $e->getMessage();
           }
        }
        else{
            $_SESSION['error'] = 'User Not Found';
        }
        $pdo->close();
    }

    header('location: donation_all_user.php');

?>