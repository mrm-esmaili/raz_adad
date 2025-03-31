<?php
session_start();
require_once "config.php";

// چک کردن اینکه کاربر وارد شده باشد
if (!isset($_SESSION['user_id'])) {
  echo json_encode(['status' => 'error', 'message' => 'شما وارد نشده‌اید']);
  exit();
}

$user_id = $_SESSION['user_id'];

// دریافت پیام‌ها و واکنش‌های مربوطه
$stmt = $pdo->prepare("SELECT messages.id, messages.user_id, messages.content, 
                              users.username, users.avatar, 
                              GROUP_CONCAT(message_reactions.emoji) AS reactions
                       FROM messages
                       LEFT JOIN users ON messages.user_id = users.id
                       LEFT JOIN message_reactions ON messages.id = message_reactions.message_id
                       WHERE messages.user_id = ? OR messages.user_id != ?
                       GROUP BY messages.id ORDER BY messages.created_at DESC");
$stmt->execute([$user_id, $user_id]);

$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(['status' => 'success', 'messages' => $messages]);
?>
