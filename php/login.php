<?php
if(isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        echo json_encode(array('success' => false, 'message' => 'Please fill in all fields.'));
        exit();
    } 
    if (strlen($password)<8) {
      echo json_encode(array('success' => false, 'message' => 'Passwords have less than 8 characters.'));
      exit();
    }

    $conn = new mysqli('localhost','root','', 'guvi_project');
    if ($conn->connect_error) {
        echo json_encode(array('success' => false, 'message' => 'Failed to connect to database.'));
        exit();
    }

    $stmt = $conn->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        echo "success";
        exit();
    }
    else {
        echo 'error';
    }
}
?>