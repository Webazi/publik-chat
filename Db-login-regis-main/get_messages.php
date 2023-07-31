<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chatbox";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT sender, message FROM messages ORDER BY timestamp ASC";
$result = $conn->query($sql);

$messages = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $messages[] = array(
            "sender" => $row["sender"],
            "message" => $row["message"]
        );
    }
}

$conn->close();

header("Content-Type: application/json");
echo json_encode($messages);
