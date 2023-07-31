<?php
session_start();

// Cek apakah pengguna sudah login, jika tidak, redirect ke halaman login
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Ambil data pengguna dari database berdasarkan session user_id (sebagai contoh)
require_once 'config.php';
$user_id = $_SESSION['user_id'];
$query = "SELECT username FROM users WHERE id = '$user_id'";
$result = mysqli_query($connection, $query);
$user = mysqli_fetch_assoc($result);
?>



<!DOCTYPE html>
<html>
<head>
    <title>Publik chat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        #chat-container {
            width: 400px;
            margin: 20px auto;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
        }
        #chat-messages {
            height: 300px;
            overflow-y: scroll;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
        }
        #chat-input {
            width: 100%;
            padding: 5px;
        }
        #chat-button {
            margin-top: 5px;
            padding: 5px 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        h1{
            color : Green;
        }
        a{
            underline
        }
    </style>
</head>
<body>
<h1>Publik chat </h1>    
<div id="chat-container">
        <div id="chat-messages">
            <!-- Chat messages will be displayed here -->
        </div>
        <input type="text" id="chat-input" placeholder="Type your message...">
        <button id="chat-button"  onclick="sendMessage()">Send</button>
       
    </div>
 <h1>Log out pencet =<a href="logout.php">oUT</a></h1>
 
    <script>
        function loadChatMessages() {
            const chatMessages = document.getElementById("chat-messages");
            fetch("get_messages.php")
                .then(response => response.json())
                .then(data => {
                    data.forEach(message => {
                        const newMessage = document.createElement("p");
                        newMessage.innerHTML = `<strong>${message.sender}:</strong> ${message.message}`;
                        chatMessages.appendChild(newMessage);
                    });
                });
        }

        function sendMessage() {
            const message = document.getElementById("chat-input").value;
            if (message.trim() !== "") {
                const chatMessages = document.getElementById("chat-messages");
                const newMessage = document.createElement("p");
                newMessage.innerHTML = `<strong>You:</strong> ${message}`;
                chatMessages.appendChild(newMessage);

                // Send the message to the server using AJAX
                const formData = new FormData();
                formData.append("sender", "<?php echo $user['username']; ?>");
                formData.append("message", message);

                fetch("save_message.php", {
                    method: "POST",
                    body: formData
                });

                document.getElementById("chat-input").value = "";
            }
        }

        loadChatMessages();
    </script>
</body>
</html>
