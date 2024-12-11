<?php
header('Content-Type: application/json');

$conn = new mysqli('localhost', 'root', '', 'chat_db');

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$result = $conn->query('SELECT sender, message FROM messages ORDER BY timestamp ASC');

$messages = [];
while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}

$conn->close();

echo json_encode($messages);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo json_encode($row);
    }
} else {
    echo "No messages found.";
}

?>
