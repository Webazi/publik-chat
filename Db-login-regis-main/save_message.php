<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chatbox";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $sender = $_POST["sender"];
    $message = $_POST["message"];

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO messages (sender, message) VALUES (?,?)");
    $stmt->bind_param("ss", $sender, $message);

    if ($stmt->execute() === TRUE) {
        $stmt->close();
        $conn->close();
        echo "Message saved successfully!";
    } else {
        echo "Error saving message: " . $conn->error;
    }
} else {
    echo "Invalid request!";
}
