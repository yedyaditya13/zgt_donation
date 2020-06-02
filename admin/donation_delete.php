<?php 
    include 'includes/session.php';

    if (isset($_POST['deleteDonation'])) {
        $id = $_POST['id'];

        $conn = $pdo->open();

        try{
            $stmt = $conn->prepare("DELETE d, t FROM detail_transaction d INNER JOIN transaction t ON d.id_transaction = t.id WHERE d.id=:id");
            $stmt->execute(['id'=>$id]);

            $_SESSION['success'] = 'User berhasil di delete';
        }
        catch(PDOException $e) {
            $_SESSION['error'] = $e->getMessage();
        }
        $pdo->close();
    }
    else{
        $_SESSION['error'] = 'Select user to delete first';
    }

    header('location: donation_all_user.php');

?>