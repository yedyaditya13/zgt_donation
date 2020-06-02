<?php 

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    include 'includes/session.php';

    if (isset($_POST['register'])) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $repassword = $_POST['repassword'];
        $type = 0;

        $_SESSION['firstname'] = $firstname;
        $_SESSION['lastname'] = $lastname;
        $_SESSION['email'] = $email;

        if ($password != $repassword) {
            $_SESSION['error'] = 'Password did not mathc';
            header('location: register.php');
        }
        else{
            $conn = $pdo->open();

            $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM users WHERE email=:email");
            $stmt->execute(['email' => $email]);
            $row = $stmt->fetch();
            if ($row['numrows'] > 0) {
                $_SESSION['error'] = 'Email already taken';
                header('location: register.php');
            }
            else{
                $now = date('Y-m-d');
                $password = password_hash($password, PASSWORD_DEFAULT);

                //generate code
                $set='123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $code=substr(str_shuffle($set), 0, 12);

                try{
                    $stmt = $conn->prepare("INSERT INTO users (email, password, firstname, lastname, activate_code, type, created_on) VALUES (:email, :password, :firstname, :lastname, :code, :type, :now)");
					$stmt->execute(['email'=>$email, 'password'=>$password, 'firstname'=>$firstname, 'lastname'=>$lastname, 'code'=>$code, 'type'=>$type, 'now'=>$now]);
                    $userid = $conn->lastInsertId();
                    
                    $message = "
                    <h2>Thank you for Registering.</h2>
                    <p>Your Account:</p>
                    <p>Email: ".$email."</p>
                    <p>Password: ".$_POST['password']."</p>
                    <p>Please click the link below to activate your account.</p>
                    <a href='http://localhost/zerogadget/users/activate.php?code=".$code."&user=".$userid."'>Activate Account</a>
                ";

                	//Load phpmailer
		    		require '../vendor/autoload.php';

                    $mail = new PHPMailer(true);
                    try{
                        //Server settings
				        $mail->isSMTP();                                     
				        $mail->Host = 'smtp.gmail.com';                      
				        $mail->SMTPAuth = true;                               
				        $mail->Username = 'fundtest17@gmail.com';     
				        $mail->Password = 'fundtastic123';                    
				        $mail->SMTPOptions = array(
				            'ssl' => array(
				            'verify_peer' => false,
				            'verify_peer_name' => false,
				            'allow_self_signed' => true
				            )
                        );  
                        
                        $mail->SMTPSecure = 'tls';                           
				        $mail->Port = 587;                                   

				        $mail->setFrom('fundtest17@gmail.com');
				        
				        //Recipients
				        $mail->addAddress($email);              
				        $mail->addReplyTo('fundtest17@gmail.com');
				       
				        //Content
				        $mail->isHTML(true);                                  
				        $mail->Subject = 'ZeroGadget Sharing is Charity';
				        $mail->Body    = $message;

				        $mail->send();

				        unset($_SESSION['firstname']);
				        unset($_SESSION['lastname']);
                        unset($_SESSION['email']);

                        $_SESSION['success'] = 'Account created. Check your email to activate.';
                        header('location: register.php');
                    }
                    catch(Exception $e) {
                        $_SESSION['error'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
				        header('location: register.php');
                    }
                }
                catch(PDOException $e){
                    $_SESSION['error'] = $e->getMessage();
					header('location: register.php');
                }

                $pdo->close();
            }
        }
    }
    else{
        $_SESSION['error'] = 'Fill up signup form first';
        header('location: register.php');
    }

?>