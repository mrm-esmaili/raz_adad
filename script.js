$(document).ready(function() {
    // حالت شب
    if(localStorage.getItem('theme') === 'dark') {
      $('body').addClass('dark-mode');
    }
  
    // تغییر وضعیت حالت شب
    $('#theme-toggle').click(function() {
      $('body').toggleClass('dark-mode');
      if ($('body').hasClass('dark-mode')) {
        localStorage.setItem('theme', 'dark');
      } else {
        localStorage.setItem('theme', 'light');
      }
    });
  
    // ارسال پیام جدید
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
  
    // بارگذاری پیام‌ها از دیتابیس
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
  