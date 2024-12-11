<?php
header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);
$sender = $data['sender'];
$receiver = $data['receiver'];
$message = $data['message'];

$conn = new mysqli('localhost', 'root', '', 'chat_db');

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$stmt = $conn->prepare('INSERT INTO messages (sender, receiver, message) VALUES (?, ?, ?)');
$stmt->bind_param('sss', $sender, $receiver, $message);
$stmt->execute();
$stmt->close();
$conn->close();

echo json_encode(['status' => 'success']);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($conn->query($sql) === TRUE) {
    echo "Message sent successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>