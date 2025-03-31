<?php
session_start();
require_once "config.php";

// چک کردن اینکه کاربر وارد شده باشد
if (!isset($_SESSION['user_id'])) {
  echo json_encode(['status' => 'error', 'message' => 'شما وارد نشده‌اید']);
  exit();
}

$user_id = $_SESSION['user_id'];

// به‌روزرسانی آخرین فعالیت کاربر
$stmt = $pdo->prepare("INSERT INTO user_online (user_id, last_active) VALUES (?, NOW()) ON DUPLICATE KEY UPDATE last_active = NOW()");
$stmt->execute([$user_id]);

echo json_encode(['status' => 'success']);
?>
