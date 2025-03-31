<?php
session_start();
require_once "config.php";

// چک کردن اینکه کاربر وارد شده باشد
if (!isset($_SESSION['user_id'])) {
  echo json_encode(['status' => 'error', 'message' => 'شما وارد نشده‌اید']);
  exit();
}

$user_id = $_SESSION['user_id'];
$message_id = $_POST['message_id'] ?? null;
$emoji = $_POST['emoji'] ?? null;

if (!$message_id || !$emoji) {
  echo json_encode(['status' => 'error', 'message' => 'پیام یا واکنش ارسال نشده']);
  exit();
}

// ثبت واکنش یا به‌روزرسانی آن
$stmt = $pdo->prepare("SELECT * FROM message_reactions WHERE message_id = ? AND user_id = ?");
$stmt->execute([$message_id, $user_id]);
$existing_reaction = $stmt->fetch(PDO::FETCH_ASSOC);

if ($existing_reaction) {
  // اگر واکنش قبلاً ثبت شده، به‌روزرسانی می‌کنیم
  $stmt = $pdo->prepare("UPDATE message_reactions SET emoji = ? WHERE message_id = ? AND user_id = ?");
  $stmt->execute([$emoji, $message_id, $user_id]);
} else {
  // در غیر این صورت واکنش جدید ثبت می‌شود
  $stmt = $pdo->prepare("INSERT INTO message_reactions (message_id, user_id, emoji) VALUES (?, ?, ?)");
  $stmt->execute([$message_id, $user_id, $emoji]);
}

echo json_encode(['status' => 'success', 'message' => 'واکنش ثبت شد']);
?>
