<?php 

    include 'includes/session.php';

    if (isset($_POST['edit'])) {
        $id = $_POST['id'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];

        // $pdo = new Database();
        $conn = $pdo->open();

        $stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
        $stmt->execute(['id'=>$id]);
        $row = $stmt->fetch();

        
        if ($password == $row['password']) {
            $password = $row['password'];
        }
        else{
            $password = password_hash($password, PASSWORD_DEFAULT);
        }

        try{
            $stmt = $conn->prepare("UPDATE users SET firstname=:firstname, lastname=:lastname, email=:email, password=:password, address=:address, contact_info=:contact WHERE id=:id");
            $stmt->execute(['firstname'=>$firstname, 'lastname'=>$lastname, 'email'=>$email, 'password'=>$password, 'address'=>$address, 'contact'=>$contact, 'id'=>$id]);
            $_SESSION['success'] = 'User Updatated Successfully';
        }
        catch(PDOException $e) {
            $_SESSION['error'] = $e->getMessage();
        }
        $pdo->close();
    }
    else{
        $_SESSION['error'] = 'Fill up edit user form first';
    }

    header('location: users.php');

?>
