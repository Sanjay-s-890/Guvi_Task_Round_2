<?php

$email = $_POST['email'];
$password = $_POST['upswd'];


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

if ($result->num_rows > 0) {
    echo json_encode(array('success' => false, 'message' => 'Email address already in use.'));
    exit();
}

$stmt = $conn->prepare('INSERT INTO users ( email, upswd) VALUES (?, ?)');
$stmt->bind_param('ss', $email, $password);
$stmt->execute();

echo json_encode(array('success' => true,'message' => 'Registered Successfully !!!'));
exit();
?>