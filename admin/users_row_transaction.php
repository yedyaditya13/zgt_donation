<?php 

	include 'includes/session.php';
	$pdo = new Database();

	if (isset($_POST['id'])) {
		$id = $_POST['id'];

		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT * FROM detail_transaction Where id=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();

		$pdo->close();

		echo json_encode($row);
	}

?>