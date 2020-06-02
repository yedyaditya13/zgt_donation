<?php 

    include 'includes/session.php';

    $pdo = new Database();

    if (isset($_POST['activate'])) {
        $id = $_POST['id'];

        $conn = $pdo->open();

        $stmt = $conn->prepare("SELECT *, COUNT(*) as numrows FROM users WHERE id=:id");
        $stmt->execute(['id'=>$id]);
        $row = $stmt->fetch();

        if (isset($row['id']) > 0) {
            try {
                $stmt = $conn->prepare("UPDATE users SET status=:status WHERE id=:id");
                $stmt->execute(['status'=>1, 'id'=>$id]);
                $_SESSION['success'] = 'User Berhasil Teraktivasi';
            } catch (PDOException $e) {
                $_SESSION['error'] = $e->getMessage();
            }
        }
        else{
            $_SESSION['error'] = 'User Not Found';
        }
        $pdo->close();
    }
    else{
        $_SESSION['error'] = 'Select user to activate first';
    }

    header('location: users.php');

?>