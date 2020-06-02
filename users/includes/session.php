<?php 

// echo session save_path()
// include __DIR__.'../../../config/conn.php';
include '../config/conn.php';
session_start();

// Jika admin direct ke halaman home admin
if(isset($_SESSION['admin'])) {
    header('location: ../admin/home.php');
}

// Jika user direct ke halaman home/index user
if(isset($_SESSION['user'])) {
    $conn = $pdo->open();
    
    try {
        $stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
        $stmt->execute(['id' => $_SESSION['user']]);
        $user = $stmt->fetch();
    } 
    catch (PDOException $e) {
        echo "Maaf, terjadi kesalahan pada koneksi";
    }
    $pdo->close();
}


?>