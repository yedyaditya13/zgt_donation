<?php 
    include 'includes/session.php';

    if(isset($_POST['add'])) {
        
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];
        // $image = $_POST['image']; 

        $pdo = new Database();
        $conn = $pdo->open();

        $stmt = $conn->prepare("SELECT *, COUNT(*) as numrows FROM users WHERE email=:email");
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch();

        if($row['numrows'] > 0) {
            $_SESSION['error'] = 'Email already taken';
        }
        else{
            // $encrypt_key = 'JH8hjsdh81!374)98jhHn;f765&^$';
            $random = 113;
            $activate_code = 'activateCode' . $random;
            $password = password_hash($password, PASSWORD_DEFAULT);
            // $filename = $_FILES['image']['name'];
            $now = date('Y-m-d');
            $type = 0; // Untuk users
            $status = 1; // Untuk aktivasi user
            if (!empty($filename)) {
                move_uploaded_file($_FILES['image']['tmp_name'], '../includes/images/'.$filename);
            }
            try{
                $stmt = $conn->prepare("INSERT INTO users (email, password, firstname, lastname, address, contact_info, status, type, activate_code, created_on) VALUES (:email, :password, :firstname, :lastname, :address, :contact, :status, :type, :activate_code, :created_on)");
				$stmt->execute(['email'=>$email, 'password'=>$password, 'firstname'=>$firstname, 'lastname'=>$lastname, 'address'=>$address, 'contact'=>$contact, 'status'=>$status, 'type'=>$type, 'activate_code'=>$activate_code, 'created_on'=>$now]);
				$_SESSION['success'] = 'User added successfully';
            }
            catch(PDOException $e) {
                $_SESSION['error'] = $e->getMessage();
            }
        }
        $pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up user form first';
	}

	header('location: users.php');

?>