<?php 
require_once 'DB.php';

$instance = DB::getInstance();
$conn = $instance->connect();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $data = json_decode(file_get_contents('php://input'), true);
    $choice = $data['choice'];
    $email = htmlspecialchars($data['email']);

    //   var_dump($data);

    if(!$choice){
        echo json_encode([
            'message' => 'Make a choice!',
            'success' => 'error'
            ]);
        exit;
     }
    if(!filter_var($email, FILTER_SANITIZE_EMAIL)){
        echo json_encode([
            'message' => 'Enter your email!',
            'success' => 'error'
            ]);
        exit;
     }
     elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo json_encode([
            'message' => 'Enter valid email!',
            'success' => 'error'
            ]);
        exit;
     }

    if(!empty($email) && !empty($choice)){
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $choice = htmlspecialchars($choice);

        $sql = 'SELECT id FROM voters WHERE voters_email = ?';
        $stmt = $conn->prepare($sql);
        $stmt->execute([$email]);
        $result = $stmt->rowCount();

        if($result > 0){
            echo json_encode([
                'message' => 'You voted already!',
                'success' => 'error'
                ]);
            exit;
        }
        else {
            try {
                $sql = 'INSERT INTO voters(voters_email, voters_choice) VALUES(?, ?)';
                $stmt = $conn->prepare($sql);
                $stmt->execute([$email, $choice]);
                echo json_encode([
                    'message' => 'Thank you for voting!',
                    'success' => 'success'
                    ]);
                exit;
            }
            catch(PDOException $e) {
                echo json_encode([
                    'message' => 'Ups, something went wrong!',
                    'success' => 'error'
                    ]);
                exit;
            }
        }
    }
}


?>