<?php
session_start();
require_once "php/config.php";

// چک کردن اینکه کاربر وارد شده باشد
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$avatar = $_SESSION['avatar'];

?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>چت آنلاین</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
  <style>
    .chat-box {
      height: 300px;
      overflow-y: scroll;
      border: 1px solid #ccc;
      margin-bottom: 10px;
    }
    .chat-message {
      margin: 5px;
      padding: 10px;
      background-color: #f1f1f1;
      border-radius: 10px;
    }
    .chat-message .user {
      font-weight: bold;
    }
    .chat-message .reactions {
      font-size: 1.5rem;
    }
  </style>
</head>
<body class="bg-light">
  <div class="container py-5">
    <div class="card shadow mx-auto" style="max-width: 500px;">
      <div class="card-body">
        <h4 class="card-title text-center">چت آنلاین</h4>
        <div class="chat-box" id="chat-box"></div>

        <form id="chat-form">
          <div class="input-group">
            <input type="text" class="form-control" id="message" placeholder="پیام خود را بنویسید..." required>
            <button type="submit" class="btn btn-primary">ارسال</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      // ارسال پیام
      $('#chat-form').submit(function(event) {
        event.preventDefault();
        var message = $('#message').val();
        if (message.trim() !== "") {
          $.post('php/save_message.php', { message: message }, function(response) {
            $('#message').val('');
            loadMessages();
          });
        }
      });

      // بارگذاری پیام‌ها
      function loadMessages() {
        $.get('php/get_messages.php', function(response) {
          if (response.status === 'success') {
            var messages = response.messages;
            $('#chat-box').empty();
            messages.forEach(function(message) {
              var messageElement = $('<div class="chat-message"></div>');
              messageElement.append('<div class="user">' + message.username + ':</div>');
              messageElement.append('<div class="content">' + message.content + '</div>');
              messageElement.append('<div class="reactions">' + (message.reactions || '') + '</div>');
              $('#chat-box').append(messageElement);
            });
          }
        });
      }

      loadMessages();
    });
  </script>
</body>
</html>
